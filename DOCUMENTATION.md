# Movable Type Framework Documentation

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Project Structure](#project-structure)
- [API Reference](#api-reference)
- [Plugin Development](#plugin-development)
- [Theme Development](#theme-development)

## Installation

### Requirements

- PHP 8.0+
- MySQL 5.7+
- Node.js 14+

### Steps

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy `.env.example` to `.env` and configure
4. Run migrations:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```
5. Start the server:
   ```bash
   npm run dev
   ```

## Configuration

Configuration files are located in the `config/` directory.

### Environment Variables

Create a `.env` file in the project root with the following variables:

```
APP_NAME=MovableType
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=movabletype
DB_USERNAME=root
DB_PASSWORD=
```

## Project Structure

```
mt-framework/
├── src/
│   ├── core/                # Core framework classes
│   │   ├── Application.php
│   │   ├── Auth.php
│   │   ├── Cache.php
│   │   ├── Container.php
│   │   ├── Database.php
│   │   ├── Logger.php
│   │   └── Router.php
│   ├── modules/             # Application modules
│   │   ├── Controller.php
│   │   ├── PostController.php
│   │   ├── CategoryController.php
│   │   ├── TagController.php
│   │   ├── UserController.php
│   │   ├── AuthController.php
│   │   ├── HomeController.php
│   │   ├── BlogController.php
│   │   └── SearchController.php
│   ├── plugins/             # Extensible plugins
│   │   ├── Plugin.php
│   │   ├── PluginInterface.php
│   │   └── PluginManager.php
│   └── themes/              # Theme management
│       ├── Theme.php
│       ├── ThemeInterface.php
│       └── ThemeManager.php
├── config/                  # Configuration files
├── public/                  # Public web root
├── db/                      # Database files
├── tests/                   # Test suites
├── storage/                 # Cache, logs, uploads
├── vendor/                  # Composer dependencies
└── node_modules/            # NPM dependencies
```

## API Reference

### Posts API

#### Get All Posts
```
GET /api/posts
```

#### Get Single Post
```
GET /api/posts/{id}
```

#### Create Post
```
POST /api/posts
Content-Type: application/json

{
  "title": "Post Title",
  "content": "Post content",
  "category_id": 1
}
```

#### Update Post
```
PUT /api/posts/{id}
Content-Type: application/json
```

#### Delete Post
```
DELETE /api/posts/{id}
```

### Categories API

#### Get All Categories
```
GET /api/categories
```

#### Get Single Category
```
GET /api/categories/{id}
```

#### Create Category
```
POST /api/categories
Content-Type: application/json

{
  "name": "Category Name",
  "description": "Category description"
}
```

### Authentication API

#### Login
```
POST /api/auth/login
Content-Type: application/json

{
  "username": "admin",
  "password": "password"
}
```

#### Register
```
POST /api/auth/register
Content-Type: application/json

{
  "username": "user",
  "email": "user@example.com",
  "password": "password"
}
```

#### Logout
```
POST /api/auth/logout
```

## Plugin Development

### Creating a Plugin

1. Create a new directory in `src/plugins/`
2. Extend the `Plugin` class
3. Implement required methods

Example:
```php
<?php

namespace MT\Plugins;

class MyPlugin extends Plugin
{
    protected $name = 'My Plugin';
    protected $version = '1.0.0';
    protected $author = 'Your Name';
    protected $description = 'Plugin description';
    
    public function activate()
    {
        // Activation logic
    }
    
    public function deactivate()
    {
        // Deactivation logic
    }
}
```

## Theme Development

### Creating a Theme

1. Create a new directory in `src/themes/theme-name/`
2. Create a `theme.php` configuration file
3. Create `templates/` directory for template files
4. Create `assets/` directory for CSS/JS

Example theme structure:
```
themes/my-theme/
├── theme.php
├── templates/
│   ├── header.php
│   ├── footer.php
│   └── post.php
└── assets/
    ├── css/
    │   └── style.css
    └── js/
        └── script.js
```

## Testing

Run tests with:
```bash
npm run test
```

## Support

For support, email support@movabletype.com or open an issue on GitHub.
