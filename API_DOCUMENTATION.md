# API Endpoints Documentation

## Base URL
```
http://localhost:8000/api
```

## Authentication Endpoints

### Login
```
POST /api/auth/login
Content-Type: application/json

Request:
{
  "username": "admin",
  "password": "password"
}

Response:
{
  "token": "jwt-token-here",
  "user": {
    "id": 1,
    "username": "admin",
    "email": "admin@example.com"
  }
}
```

### Register
```
POST /api/auth/register
Content-Type: application/json

Request:
{
  "username": "newuser",
  "email": "user@example.com",
  "password": "password",
  "password_confirmation": "password"
}

Response:
{
  "message": "User registered successfully",
  "user": {
    "id": 2,
    "username": "newuser",
    "email": "user@example.com"
  }
}
```

### Logout
```
POST /api/auth/logout
Authorization: Bearer {token}

Response:
{
  "message": "Logged out successfully"
}
```

## Posts Endpoints

### List Posts
```
GET /api/posts?page=1&per_page=10&sort=created_at&order=desc

Response:
{
  "data": [
    {
      "id": 1,
      "title": "Post Title",
      "slug": "post-title",
      "excerpt": "Post excerpt",
      "content": "Full content",
      "author": "Admin",
      "category_id": 1,
      "status": "published",
      "created_at": "2025-01-01T00:00:00Z"
    }
  ],
  "pagination": {
    "current_page": 1,
    "total_pages": 10,
    "per_page": 10,
    "total": 100
  }
}
```

### Get Single Post
```
GET /api/posts/{id}

Response:
{
  "id": 1,
  "title": "Post Title",
  "slug": "post-title",
  "content": "Full content",
  "author": "Admin",
  "tags": ["tag1", "tag2"],
  "comments": []
}
```

### Create Post
```
POST /api/posts
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "title": "New Post",
  "content": "Post content",
  "excerpt": "Post excerpt",
  "category_id": 1,
  "tags": ["tag1", "tag2"],
  "status": "draft"
}

Response:
{
  "message": "Post created successfully",
  "id": 2,
  "slug": "new-post"
}
```

### Update Post
```
PUT /api/posts/{id}
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "title": "Updated Title",
  "content": "Updated content"
}

Response:
{
  "message": "Post updated successfully"
}
```

### Delete Post
```
DELETE /api/posts/{id}
Authorization: Bearer {token}

Response:
{
  "message": "Post deleted successfully"
}
```

## Categories Endpoints

### List Categories
```
GET /api/categories

Response:
{
  "data": [
    {
      "id": 1,
      "name": "Technology",
      "slug": "technology",
      "description": "Tech articles"
    }
  ]
}
```

### Create Category
```
POST /api/categories
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "name": "New Category",
  "description": "Category description"
}

Response:
{
  "message": "Category created successfully",
  "id": 2
}
```

## Tags Endpoints

### List Tags
```
GET /api/tags

Response:
{
  "data": [
    {
      "id": 1,
      "name": "PHP",
      "slug": "php"
    }
  ]
}
```

### Create Tag
```
POST /api/tags
Authorization: Bearer {token}
Content-Type: application/json

Request:
{
  "name": "New Tag"
}

Response:
{
  "message": "Tag created successfully",
  "id": 2
}
```

## Error Responses

### 400 Bad Request
```json
{
  "error": "Bad Request",
  "message": "Invalid input data"
}
```

### 401 Unauthorized
```json
{
  "error": "Unauthorized",
  "message": "Authentication required"
}
```

### 403 Forbidden
```json
{
  "error": "Forbidden",
  "message": "You don't have permission"
}
```

### 404 Not Found
```json
{
  "error": "Not Found",
  "message": "Resource not found"
}
```

### 500 Internal Server Error
```json
{
  "error": "Internal Server Error",
  "message": "Something went wrong"
}
```
