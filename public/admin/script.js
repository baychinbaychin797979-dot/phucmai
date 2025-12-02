const $ = sel => document.querySelector(sel);

// Navigation
document.getElementById('nav-dashboard').addEventListener('click', (e)=>{e.preventDefault(); showPanel('dashboard');});
document.getElementById('nav-pages').addEventListener('click', (e)=>{e.preventDefault(); showPanel('pages');});
document.getElementById('nav-settings').addEventListener('click', (e)=>{e.preventDefault(); showPanel('settings');});

function showPanel(id){document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active')); document.getElementById(id).classList.add('active');}

// Load pages
async function loadPages(){
  const res = await fetch('/api/admin/pages');
  const data = await res.json();
  const ul = $('#pages-list'); ul.innerHTML='';
  (data.data||[]).forEach(p=>{
    const li = document.createElement('li');
    li.textContent = `${p.id} — ${p.title}`;
    li.dataset.id = p.id;
    li.style.cursor = 'pointer';
    li.addEventListener('click', ()=> openEditor(p.id));
    ul.appendChild(li);
  });
}

$('#btn-refresh-pages').addEventListener('click', loadPages);

window.loadPages = loadPages;

// Load settings on open
(async function loadSettings(){
  const res = await fetch('/api/admin/settings');
  const j = await res.json();
  $('#settings-json').textContent = JSON.stringify(j, null, 2);
})();

// Page editor
async function openEditor(id){
  const res = await fetch(`/api/admin/pages/${id}`);
  if (!res.ok) return alert('Failed to load page');
  const p = await res.json();
  // show editor
  document.getElementById('page-editor').style.display = 'block';
  document.getElementById('page-title').value = p.title || '';
  document.getElementById('page-slug').value = p.slug || '';
  document.getElementById('page-content').value = p.content || '';
  document.getElementById('btn-save-page').dataset.id = id;
}

document.getElementById('btn-cancel-edit').addEventListener('click', ()=>{
  document.getElementById('page-editor').style.display = 'none';
});

document.getElementById('btn-save-page').addEventListener('click', async ()=>{
  const id = document.getElementById('btn-save-page').dataset.id;
  const payload = {
    title: document.getElementById('page-title').value,
    slug: document.getElementById('page-slug').value,
    content: document.getElementById('page-content').value,
  };
  const res = await fetch(`/api/admin/pages/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  });
  if (res.ok){
    alert('Saved');
    document.getElementById('page-editor').style.display = 'none';
    loadPages();
  } else {
    alert('Save failed');
  }
});
