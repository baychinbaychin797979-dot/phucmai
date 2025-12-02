-- Initial Data for Movable Type Framework

-- Insert default admin user
INSERT INTO users (username, email, password, display_name, role, status) VALUES
('admin', 'admin@movabletype.com', '$2y$10$YQv8uOjQoZt5DT7KnsUIiOYbSxEM.20.8wWKfNHm0Z5MfymzFu1NO', 'Administrator', 'admin', 'active');

-- Insert default categories
INSERT INTO categories (name, slug, description) VALUES
('Technology', 'technology', 'Technology related articles'),
('Design', 'design', 'Design and UX articles'),
('Business', 'business', 'Business and entrepreneurship'),
('News', 'news', 'Latest news and updates');

-- Insert default tags
INSERT INTO tags (name, slug) VALUES
('PHP', 'php'),
('JavaScript', 'javascript'),
('Web Development', 'web-development'),
('Frontend', 'frontend'),
('Backend', 'backend'),
('Database', 'database'),
('API', 'api');

-- Insert default settings
INSERT INTO settings (key, value) VALUES
('site_name', 'Movable Type'),
('site_tagline', 'A modern blogging platform'),
('site_description', 'Welcome to Movable Type - A robust blogging and content management system'),
('posts_per_page', '10'),
('comments_enabled', 'true'),
('require_comment_moderation', 'true'),
('timezone', 'UTC'),
('date_format', 'Y-m-d'),
('time_format', 'H:i:s');
