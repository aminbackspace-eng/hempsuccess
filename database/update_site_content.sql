CREATE TABLE IF NOT EXISTS site_content (
    id INT AUTO_INCREMENT PRIMARY KEY,
    section_name VARCHAR(50) NOT NULL UNIQUE,
    content_key VARCHAR(50) NOT NULL,
    content_value TEXT,
    UNIQUE KEY section_key (section_name, content_key)
);

INSERT INTO site_content (section_name, content_key, content_value) VALUES 
('about', 'title', 'Why Hemp SEO is Different'),
('about', 'subtitle', 'Hemp, CBD, vape, and cannabis SEO is COMPLETELY different from normal industries. Here\'s why:'),
('contact', 'email', 'info@hempsuccess.com'),
('contact', 'phone', '(555) 123-4567'),
('contact', 'address', '123 Hemp Street, Denver, CO 80202');
