import http from 'http';
import fs from 'fs';
import fsp from 'fs/promises';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const PORT = process.env.PORT ? Number(process.env.PORT) : 8000;
const PUBLIC_DIR = path.join(__dirname, 'public');

const mimeTypes = {
  '.html': 'text/html',
  '.css': 'text/css',
  '.js': 'text/javascript',
  '.json': 'application/json',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.gif': 'image/gif',
  '.svg': 'image/svg+xml',
  '.ico': 'image/x-icon',
};

async function serveStatic(filePath, res) {
  try {
    const data = await fsp.readFile(filePath);
    const ext = path.extname(filePath).toLowerCase();
    const contentType = mimeTypes[ext] || 'application/octet-stream';
    res.writeHead(200, { 'Content-Type': contentType });
    res.end(data);
  } catch (err) {
    res.writeHead(404, { 'Content-Type': 'text/plain' });
    res.end('Not found');
  }
}

function jsonResponse(res, obj, status = 200) {
  res.writeHead(status, { 'Content-Type': 'application/json' });
  res.end(JSON.stringify(obj));
}

function escapeHtml(str){
  if (!str) return '';
  return String(str)
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

// Mock data for admin API
const adminMock = {
  pages: [
    { id: 1, title: 'Home', slug: 'home', updated_at: '2025-01-01T00:00:00Z' },
    { id: 2, title: 'About', slug: 'about', updated_at: '2025-01-02T00:00:00Z' },
  ],
  settings: {
    site_name: 'Company CMS',
    site_tagline: 'Internal CMS for Company',
    posts_per_page: 10,
  },
};

const server = http.createServer(async (req, res) => {
  try {
    const url = new URL(req.url, `http://localhost:${PORT}`);
    const pathname = decodeURIComponent(url.pathname);

    // Admin static routes
    if (pathname === '/admin' || pathname === '/admin/') {
      const index = path.join(PUBLIC_DIR, 'admin', 'index.html');
      return await serveStatic(index, res);
    }

    if (pathname.startsWith('/admin/')) {
      const filePath = path.join(PUBLIC_DIR, pathname.replace(/^\/admin\//, 'admin/'));
      // Security: ensure inside public dir
      if (!filePath.startsWith(path.join(PUBLIC_DIR, 'admin'))) {
        res.writeHead(403);
        return res.end('Forbidden');
      }
      return await serveStatic(filePath, res);
    }

    // API admin mock
    if (pathname.startsWith('/api/admin')) {
      // /api/admin/pages (list)
      if (pathname === '/api/admin/pages' && req.method === 'GET') {
        return jsonResponse(res, { data: adminMock.pages });
      }
      // GET single page
      const pageIdMatch = pathname.match(/^\/api\/admin\/pages\/(\d+)$/);
      if (pageIdMatch && req.method === 'GET') {
        const id = Number(pageIdMatch[1]);
        const page = adminMock.pages.find(p => p.id === id);
        if (!page) return jsonResponse(res, { error: 'Page not found' }, 404);
        // add content if missing
        return jsonResponse(res, Object.assign({ content: page.content || 'Sample content for ' + page.title }, page));
      }
      // PUT update page
      if (pageIdMatch && req.method === 'PUT') {
        const id = Number(pageIdMatch[1]);
        let body = '';
        for await (const chunk of req) body += chunk;
        try {
          const data = JSON.parse(body || '{}');
          const page = adminMock.pages.find(p => p.id === id);
          if (!page) return jsonResponse(res, { error: 'Page not found' }, 404);
          page.title = data.title ?? page.title;
          page.slug = data.slug ?? page.slug;
          page.content = data.content ?? page.content;
          page.updated_at = new Date().toISOString();
          return jsonResponse(res, { success: true, page });
        } catch (e) {
          return jsonResponse(res, { error: 'Invalid JSON' }, 400);
        }
      }
      if (pathname === '/api/admin/settings') {
        return jsonResponse(res, adminMock.settings);
      }
      return jsonResponse(res, { error: 'Admin endpoint not found' }, 404);
    }

    // Generic API mocks (posts, categories, tags)
    if (pathname.startsWith('/api/')) {
      const parts = pathname.split('/').filter(Boolean); // ['api','posts']
      const resource = parts[1] || '';
      if (resource === 'posts') return jsonResponse(res, { data: [ { id:1, title: 'Welcome', slug: 'welcome' } ] });
      if (resource === 'categories') return jsonResponse(res, { data: [ { id:1, name: 'Technology', slug: 'technology' } ] });
      if (resource === 'tags') return jsonResponse(res, { data: [ { id:1, name: 'PHP', slug: 'php' } ] });
      return jsonResponse(res, { error: 'Endpoint not found' }, 404);
    }

    // Public dynamic pages: serve page by slug so admin edits reflect publicly
    // Examples: /pages/home  or /p/home
    const publicPageMatch = pathname.match(/^\/(?:pages|page|p)\/([^\/]+)\/?$/);
    if (publicPageMatch) {
      const slug = publicPageMatch[1];
      const page = adminMock.pages.find(p => p.slug === slug || String(p.id) === slug);
      if (!page) {
        // fallback to 404 page
        res.writeHead(404, { 'Content-Type': 'text/html; charset=utf-8' });
        return res.end(`<html><head><meta charset="utf-8"><title>Not Found</title></head><body><h1>404 - Page not found</h1><p>No page for "${slug}"</p></body></html>`);
      }

      // Render simple HTML using page data (content may contain HTML)
      const html = `<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>${escapeHtml(page.title)} — Company CMS</title>
  <style>body{font-family:Segoe UI,Roboto,Arial;padding:24px;max-width:900px;margin:40px auto;color:#222}h1{color:#2b2b2b}article{line-height:1.6}</style>
</head>
<body>
  <article>
    <h1>${escapeHtml(page.title)}</h1>
    <p style="color:#888;font-size:14px">Updated: ${page.updated_at || ''}</p>
    <div>${page.content || '<p>(No content)</p>'}</div>
  </article>
  <p><a href="/admin">Back to Admin</a></p>
</body>
</html>`;

      res.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
      return res.end(html);
    }

    // Serve static files in public
    let filePath = path.join(PUBLIC_DIR, pathname);
    // If path is a directory, serve index.html inside it
    try {
      const stats = await fsp.stat(filePath);
      if (stats.isDirectory()) {
        filePath = path.join(filePath, 'index.html');
      }
    } catch (e) {
      // If doesn't exist, fall back to public/index.html for SPA-like routing
      const fallback = path.join(PUBLIC_DIR, 'index.html');
      if (fs.existsSync(fallback)) return await serveStatic(fallback, res);
      res.writeHead(404); res.end('Not Found');
      return;
    }

    // Security check
    if (!filePath.startsWith(PUBLIC_DIR)) {
      res.writeHead(403); res.end('Forbidden');
      return;
    }

    return await serveStatic(filePath, res);
  } catch (err) {
    console.error('Server error', err);
    res.writeHead(500, { 'Content-Type': 'application/json' });
    res.end(JSON.stringify({ error: 'Internal Server Error' }));
  }
});

server.listen(PORT, () => {
  console.log(`\n🚀 Movable Type Framework Server`);
  console.log(`📍 Server running at http://localhost:${PORT}`);
  console.log(`\n✨ Admin UI: http://localhost:${PORT}/admin`);
  console.log(`✨ API Admin Pages: http://localhost:${PORT}/api/admin/pages`);
  console.log(`✨ API Admin Settings: http://localhost:${PORT}/api/admin/settings`);
  console.log(`\nPress Ctrl+C to stop the server\n`);
});

server.on('error', (err) => {
  if (err.code === 'EADDRINUSE') {
    console.error(`Port ${PORT} is already in use`);
  } else {
    console.error('Server error:', err);
  }
  process.exit(1);
});
