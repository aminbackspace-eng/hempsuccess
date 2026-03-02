CREATE TABLE IF NOT EXISTS resources (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(50), -- E-Book, Case Study, Checklist, etc.
    icon_class VARCHAR(50),
    link VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO resources (title, description, type, icon_class, link) VALUES 
('The Ultimate Guide to CBD SEO in 2025', 'Learn how to navigate Google\'s strict regulations and rank your CBD brand on the first page.', 'E-Book', 'ri-book-open-line', '#'),
('300% Growth in Organic Traffic', 'A deep dive into how we helped a boutique hemp brand scale from 1k to 50k monthly visitors.', 'Case Study', 'ri-line-chart-line', '#'),
('CBD Compliance SEO Checklist', 'Don\'t get de-indexed. Follow our 25-point checklist to ensure your content stays compliant.', 'Checklist', 'ri-shield-check-line', '#');
