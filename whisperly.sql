DROP DATABASE whisprly; CREATE DATABASE whisprly;
use whisprly;
-- USERS TABLE



CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('listener', 'creator', 'admin') DEFAULT 'listener',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FULLTEXT(name, email)
) ENGINE=InnoDB;



CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- PODCASTS TABLE
CREATE TABLE podcasts (
    podcast_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    cover_image VARCHAR(255),
    created_by INT NOT NULL,
    status ENUM('published', 'pending', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FULLTEXT(title, description),
    FOREIGN KEY (created_by) REFERENCES users(user_id) ON DELETE CASCADE 
) ENGINE=InnoDB;



CREATE TABLE podcast_categories (
    podcast_id INT,
    category_id INT,
    PRIMARY KEY (podcast_id, category_id),
    FOREIGN KEY (podcast_id) REFERENCES podcasts(podcast_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
) ENGINE=InnoDB;


-- EPISODES TABLE
CREATE TABLE episodes (
    episode_id INT AUTO_INCREMENT PRIMARY KEY,
    podcast_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    audio_file VARCHAR(255) NOT NULL,
    duration INT, -- in seconds
    release_date DATE,
    FULLTEXT(title),
    FOREIGN KEY (podcast_id) REFERENCES podcasts(podcast_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- BOOKS TABLE
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    description TEXT,
    pdf_file VARCHAR(255) NOT NULL,
    created_by VARBINARY(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FULLTEXT(title, description)
) ENGINE=InnoDB;

CREATE TABLE book_categories (
    book_id INT,
    category_id INT,
    PRIMARY KEY (book_id, category_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- SUBSCRIPTIONS TABLE (many-to-many: users ↔ podcasts)
CREATE TABLE subscriptions (
    subscription_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    podcast_id INT NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, podcast_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (podcast_id) REFERENCES podcasts(podcast_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- DOWNLOADS TABLE (many-to-many: users ↔ books)
CREATE TABLE downloads (
    download_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    downloaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, book_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- OPTIONAL: ADMIN LOGS TABLE
CREATE TABLE admin_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action_type ENUM('approve', 'reject', 'ban', 'unban', 'delete') NOT NULL,
    target_type ENUM('user', 'podcast', 'book','episode') NOT NULL,
    target_id INT NOT NULL,
    notes TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB;


-- ---------------------------------------------------------
--            			insert all



INSERT INTO users (name, email, password, role) VALUES
('John Doe', 'john.doe@example.com', 'password1', 'listener'),
('Jane Smith', 'jane.smith@example.com', 'password2', 'creator'),
('Peter Jones', 'peter.jones@example.com', 'password3', 'admin'),
('Alice Brown', 'alice.brown@example.com', 'password4', 'listener'),
('Bob Green', 'bob.green@example.com', 'password5', 'creator'),
('Charlie White', 'charlie.white@example.com', 'password6', 'listener'),
('David Black', 'david.black@example.com', 'password7', 'creator'),
('Eve Grey', 'eve.grey@example.com', 'password8', 'listener'),
('Frank Blue', 'frank.blue@example.com', 'password9', 'admin'),
('Grace Red', 'grace.red@example.com', 'password10', 'listener');





INSERT INTO categories (name, description) VALUES
('Technology', 'Podcasts about the latest tech trends'),
('Health & Wellness', 'Topics on mental and physical health'),
('Business', 'Discussions on entrepreneurship and finance'),
('Entertainment', 'Movies, TV shows, and pop culture'),
('Education', 'Learning resources and academic talks'),
('Sports', 'News and discussions about various sports'),
('Gaming', 'Video game reviews and industry news'),
('Music', 'Analysis and discovery of music genres'),
('Lifestyle', 'General topics on everyday life'),
('Science', 'Deep dives into scientific discoveries'),
('History', 'Exploring historical events'),
('Food', 'Cooking, recipes, and culinary discussions'),
('Travel', 'Exploring places and cultures'),
('Comedy', 'Lighthearted humor and comedy shows'),
('News', 'Breaking news and current events'),
('Personal Development', 'Growth, habits, and self-improvement'),
('Parenting', 'Guidance and experiences on raising children'),
('Politics', 'Discussions on government and policy'),
('Art & Design', 'Creativity, design, and artistic pursuits'),
('Relationships', 'Topics on love, dating, and friendships');


-- Inserting 10 rows into the podcasts table
INSERT INTO podcasts (title, description, created_by, status) VALUES
('Tech Talk', 'Discussions about the latest technology trends.', 2, 'published'),
('Mystery Hour', 'A podcast featuring thrilling mystery stories.', 5, 'published'),
('Cooking Corner', 'Delicious recipes and cooking tips for everyone.', 2, 'published'),
('History Uncovered', 'Exploring fascinating events from the past.', 5, 'pending'),
('Science Today', 'Breaking down the latest scientific discoveries.', 2, 'published'),
('Book Club', 'Conversations about popular and classic literature.', 5, 'published'),
('Travel Diaries', 'Adventures and insights from around the world.', 2, 'pending'),
('Music Mania', 'Exploring different genres and artists.', 5, 'published'),
('Gaming Zone', 'News and reviews about video games and esports.', 2, 'published'),
('Mind Matters', 'Discussions about psychology and mental well-being.', 5, 'published');

-- Inserting 10 rows into the episodes table
INSERT INTO episodes (podcast_id, title, audio_file, duration, release_date) VALUES
(1, 'The Future of AI', 'ai_future.mp3', 2700, '2025-05-18'),
(2, 'The Case of the Missing Diamond', 'missing_diamond.mp3', 3200, '2025-05-22'),
(3, 'Easy Pasta Recipes', 'pasta_recipes.mp3', 1900, '2025-05-25'),
(4, 'The Roman Empire', 'roman_empire.mp3', 3600, '2025-05-29'),
(5, 'Quantum Physics Explained', 'quantum_physics.mp3', 2100, '2025-06-01'),
(6, 'Discussing "To Kill a Mockingbird"', 'mockingbird_discussion.mp3', 2900, '2025-06-05'),
(7, 'Backpacking in Southeast Asia', 'southeast_asia.mp3', 2500, '2025-06-08'),
(8, 'The History of Rock and Roll', 'rock_n_roll_history.mp3', 3100, '2025-06-12'),
(9, 'The Latest in VR Technology', 'vr_tech.mp3', 2300, '2025-06-15'),
(10, 'Understanding Anxiety', 'understanding_anxiety.mp3', 2800, '2025-06-19');

-- Inserting 10 rows into the books table
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Data Science Handbook', 'A comprehensive guide to data science.', 'data_science_handbook.pdf', 'ali 1'),
('The Silent Patient', 'A psychological thriller novel.', 'silent_patient.pdf', 'ali 1'),
('Mastering French Cuisine', 'An advanced cookbook for French dishes.', 'french_cuisine.pdf', 'ali 1'),
('Sapiens: A Brief History of Humankind', 'Exploring the history of our species.', 'sapiens.pdf', 'ali 1'),
('Cosmos', 'A popular science book by Carl Sagan.', 'cosmos.pdf', 'ali 1'),
('Pride and Prejudice', 'A classic novel by Jane Austen.', 'pride_prejudice.pdf',  'ali 1'),
('Into the Wild', 'A true story of a young man\'s adventures.', 'into_the_wild.pdf',  'ali 1'),
('The Art of War', 'An ancient Chinese military treatise.', 'art_of_war.pdf',  'ali 1'),
('Ready Player One', 'A science fiction adventure novel.', 'ready_player_one.pdf',  'ali 1'),
('Thinking, Fast and Slow', 'A book about the two systems that drive how we think.', 'thinking_fast_slow.pdf',  'ali 1');



INSERT INTO podcast_categories (podcast_id, category_id) VALUES
(1, 3), (1, 5), (1, 7), (1, 10),
(2, 1), (2, 4), (2, 9), (2, 15),
(3, 2), (3, 6), (3, 8), (3, 12),
(4, 5), (4, 11), (4, 14), (4, 18),
(5, 7), (5, 13), (5, 16), (5, 19),
(6, 3), (6, 8), (6, 10), (6, 15),
(7, 4), (7, 9), (7, 12), (7, 17),
(8, 2), (8, 6), (8, 14), (8, 20),
(9, 1), (9, 11), (9, 16), (9, 19),
(10, 5), (10, 7), (10, 13), (10, 18);



-- Inserting 10 rows into the subscriptions table
INSERT INTO subscriptions (user_id, podcast_id) VALUES
(1, 1),
(1, 2),
(4, 3),
(7, 4),
(10, 5),
(2, 6),
(5, 7),
(8, 8),
(3, 9),
(6, 10);

-- Inserting 10 rows into the downloads table
INSERT INTO downloads (user_id, book_id) VALUES
(1, 1),
(4, 2),
(7, 3),
(10, 4),
(2, 5),
(5, 6),
(8, 7),
(3, 8),
(6, 9),
(9, 10);



INSERT INTO book_categories (book_id, category_id) VALUES
(1, 1),
(2, 1),
(9, 1),
(4, 1),
(1, 8),
(4, 2),
(7, 3),
(10, 4),
(2, 5),
(5, 6),
(8, 7),
(3, 8),
(6, 9),
(9, 10);

-- Inserting 10 rows into the admin_logs table
INSERT INTO admin_logs (admin_id, action_type, target_type, target_id, notes) VALUES
(3, 'approve', 'podcast', 1, 'Approved initial podcast content.'),
(9, 'reject', 'book', 2, 'Did not meet quality standards.'),
(3, 'ban', 'user', 4, 'Spamming comments.'),
(9, 'unban', 'user', 4, 'User appealed ban.'),
(3, 'delete', 'episode', 1, 'Outdated episode.'),
(9, 'approve', 'podcast', 3, 'Good educational content.'),
(3, 'reject', 'book', 5, 'Poor formatting.'),
(9, 'delete', 'user', 7, 'Inactive account.'),
(3, 'approve', 'episode', 2, 'Informative content.'),
(9, 'ban', 'podcast', 6, 'Copyright infringement.');



