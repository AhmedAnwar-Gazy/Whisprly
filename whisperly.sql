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
    photo VARCHAR(255),
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
('Mind Matters', 'Discussions about psychology and mental well-being.', 5, 'published'),
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



-- Technology
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Sapiens: A Brief History of Humankind', 'While a history book, it prominently features the impact of technological revolutions (like the Agricultural and Scientific Revolutions) on humanity''s development, making it highly relevant to understanding our technological trajectory.', 'sapiens_tech.pdf', 'Yuval Noah Harari'),
('Zero to One: Notes on Startups, or How to Build the Future', 'Peter Thiel, co-founder of PayPal, discusses how true innovation comes from creating something entirely new ("zero to one") rather than incrementally improving existing ideas ("one to n"), with a focus on building technology companies.', 'zero_to_one_tech.pdf', 'Peter Thiel'),
('Life 3.0: Being Human in the Age of Artificial Intelligence', 'Explores the implications of artificial intelligence, from its potential to solve global problems to existential risks. It provides a comprehensive overview of AI''s future and how humanity can shape it.', 'life_3.0.pdf', 'Max Tegmark'),
('Superintelligence: Paths, Dangers, Strategies', 'Nick Bostrom examines the potential risks and opportunities of advanced artificial intelligence, delving into the challenges of controlling a superintelligent AI and ensuring its alignment with human values.', 'superintelligence.pdf', 'Nick Bostrom'),
('The Second Machine Age: Work, Progress, and Prosperity in a Time of Brilliant Technologies', 'Analyzes how digital technologies are transforming the economy and society, discussing the challenges and opportunities presented by automation, AI, and the digital revolution.', 'second_machine_age.pdf', 'Erik Brynjolfsson and Andrew McAfee'),
('Clean Code: A Handbook of Agile Software Craftsmanship', 'A foundational book for software developers, emphasizing principles and practices for writing clean, readable, and maintainable code. It''s essential for aspiring and experienced programmers.', 'clean_code.pdf', 'Robert C. Martin'),
('Ghost in the Wires: My Adventures as the World''s Most Wanted Hacker', 'Kevin Mitnick''s autobiography, recounting his journey from a curious computer enthusiast to the FBI''s most wanted hacker, offering an inside look at social engineering and cybercrime.', 'ghost_in_the_wires.pdf', 'Kevin Mitnick'),
('Digital Minimalism: Choosing a Focused Life in a Noisy World', 'Cal Newport argues for a philosophy of technology use that focuses on cultivating a small number of high-value online activities and intentionally avoiding distractions, promoting a healthier relationship with digital tools.', 'digital_minimalism_tech.pdf', 'Cal Newport'),
('The Innovators: How a Group of Hackers, Geniuses, and Geeks Created the Digital Revolution', 'Walter Isaacson chronicles the history of the digital revolution, focusing on the brilliant individuals who pioneered computing, the internet, and artificial intelligence, and how collaboration shaped their innovations.', 'the_innovators.pdf', 'Walter Isaacson'),
('Scarcity: Why Having Too Little Means So Much', 'While a psychology book, it has significant implications for understanding technology use and its impact on decision-making, particularly how constant notifications and digital demands create a "scarcity mindset" for attention and time.', 'scarcity.pdf', 'Sendhil Mullainathan and Eldar Shafir');




-- Health
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones', 'A comprehensive, practical guide on how to change your habits and get 1% better every day. It introduces a framework called the Four Laws of Behavior Change for creating good habits and breaking bad ones, emphasizing that small, consistent improvements lead to significant long-term results.', 'atomic_habits.pdf', 'James Clear'),
('The Body Keeps the Score: Brain, Mind, and Body in the Healing of Trauma', 'A groundbreaking exploration of how traumatic stress affects the mind and body, drawing on decades of research and clinical practice. It delves into the neurobiology of trauma and offers new paths to recovery that integrate brain science, attachment research, and body awareness.', 'the_body_keeps_the_score.pdf', 'Bessel van der Kolk'),
('Outlive: The Science and Art of Longevity', 'A book by Dr. Peter Attia that advocates for a proactive, preventative approach to health and aging, focusing on extending "healthspan" (the portion of life free from disability or disease). It identifies "The Four Horsemen" of aging (heart disease, cancer, neurodegenerative disease, and type 2 diabetes) and provides strategies related to exercise, nutrition, sleep, and emotional health.', 'outlive.pdf', 'Peter Attia, MD'),
('Breath: The New Science of a Lost Art', 'An investigation into the hidden power of breathing and its profound impact on physical and mental health. It explores the history of human breathing, contrasting nasal breathing with chronic mouth breathing, and presents research on how conscious breathing can improve various health conditions.', 'breath_the_new_science.pdf', 'James Nestor'),
('How Not to Die: Discover the Foods Scientifically Proven to Prevent and Reverse Disease', 'A deeply researched book on plant-based nutrition, providing scientifically-proven advice to prevent and even reverse common diseases. It details how different foods affect the body and offers Dr. Greger''s "Daily Dozen" – a list of foods to consume daily for optimal health.', 'how_not_to_die.pdf', 'Michael Greger M.D. FACLM'),
('The Subtle Art of Not Giving a F*ck: A Counterintuitive Approach to Living a Good Life', 'A self-help book that challenges conventional positive thinking, arguing that embracing life''s struggles and focusing on what truly matters leads to a more meaningful existence. It encourages readers to choose what they care about and to develop values they can control.', 'the_subtle_art.pdf', 'Mark Manson'),
('The Anxious Generation: How the Great Rewiring of Childhood Is Causing an Epidemic of Mental Illness', 'A timely book by Jonathan Haidt that examines the dramatic rise in mental illness among young people, linking it to the widespread use of smartphones, social media, and overprotective parenting. It explores the "great rewiring" of childhood and proposes solutions for a healthier development.', 'the_anxious_generation.pdf', 'Jonathan Haidt'),
('Good Energy: The Surprising Connection Between Metabolism and Limitless Health', 'This book by Dr. Casey Means explains how nearly every health problem can be traced back to how well our cells create and use energy. It offers a framework for understanding and improving metabolic health, providing actionable steps and insights into diet, sleep, exercise, and navigating the medical system.', 'good_energy.pdf', 'Casey Means MD'),
('The Four Agreements: A Practical Guide to Personal Freedom (A Toltec Wisdom Book)', 'A spiritual and self-help classic based on ancient Toltec wisdom. It presents four guiding principles – Be Impeccable With Your Word, Don''t Take Anything Personally, Don''t Make Assumptions, and Always Do Your Best – for transforming life, achieving personal freedom, and finding happiness.', 'the_four_agreements.pdf', 'Don Miguel Ruiz'),
('Young Forever: The Secrets to Living Your Longest, Healthiest Life', 'Dr. Mark Hyman’s guide to reversing disease, easing pain, and living younger longer. It challenges the idea that decline is inevitable with aging, exploring the biological hallmarks of aging and offering dietary, lifestyle, and emerging longevity strategies, including his "Pegan Diet."', 'young_forever.pdf', 'Mark Hyman, MD');

-- Business
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones', 'While often categorized as self-help, its principles on habit formation are directly applicable to business productivity, leadership, and personal growth within a professional context. It teaches how small, consistent changes can lead to remarkable results.', 'atomic_habits_business.pdf', 'James Clear'),
('How to Win Friends & Influence People', 'A timeless classic on interpersonal skills, communication, and persuasion. It offers practical advice on how to handle people, win them over, and influence them, essential for sales, leadership, and networking.', 'how_to_win_friends.pdf', 'Dale Carnegie'),
('The 7 Habits of Highly Effective People', 'A seminal work on personal and professional effectiveness. It outlines a principle-centered approach to living that emphasizes proactive behavior, goal-setting, prioritization, and interdependence for greater success in business and life.', '7_habits.pdf', 'Stephen Covey'),
('Good to Great: Why Some Companies Make the Leap...and Others Don''t', 'Based on extensive research, this book identifies key characteristics and practices that distinguish companies that achieve sustained greatness from those that remain merely good. It introduces concepts like Level 5 Leadership and the Hedgehog Concept.', 'good_to_great.pdf', 'Jim Collins'),
('Rich Dad Poor Dad', 'A personal finance classic that challenges conventional wisdom about money and work. It advocates for financial literacy, investing, and building assets that generate income, rather than just working for a salary.', 'rich_dad_poor_dad.pdf', 'Robert Kiyosaki'),
('Think and Grow Rich', 'One of the earliest and most influential self-help and business books, based on Napoleon Hill''s study of successful individuals. It outlines principles like desire, faith, specialized knowledge, and persistence for achieving wealth and success.', 'think_and_grow_rich.pdf', 'Napoleon Hill'),
('The Psychology of Money: Timeless Lessons on Wealth, Greed, and Happiness', 'Explores the often irrational human behaviors around money and investing. It offers insights into how our emotions, biases, and experiences shape our financial decisions, regardless of our intelligence or education.', 'psychology_of_money.pdf', 'Morgan Housel'),
('Dare to Lead: Brave Work. Tough Conversations. Whole Hearts.', 'Brené Brown applies her research on vulnerability, courage, and shame to the realm of leadership. She argues that true leadership requires daring to be vulnerable, having tough conversations, and leading with empathy and authenticity.', 'dare_to_lead.pdf', 'Brené Brown'),
('Zero to One: Notes on Startups, or How to Build the Future', 'Peter Thiel, co-founder of PayPal, discusses how true innovation comes from creating something entirely new ("zero to one") rather than incrementally improving existing ideas ("one to n"). It offers unique perspectives on startups and monopolies.', 'zero_to_one.pdf', 'Peter Thiel'),
('The 4-Hour Workweek: Escape 9-5, Live Anywhere, and Join the New Rich', 'Tim Ferriss challenges the traditional concept of work and retirement. He advocates for "lifestyle design," leveraging automation, outsourcing, and efficiency to create a life of financial freedom and more leisure time.', '4_hour_workweek.pdf', 'Tim Ferriss');


-- Entertainment
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('All You Need to Know About the Music Business', 'Universally regarded as the definitive guide to the music industry, covering topics such as record deals, publishing, copyrights, touring, merchandising, and the profound changes brought by streaming.', 'all_you_need_music_biz.pdf', 'Donald S. Passman'),
('Adventures in the Screen Trade: A Personal View of Hollywood and Screenwriting', 'A candid and witty look at the realities of Hollywood filmmaking from the perspective of a two-time Oscar-winning screenwriter. It offers insights into the script-to-screen process and the often-absurd nature of the industry.', 'adventures_screen_trade.pdf', 'William Goldman'),
('No Rules Rules: Netflix and the Culture of Reinvention', 'Co-authored by Netflix CEO Reed Hastings, this book details the unique and often unconventional company culture that enabled Netflix''s success, emphasizing freedom and responsibility in a creative industry.', 'no_rules_rules.pdf', 'Reed Hastings and Erin Meyer'),
('Easy Riders, Raging Bulls: How the Sex-Drugs-and-Rock \'n\' Roll Generation Saved Hollywood', 'A captivating and controversial account of the "New Hollywood" era of the late 1960s and early 1970s, detailing the rise of auteur directors and the seismic shifts in the film industry.', 'easy_riders_raging_bulls.pdf', 'Peter Biskind'),
('The Artist''s Way: A Spiritual Path to Higher Creativity', 'While a general self-help book, it has been immensely influential in creative fields, including entertainment. It provides a twelve-week program to help people discover and recover their creative selves.', 'the_artists_way.pdf', 'Julia Cameron'),
('I''m Glad My Mom Died', 'A critically acclaimed and best-selling memoir by actress Jennette McCurdy, offering a raw and honest look at her experiences as a child star and her complex relationship with her mother and the entertainment industry.', 'im_glad_my_mom_died.pdf', 'Jennette McCurdy'),
('Live from New York: An Uncensored History of Saturday Night Live', 'An oral history providing a comprehensive and often hilarious behind-the-scenes look at the iconic sketch comedy show, featuring interviews with cast members, writers, and producers across its decades.', 'live_from_new_york.pdf', 'James Andrew Miller and Tom Shales'),
('The Ride of a Lifetime: Lessons Learned from 15 Years as CEO of the Walt Disney Company', 'Robert Iger''s memoir offers invaluable insights into leadership, innovation, and navigating massive media mergers and acquisitions during his tenure transforming Disney into a global entertainment powerhouse.', 'ride_of_a_lifetime.pdf', 'Robert Iger'),
('Cinema Speculation', 'Quentin Tarantino''s first non-fiction book is a deep dive into film history and criticism, offering his unique perspective on various movies and the evolution of cinema, appealing to film enthusiasts and industry insiders.', 'cinema_speculation.pdf', 'Quentin Tarantino'),
('This is Your Brain on Music: The Science of a Human Obsession', 'Daniel J. Levitin explores the neuroscience of music, explaining how our brains process, create, and enjoy music. While not strictly "industry," it offers a fascinating look at the core of what entertainment means to us.', 'brain_on_music.pdf', 'Daniel J. Levitin');


-- Education 
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Mindset: The New Psychology of Success', 'Explores the power of "growth mindset" versus "fixed mindset" and how these beliefs profoundly impact learning, achievement, and personal development in educational and professional settings.', 'mindset_education.pdf', 'Carol S. Dweck'),
('Drive: The Surprising Truth About What Motivates Us', 'Challenges traditional views on motivation, arguing for the importance of autonomy, mastery, and purpose in driving performance and engagement in learning and work environments.', 'drive_education.pdf', 'Daniel H. Pink'),
('Pedagogy of the Oppressed', 'A foundational text in critical pedagogy, advocating for a form of education that fosters critical consciousness and empowers marginalized individuals to challenge oppressive systems.', 'pedagogy_oppressed.pdf', 'Paulo Freire'),
('Teach Like a Champion 3.0: 63 Techniques that Put Students on the Path to College', 'A highly practical guide offering specific, actionable techniques for classroom management, student engagement, and instructional delivery to improve teaching effectiveness and student outcomes.', 'teach_like_a_champion.pdf', 'Doug Lemov'),
('Make It Stick: The Science of Successful Learning', 'Synthesizes research on cognitive psychology to reveal effective learning strategies that go beyond common but less effective methods, focusing on retrieval practice, interleaving, and elaboration.', 'make_it_stick.pdf', 'Peter C. Brown, Henry L. Roediger III, Mark A. McDaniel'),
('Why Don''t Students Like School? A Cognitive Scientist Answers Questions About How the Mind Works and What It Means for the Classroom', 'Applies principles of cognitive science to answer common questions about learning, memory, and motivation, providing insights for educators on how to design more effective instruction.', 'why_dont_students_like_school.pdf', 'Daniel T. Willingham'),
('Discipline Without Tears: A Long-Term Approach to Child Development', 'A classic guide for parents and educators on fostering self-discipline in children through respectful and understanding approaches, moving beyond punitive methods to long-term skill building.', 'discipline_without_tears.pdf', 'Rudolf Dreikurs and Pearl Cassel'),
('The Element: How Finding Your Passion Changes Everything', 'Explores the importance of finding one''s "element" – the point where natural aptitude meets personal passion – and how educational systems can help or hinder this discovery, fostering creativity and fulfillment.', 'the_element.pdf', 'Ken Robinson'),
('Differentiated Instruction: Meeting the Needs of All Learners', 'Provides a comprehensive framework and practical strategies for tailoring instruction to meet the diverse learning needs of students in the same classroom, ensuring all students can achieve success.', 'differentiated_instruction.pdf', 'Carol Ann Tomlinson'),
('Educated: A Memoir', 'A powerful memoir about a young woman''s journey from a fundamentalist, survivalist upbringing in rural Idaho to earning a PhD from Cambridge University, highlighting the transformative power of education.', 'educated_memoir.pdf', 'Tara Westover');

-- Sports
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('The Boys in the Boat: Nine Americans and Their Epic Quest for Gold at the 1936 Berlin Olympics', 'The inspiring true story of the University of Washington’s rowing team, who overcame immense challenges during the Great Depression to compete at the 1936 Berlin Olympics and win gold, captivating the world.', 'boys_in_the_boat.pdf', 'Daniel James Brown'),
('Shoe Dog: A Memoir by the Creator of Nike', 'Nike co-founder Phil Knight shares the candid and compelling story of the company’s early days as a bold startup and its evolution into one of the world''s most iconic and profitable brands.', 'shoe_dog.pdf', 'Phil Knight'),
('Open: An Autobiography', 'A brutally honest and introspective autobiography by tennis legend Andre Agassi, detailing his tumultuous career, personal struggles, and complicated relationship with the sport.', 'open_agassi.pdf', 'Andre Agassi'),
('The Mamba Mentality: How I Play', 'Kobe Bryant''s deep dive into his legendary "Mamba Mentality," offering readers insights into his unparalleled approach to basketball, relentless dedication, and meticulous preparation for greatness.', 'mamba_mentality.pdf', 'Kobe Bryant'),
('Born to Run: A Hidden Tribe, Superathletes, and the Greatest Race the World Has Never Seen', 'Explores the science and culture of ultra-running, following a journalist''s quest to uncover the secrets of the Tarahumara Indians, a tribe of super-runners, and challenging conventional wisdom about human endurance.', 'born_to_run.pdf', 'Christopher McDougall'),
('The Inner Game of Tennis: The Classic Guide to the Mental Side of Peak Performance', 'A groundbreaking book that revolutionized sports psychology, teaching athletes how to overcome mental obstacles, quiet self-doubt, and tap into their full potential through self-awareness and focus.', 'inner_game_tennis.pdf', 'W. Timothy Gallwey'),
('Friday Night Lights: A Town, a Team, and a Dream', 'A powerful and intimate look at the obsession with high school football in Odessa, Texas, and its profound impact on the lives of players, coaches, and the community.', 'friday_night_lights.pdf', 'H.G. Bissinger'),
('Seabiscuit: An American Legend', 'The true story of an undersized, crooked-legged racehorse that became an unlikely champion during the Great Depression, capturing the imagination of a nation and symbolizing hope.', 'seabiscuit.pdf', 'Laura Hillenbrand'),
('Into Thin Air: A Personal Account of the Mt. Everest Disaster', 'Jon Krakauer''s gripping and harrowing firsthand account of the disastrous 1996 climbing season on Mount Everest, exploring the dangers and ethical dilemmas of high-altitude mountaineering.', 'into_thin_air.pdf', 'Jon Krakauer'),
('The Sports Gene: Inside the Science of Extraordinary Athletic Performance', 'Investigates the complex interplay of nature vs. nurture in athletic ability, examining how genetics, training, and environment contribute to peak human performance across various sports.', 'the_sports_gene.pdf', 'David Epstein');

-- Gaming
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Ready Player One', 'A science fiction novel set in a dystopian future where humanity largely escapes into a virtual reality world called the OASIS. It''s a treasure hunt story filled with 1980s pop culture and gaming references, including its central plot revolving around an elaborate Easter egg hunt.', 'ready_player_one.pdf', 'Ernest Cline'),
('Blood, Sweat, and Pixels: The Triumphant, Turbulent Stories Behind How Video Games Are Made', 'A compelling look behind the curtain at the grueling, often chaotic process of video game development, featuring in-depth stories of various games from inception to release, highlighting challenges and triumphs.', 'blood_sweat_pixels.pdf', 'Jason Schreier'),
('Console Wars: Sega, Nintendo, and the Battle That Defined a Generation', 'An inside account of the fierce rivalry between Sega and Nintendo in the early 1990s, chronicling how Sega, a small challenger, took on the mighty Nintendo and revolutionized the video game industry.', 'console_wars.pdf', 'Blake J. Harris'),
('Masters of Doom: How Two Guys Created an Empire and Transformed Pop Culture', 'The fascinating true story of id Software''s John Carmack and John Romero, the brilliant and often clashing creators behind seminal video games like Doom and Quake, and their impact on the gaming world.', 'masters_of_doom.pdf', 'David Kushner'),
('Extra Lives: Why Video Games Matter', 'A collection of essays exploring the cultural significance, artistic potential, and personal impact of video games, delving into topics like narrative, identity, and the evolution of the medium.', 'extra_lives.pdf', 'Tom Bissell'),
('Jesse Schell''s Art of Game Design: A Book of Lenses', 'A comprehensive and widely-used textbook on game design, offering over 100 "lenses" or perspectives to help designers think about their games from various angles, from player psychology to mechanics.', 'art_of_game_design.pdf', 'Jesse Schell'),
('Press Reset: Ruin and Recovery in the Video Game Industry', 'Following up on "Blood, Sweat, and Pixels," this book delves into the aftermath of game studio closures and massive layoffs, exploring the human cost and the challenges of restarting careers in the volatile industry.', 'press_reset.pdf', 'Jason Schreier'),
('Gamification: How Motivation Turns Big Data into Action', 'Explores how game design elements and game-thinking can be applied to non-game contexts, such as business, education, and health, to engage users and solve problems by leveraging human motivation.', 'gamification_book.pdf', 'Yu-kai Chou'),
('Minecraft: The Unofficial Guide to Minecraft & Other Games', 'While many Minecraft books exist, official and unofficial guides that help players master the game, its mechanics, and creative building often top best-seller lists in the gaming niche. This represents the genre.', 'minecraft_unofficial_guide.pdf', 'Dan Miller'),
('The Legend of Zelda: Hyrule Historia', 'An official, comprehensive tome celebrating the history, artwork, and lore of Nintendo''s iconic "Legend of Zelda" series, featuring concept art, historical documents, and a timeline of the games.', 'hyrule_historia.pdf', 'Shigeru Miyamoto and Akira Himekawa');

-- Music
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('All You Need to Know About the Music Business', 'Universally regarded as the definitive guide to the music industry, covering topics such as record deals, publishing, copyrights, touring, merchandising, and the profound changes brought by streaming. It''s essential for anyone navigating the complexities of the modern music landscape.', 'all_you_need_music_biz.pdf', 'Donald S. Passman'),
('This Is Your Brain On Music: The Science of a Human Obsession', 'A fascinating exploration by a neuroscientist into how our brains process, create, and enjoy music. It delves into the cognitive and neurological underpinnings of musical experience, explaining why music affects us so deeply.', 'brain_on_music.pdf', 'Daniel J. Levitin'),
('The Rest Is Noise: Listening to the Twentieth Century', 'A panoramic and critically acclaimed survey of 20th-century music, tracing its historical, cultural, and political contexts. It explores major composers, movements, and the social forces that shaped the sound of the modern era.', 'the_rest_is_noise.pdf', 'Alex Ross'),
('Chronicles: Volume One', 'Bob Dylan''s highly acclaimed and enigmatic memoir, offering fragmented but deeply insightful reflections on his early life, musical influences, and the formative years of his career in New York City.', 'chronicles_volume_one.pdf', 'Bob Dylan'),
('Musicophilia: Tales of Music and the Brain', 'A collection of captivating clinical tales by the renowned neurologist Oliver Sacks, exploring the profound and often strange ways music interacts with the human brain, from amnesia to musical hallucinations.', 'musicophilia.pdf', 'Oliver Sacks'),
('The Beautiful Ones', 'Prince''s posthumously published memoir, offering an intimate and revealing look at his early life, creative process, and the evolution of his artistic vision, complete with never-before-seen photos and handwritten lyrics.', 'the_beautiful_ones.pdf', 'Prince'),
('How Music Works', 'David Byrne explores the multifaceted nature of music, from its creation and performance to its business and cultural impact. He delves into how technology, architecture, and economics shape the way music is made and consumed.', 'how_music_works.pdf', 'David Byrne'),
('Respect: The Life of Aretha Franklin', 'A definitive biography of the "Queen of Soul," tracing Aretha Franklin''s remarkable journey from her gospel roots to becoming a global icon, detailing her personal struggles and unparalleled musical legacy.', 'respect_aretha.pdf', 'David Ritz'),
('Can''t Stop Won''t Stop: A History of the Hip-Hop Generation', 'A comprehensive and vibrant history of hip-hop culture, tracing its origins in the Bronx and its evolution through the decades, exploring its political, social, and artistic impact on global youth culture.', 'cant_stop_wont_stop.pdf', 'Jeff Chang'),
('Tune In: The Beatles: All These Years, Volume One', 'The first volume of Mark Lewisohn''s exhaustive and meticulously researched biography of The Beatles, covering their origins and early years leading up to Beatlemania, offering unprecedented detail and insight.', 'tune_in_beatles.pdf', 'Mark Lewisohn');



-- Lifestyle
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('The Life-Changing Magic of Tidying Up: The Japanese Art of Decluttering and Organizing', 'Introduces the KonMari method of decluttering and organizing, encouraging readers to tidy by category and keep only items that "spark joy" to transform their homes and lives.', 'tidying_up.pdf', 'Marie Kondo'),
('The 5 AM Club: Own Your Morning. Elevate Your Life.', 'A motivational book that advocates for leveraging the early morning hours (the "5 AM Club") to boost productivity, improve health, and achieve personal mastery through a structured routine.', '5_am_club.pdf', 'Robin Sharma'),
('Where the Crawdads Sing', 'While primarily a fiction novel, its themes of self-reliance, connection with nature, and a unique way of life resonate deeply with lifestyle readers seeking a sense of peace and natural living. Its popularity often places it on broader best-seller lists.', 'where_the_crawdads_sing.pdf', 'Delia Owens'),
('Girl, Wash Your Face: Stop Believing the Lies About Who You Are So You Can Become Who You''re Meant to Be', 'A motivational and inspirational book for women, challenging common lies and insecurities that hold them back from living a full and joyful life, encouraging self-acceptance and ambition.', 'girl_wash_your_face.pdf', 'Rachel Hollis'),
('The Home Edit Life: The No-Guilt Guide to Owning What You Want and Organizing Everything', 'Offers practical and aesthetic organizing solutions, encouraging readers to embrace their clutter and find stylish ways to organize it, focusing on functionality and visual appeal for everyday living.', 'home_edit_life.pdf', 'Clea Shearer and Joanna Teplin'),
('You Are a Badass: How to Stop Doubting Your Greatness and Start Living an Awesome Life', 'A humorous and motivating self-help guide that encourages readers to identify and change the self-sabotaging beliefs and behaviors that prevent them from achieving their goals and living the life they desire.', 'you_are_a_badass.pdf', 'Jen Sincero'),
('The Book of Joy: Lasting Happiness in a Changing World', 'A dialogue between the Dalai Lama and Archbishop Desmond Tutu, sharing their wisdom on how to find joy and contentment even amidst suffering, offering insights into compassion, forgiveness, and gratitude for a fulfilling life.', 'book_of_joy.pdf', 'Dalai Lama XIV, Desmond Tutu, and Douglas Carlton Abrams'),
('The Alchemist', 'A philosophical novel that follows a young shepherd on a journey to find treasure, but ultimately discovers the importance of following one''s dreams, listening to one''s heart, and finding meaning in everyday life and experiences.', 'the_alchemist.pdf', 'Paulo Coelho'),
('The Four Agreements: A Practical Guide to Personal Freedom (A Toltec Wisdom Book)', 'A spiritual and self-help classic that offers a code of conduct based on ancient Toltec wisdom. It presents four principles for transforming one''s life and achieving personal freedom and happiness, significantly impacting one''s daily mindset and interactions.', 'the_four_agreements_lifestyle.pdf', 'Don Miguel Ruiz'),
('Spark Joy: An Illustrated Master Class on the Art of Organizing and Tidying Up', 'A companion to "The Life-Changing Magic of Tidying Up," offering an illustrated, more detailed guide to the KonMari method, providing practical advice on organizing specific items and categories in the home.', 'spark_joy.pdf', 'Marie Kondo');



-- Science
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Sapiens: A Brief History of Humankind', 'A groundbreaking book that explores the entire history of humankind, from the emergence of Homo sapiens in the Stone Age to the present day, examining how biology and history have shaped our societies and individual personalities.', 'sapiens.pdf', 'Yuval Noah Harari'),
('Cosmos', 'An iconic journey through space and time, exploring the universe in all its vastness and complexity. It covers astronomy, physics, biology, and the history of scientific discovery, making fundamental scientific concepts understandable to a broad audience.', 'cosmos.pdf', 'Carl Sagan'),
('A Brief History of Time', 'Stephen Hawking''s seminal work that delves into the origins and nature of the universe, exploring concepts like black holes, the Big Bang, and the arrow of time in an accessible manner for non-specialists.', 'brief_history_of_time.pdf', 'Stephen Hawking'),
('The Selfish Gene', 'A highly influential book in evolutionary biology that popularized the gene-centered view of evolution. It argues that genes are the fundamental units of selection in evolution, rather than individuals or groups.', 'the_selfish_gene.pdf', 'Richard Dawkins'),
('The Immortal Life of Henrietta Lacks', 'The true story of Henrietta Lacks, whose cells were taken without her knowledge in 1951 and became the first immortal human cell line (HeLa cells), profoundly impacting medical research while raising ethical questions about consent and race.', 'immortal_life_henrietta_lacks.pdf', 'Rebecca Skloot'),
('The Demon-Haunted World: Science as a Candle in the Dark', 'A powerful argument for the importance of scientific thinking and skepticism in an age of pseudoscience and irrationality. Carl Sagan advocates for critical thinking and the scientific method as tools to understand the world.', 'demon_haunted_world.pdf', 'Carl Sagan'),
('Silent Spring', 'A landmark book that exposed the devastating environmental effects of pesticides, particularly DDT. It played a pivotal role in launching the modern environmental movement and leading to widespread changes in environmental policy.', 'silent_spring.pdf', 'Rachel Carson'),
('Thinking, Fast and Slow', 'A seminal work in cognitive psychology and behavioral economics. Daniel Kahneman explores the two systems that drive our thinking: System 1 (fast, intuitive) and System 2 (slow, logical), and how they influence our judgments and decisions.', 'thinking_fast_and_slow.pdf', 'Daniel Kahneman'),
('Guns, Germs, and Steel: The Fates of Human Societies', 'An ambitious and Pulitzer Prize-winning book that explores why human societies have developed so differently across continents, arguing that geographical and environmental factors, rather than racial differences, played a dominant role.', 'guns_germs_steel.pdf', 'Jared Diamond'),
('Entangled Life: How Fungi Make Our Worlds, Change Our Minds & Shape Our Futures', 'A fascinating exploration of the hidden world of fungi and their profound impact on life on Earth. It delves into their diverse roles in ecosystems, medicine, and human culture, revealing their interconnectedness with all life forms.', 'entangled_life.pdf', 'Merlin Sheldrake');



-- History
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Sapiens: A Brief History of Humankind', 'A sweeping overview of human history from the Stone Age to the 21st century, examining the major forces that have shaped humanity, including cognitive, agricultural, and scientific revolutions.', 'sapiens_history.pdf', 'Yuval Noah Harari'),
('A People''s History of the United States', 'A groundbreaking re-examination of American history from the perspective of marginalized groups – Native Americans, African Americans, laborers, and women – challenging traditional narratives.', 'peoples_history_us.pdf', 'Howard Zinn'),
('The Guns of August', 'A Pulitzer Prize-winning narrative history that vividly recounts the dramatic first month of World War I, detailing the key military and political decisions that shaped the devastating conflict.', 'guns_of_august.pdf', 'Barbara W. Tuchman'),
('1776', 'A compelling narrative account of the pivotal year of the American Revolution, focusing on the human drama and the challenges faced by George Washington and the Continental Army.', '1776_history.pdf', 'David McCullough'),
('Team of Rivals: The Political Genius of Abraham Lincoln', 'A masterful biography focusing on Abraham Lincoln''s unique leadership style during the Civil War, specifically his decision to appoint his political rivals to his cabinet and how he managed their conflicting egos for national unity.', 'team_of_rivals.pdf', 'Doris Kearns Goodwin'),
('The Rise and Fall of the Third Reich: A History of Nazi Germany', 'A monumental and comprehensive history of Nazi Germany, from its origins to its defeat, based on extensive documentation and personal accounts, providing a detailed and authoritative record.', 'rise_and_fall_third_reich.pdf', 'William L. Shirer'),
('SPQR: A History of Ancient Rome', 'A concise yet comprehensive history of ancient Rome, from its mythical beginnings to the rule of Emperor Caracalla, offering insights into its political, social, and cultural evolution through the lives of its key figures.', 'spqr_history.pdf', 'Mary Beard'),
('Salt: A World History', 'An engaging global history that explores the profound influence of salt on civilization, from ancient trade routes and economic power to its role in diet, preservation, and cultural rituals.', 'salt_history.pdf', 'Mark Kurlansky'),
('The Second World War', 'Winston Churchill''s six-volume history of World War II, written from his unique perspective as a key participant. It offers both a detailed account of events and a powerful personal narrative.', 'second_world_war.pdf', 'Winston S. Churchill'),
('Genghis Khan and the Making of the Modern World', 'Challenges the traditional barbarian image of Genghis Khan, arguing that his empire, far from being destructive, laid the foundations for many aspects of the modern world, including trade, law, and cultural exchange.', 'genghis_khan.pdf', 'Jack Weatherford');



-- Food
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Salt, Fat, Acid, Heat: Mastering the Elements of Good Cooking', 'A groundbreaking approach to cooking that breaks down the four essential elements that make food delicious. It combines detailed explanations with beautiful illustrations to teach readers how to understand and manipulate these elements to improve their cooking.', 'salt_fat_acid_heat.pdf', 'Samin Nosrat'),
('The Food Lab: Better Home Cooking Through Science', 'Applies a scientific approach to classic American dishes, explaining how ingredients and techniques work on a molecular level to produce optimal results. It''s a comprehensive guide to understanding cooking principles.', 'the_food_lab.pdf', 'J. Kenji López-Alt'),
('Omnivore''s Dilemma: A Natural History of Four Meals', 'Explores the industrial food chain, the organic food chain, and the hunter-gatherer food chain, examining the moral and ethical implications of what we eat and how it gets to our plates.', 'omnivores_dilemma.pdf', 'Michael Pollan'),
('Kitchen Confidential: Adventures in the Culinary Underbelly', 'Anthony Bourdain''s no-holds-barred memoir revealing the gritty, often hilarious, and sometimes shocking realities of professional kitchen life, forever changing how many viewed the restaurant industry.', 'kitchen_confidential.pdf', 'Anthony Bourdain'),
('Cooked: A Natural History of Transformation', 'Michael Pollan investigates the four classical elements—fire, water, air, and earth—and how they have been used to transform raw ingredients into cooked meals, delving into the history and science of cooking.', 'cooked.pdf', 'Michael Pollan'),
('Mastering the Art of French Cooking, Volume 1', 'A legendary cookbook that introduced French cuisine to American home cooks with clear, step-by-step instructions. It demystified classic French techniques and made them accessible to a wide audience.', 'mastering_french_cooking.pdf', 'Julia Child, Louisette Bertholle, Simone Beck'),
('The Joy of Cooking', 'One of the most widely published cookbooks in American history, offering a vast collection of recipes and culinary advice, making it a staple in countless kitchens for generations of home cooks.', 'joy_of_cooking.pdf', 'Irma S. Rombauer, Marion Rombauer Becker, Ethan Becker'),
('On Food and Cooking: The Science and Lore of the Kitchen', 'A comprehensive encyclopedia of food science, explaining the chemical and physical transformations of food ingredients during cooking. It''s an authoritative guide for anyone interested in the "why" behind cooking.', 'on_food_and_cooking.pdf', 'Harold McGee'),
('F*** That’s Delicious: An Annotated Guide to Eating Well', 'A cookbook and food travelogue by rapper Action Bronson, filled with recipes, stories, and photographs from his culinary adventures around the world, reflecting his unique and enthusiastic approach to food.', 'f_thats_delicious.pdf', 'Action Bronson'),
('Taste: My Life Through Food', 'A memoir by Stanley Tucci that interweaves personal anecdotes about his life, family, and acting career with his passion for food, recipes, and dining experiences, reflecting the profound role food plays in identity and connection.', 'taste_my_life_through_food.pdf', 'Stanley Tucci');



-- Travel 
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Into the Wild', 'The true story of Christopher McCandless, who gave up his comfortable life to venture into the Alaskan wilderness. It explores themes of idealism, nature, and the ultimate consequences of his solitary journey.', 'into_the_wild.pdf', 'Jon Krakauer'),
('Eat, Pray, Love: One Woman''s Search for Everything Across Italy, India and Indonesia', 'A memoir detailing the author''s year-long journey of self-discovery across three countries after a divorce, focusing on pleasure in Italy, devotion in India, and balance in Indonesia.', 'eat_pray_love.pdf', 'Elizabeth Gilbert'),
('Vagabonding: An Uncommon Guide to the Art of Long-Term World Travel', 'A philosophical and practical guide to long-term world travel, advocating for extended journeys and sabbaticals rather than short vacations. It covers planning, budgeting, and the mindset for immersive travel.', 'vagabonding.pdf', 'Rolf Potts'),
('A Walk in the Woods: Rediscovering America on the Appalachian Trail', 'A humorous and insightful account of Bill Bryson''s attempt to hike the Appalachian Trail. It blends his personal experiences with history, ecology, and the colorful characters he encounters along the way.', 'a_walk_in_the_woods.pdf', 'Bill Bryson'),
('On the Road', 'A seminal novel of the Beat Generation, chronicling the spontaneous cross-country road trips and adventures of a group of friends. It captures the restless spirit, yearning for freedom, and exploration of post-war America.', 'on_the_road.pdf', 'Jack Kerouac'),
('Wild: From Lost to Found on the Pacific Crest Trail', 'Cheryl Strayed''s memoir recounts her solo 1,100-mile hike on the Pacific Crest Trail after personal tragedies. It''s a powerful story of grief, resilience, and finding healing through nature and endurance.', 'wild_memoir.pdf', 'Cheryl Strayed'),
('The Geography of Bliss: One Grumpy Man''s Search for the Happiest Places in the World', 'Eric Weiner travels to various countries, from Iceland to Qatar, in search of the secrets to national happiness. It''s a witty exploration of culture, philosophy, and well-being around the globe.', 'geography_of_bliss.pdf', 'Eric Weiner'),
('Under the Tuscan Sun: At Home in Italy', 'Frances Mayes''s beloved memoir about buying and renovating an old villa in Tuscany, capturing the beauty, charm, and challenges of life in rural Italy and inspiring countless dreams of moving abroad.', 'under_the_tuscan_sun.pdf', 'Frances Mayes'),
('The Art of Travel', 'Alain de Botton explores the philosophy of travel, examining why we travel and how we can travel more meaningfully. He combines literary criticism, philosophy, and personal reflections on various destinations.', 'art_of_travel.pdf', 'Alain de Botton'),
('Lonely Planet''s Ultimate Travel: Our List of the 500 Best Places to See... Ranked', 'While a guide series, this specific compilation often becomes a best-seller due to its aspirational nature, inspiring travel planning with stunning photography and descriptions of diverse destinations globally.', 'lonely_planet_ultimate_travel.pdf', 'Lonely Planet (Various Authors)');





-- Comedy
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Bossypants', 'A hilarious and insightful memoir by the Emmy-winning writer, actress, and comedian Tina Fey. She shares anecdotes from her life, career at Saturday Night Live, and experiences as a woman in comedy, all delivered with her signature wit and self-deprecating humor.', 'bossypants.pdf', 'Tina Fey'),
('Is Everyone Hanging Out Without Me? (And Other Concerns)', 'Mindy Kaling''s witty and relatable collection of essays covers topics from her childhood and early career struggles to her experiences in Hollywood, offering humorous observations on pop culture, friendship, and self-acceptance.', 'is_everyone_hanging_out.pdf', 'Mindy Kaling'),
('Born a Crime: Stories from a South African Childhood', 'Trevor Noah''s poignant and often hilarious memoir recounts his childhood growing up in apartheid and post-apartheid South Africa as the son of a Black Xhosa mother and a white Swiss father, using humor to navigate complex social and racial issues.', 'born_a_crime.pdf', 'Trevor Noah'),
('Me Talk Pretty One Day', 'David Sedaris''s collection of essays delves into his eccentric family life, experiences growing up in North Carolina, and his attempts to learn French in Paris, all delivered with his characteristic dry wit and sharp observational humor.', 'me_talk_pretty_one_day.pdf', 'David Sedaris'),
('Yes Please', 'Amy Poehler''s humorous and honest memoir covers her journey from improv comedy to Saturday Night Live and Parks and Recreation, offering funny anecdotes, life lessons, and reflections on feminism and motherhood.', 'yes_please.pdf', 'Amy Poehler'),
('Hyperbole and a Half: Unfortunate Situations, Flawed Coping Mechanisms, Mayhem, and Other Things That Happened', 'A wildly popular book based on Allie Brosh''s blog, combining simple stick-figure drawings with deeply funny and relatable essays about childhood adventures, depression, and everyday absurdities.', 'hyperbole_and_a_half.pdf', 'Allie Brosh'),
('Naked', 'A collection of humorous essays by David Sedaris, exploring various absurd and awkward situations from his life, including his experiences with odd jobs, travel mishaps, and family antics, delivered with his distinctive comedic voice.', 'naked_sedaris.pdf', 'David Sedaris'),
('You Can''t Touch My Hair: And Other Things I Still Have to Explain', 'Phoebe Robinson''s debut collection of essays explores race, gender, and pop culture with a unique blend of humor, wit, and sharp social commentary, drawing from her experiences as a Black woman in America.', 'you_cant_touch_my_hair.pdf', 'Phoebe Robinson'),
('Sick in the Head: Conversations About Life and Comedy', 'Judd Apatow''s extensive collection of interviews with legendary comedians and comedic actors. It offers a unique behind-the-scenes look at the craft of comedy, filled with candid insights and hilarious exchanges.', 'sick_in_the_head.pdf', 'Judd Apatow'),
('Mortality', 'A series of essays by Christopher Hitchens, written after his diagnosis with esophageal cancer. While dealing with a serious subject, Hitchens maintains his characteristic intellectual rigor, wit, and defiance, often finding dark humor in his own mortality.', 'mortality_hitchens.pdf', 'Christopher Hitchens');




-- News
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('All the President''s Men', 'The definitive account by two Washington Post reporters who broke the Watergate scandal, detailing their relentless investigative journalism that ultimately led to President Nixon''s resignation.', 'all_the_presidents_men.pdf', 'Carl Bernstein and Bob Woodward'),
('Fear and Loathing on the Campaign Trail ''72', 'Hunter S. Thompson''s wild and influential account of the 1972 U.S. presidential campaign, pioneering "gonzo journalism" by blending objective reporting with subjective experiences and satirical commentary.', 'fear_and_loathing_campaign.pdf', 'Hunter S. Thompson'),
('On Writing Well: An Informal Guide to Writing Nonfiction', 'While not exclusively about news, this classic guide is indispensable for journalists and anyone writing nonfiction. It provides timeless advice on clarity, simplicity, and humanity in writing, crucial for news reporting.', 'on_writing_well.pdf', 'William Zinsser'),
('Manufacturing Consent: The Political Economy of the Mass Media', 'A seminal work that critically analyzes the mass media, arguing that news outlets serve as propaganda models, manufacturing consent for economic, social, and political agendas within a capitalist system.', 'manufacturing_consent.pdf', 'Edward S. Herman and Noam Chomsky'),
('Bad Blood: Secrets and Lies in a Silicon Valley Startup', 'An acclaimed investigative report on the rise and spectacular fall of Theranos, the blood-testing startup. It exposes the corporate fraud, deception, and the failures of journalism and venture capital that allowed it to thrive.', 'bad_blood.pdf', 'John Carreyrou'),
('Amusing Ourselves to Death: Public Discourse in the Age of Show Business', 'Neil Postman argues that television, with its emphasis on entertainment, has transformed public discourse from a serious, rational exchange of ideas into a trivial spectacle, profoundly impacting how news is consumed.', 'amusing_ourselves_to_death.pdf', 'Neil Postman'),
('Peril', 'The third book in a series by Bob Woodward and Robert Costa, providing an inside look at the tumultuous transition of power from the Trump administration to the Biden presidency, relying on hundreds of interviews with key figures.', 'peril.pdf', 'Bob Woodward and Robert Costa'),
('Mediocre: The Dangerous Legacy of White Male America', 'Explores how white male mediocrity has shaped American institutions, including media and news, and examines how systemic biases affect what stories are told and by whom.', 'mediocre.pdf', 'Ijeoma Oluo'),
('The Elements of Journalism: What Newspeople Should Know and the Public Should Expect', 'A foundational text that defines the core principles and responsibilities of journalism in a democratic society, offering a framework for ethical and effective news reporting.', 'elements_of_journalism.pdf', 'Bill Kovach and Tom Rosenstiel'),
('Digital Minimalism: Choosing a Focused Life in a Noisy World', 'While broader than just news, this book directly addresses the overwhelming nature of constant news consumption in the digital age, advocating for intentional technology use to reduce distraction and improve focus.', 'digital_minimalism.pdf', 'Cal Newport');




-- Personal Development
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Atomic Habits: An Easy & Proven Way to Build Good Habits & Break Bad Ones', 'A comprehensive, practical guide on how to change your habits and get 1% better every day. It introduces a framework called the Four Laws of Behavior Change for creating good habits and breaking bad ones, emphasizing that small, consistent improvements lead to significant long-term results.', 'atomic_habits_personal_dev.pdf', 'James Clear'),
('The 7 Habits of Highly Effective People', 'A seminal work on personal and professional effectiveness. It outlines a principle-centered approach to living that emphasizes proactive behavior, goal-setting, prioritization, and interdependence for greater success in business and life.', '7_habits_personal_dev.pdf', 'Stephen Covey'),
('Mindset: The New Psychology of Success', 'Explores the power of "growth mindset" versus "fixed mindset" and how these beliefs profoundly impact learning, achievement, and personal development in all aspects of life, encouraging resilience and a love of learning.', 'mindset_personal_dev.pdf', 'Carol S. Dweck'),
('Think and Grow Rich', 'One of the earliest and most influential self-help books, based on Napoleon Hill''s study of successful individuals. It outlines principles like desire, faith, specialized knowledge, and persistence for achieving wealth and personal fulfillment.', 'think_and_grow_rich_personal_dev.pdf', 'Napoleon Hill'),
('Dare to Lead: Brave Work. Tough Conversations. Whole Hearts.', 'Brené Brown applies her research on vulnerability, courage, and shame to the realm of leadership and personal growth. She argues that true leadership and personal fulfillment require daring to be vulnerable, having tough conversations, and leading with empathy and authenticity.', 'dare_to_lead_personal_dev.pdf', 'Brené Brown'),
('The Power of Habit: Why We Do What We Do in Life and Business', 'Explores the science behind habit formation and change, revealing how habits work in our lives, companies, and societies. It offers insights into how individuals and organizations can change their routines for better outcomes.', 'power_of_habit.pdf', 'Charles Duhigg'),
('Grit: The Power of Passion and Perseverance', 'Angela Duckworth argues that the secret to outstanding achievement is not talent but a special blend of passion and persistence she calls "grit." The book explores how grit can be developed and cultivated.', 'grit_personal_dev.pdf', 'Angela Duckworth'),
('The Subtle Art of Not Giving a F*ck: A Counterintuitive Approach to Living a Good Life', 'A self-help book that challenges conventional positive thinking, arguing that embracing life''s struggles and focusing on what truly matters leads to a more meaningful existence. It encourages readers to choose what they care about and to develop values they can control.', 'the_subtle_art_personal_dev.pdf', 'Mark Manson'),
('Getting Things Done: The Art of Stress-Free Productivity', 'Introduces the "GTD" methodology for personal and professional organization. It offers a system for capturing, clarifying, organizing, reflecting on, and engaging with tasks to achieve greater productivity and reduce stress.', 'getting_things_done.pdf', 'David Allen'),
('You Are a Badass: How to Stop Doubting Your Greatness and Start Living an Awesome Life', 'A humorous and motivating self-help guide that encourages readers to identify and change the self-sabotaging beliefs and behaviors that prevent them from achieving their goals and living the life they desire.', 'you_are_a_badass_personal_dev.pdf', 'Jen Sincero');




-- Parenting 
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('The Whole-Brain Child: 12 Revolutionary Strategies to Nurture Your Child''s Developing Mind', 'Offers strategies for parents to foster healthy brain development in children by understanding how the brain functions. It provides practical tips for dealing with everyday parenting challenges by integrating different parts of the brain.', 'whole_brain_child.pdf', 'Daniel J. Siegel and Tina Payne Bryson'),
('No-Drama Discipline: The Whole-Brain Way to Calm the Chaos and Nurture Your Child''s Developing Mind', 'Expands on the whole-brain approach, showing parents how to use discipline as an opportunity to teach and grow, rather than just punish, fostering self-control and resilience in children.', 'no_drama_discipline.pdf', 'Daniel J. Siegel and Tina Payne Bryson'),
('How to Talk So Kids Will Listen & Listen So Kids Will Talk', 'A classic guide to improving communication between parents and children. It offers practical, effective techniques for fostering cooperation, problem-solving, and healthy relationships without resorting to threats or lectures.', 'how_to_talk_so_kids_will_listen.pdf', 'Adele Faber and Elaine Mazlish'),
('Positive Discipline', 'Introduces a gentle yet firm approach to parenting that emphasizes mutual respect, problem-solving skills, and a sense of belonging and significance for children. It focuses on long-term skill development over short-term compliance.', 'positive_discipline.pdf', 'Jane Nelsen'),
('The Awakened Family: A Revolution in Parenting', 'Offers a spiritual and mindful approach to parenting, encouraging parents to be present, respond consciously rather than react impulsively, and foster their children''s authenticity and inner wisdom.', 'the_awakened_family.pdf', 'Shefali Tsabary'),
('The Explosive Child: A New Approach for Understanding and Parenting Easily Frustrated, Chronically Inflexible Children', 'Presents the "Collaborative & Proactive Solutions" (CPS) model for helping children with behavioral challenges. It focuses on identifying lagging skills and unsolved problems rather than simply labeling defiance.', 'the_explosive_child.pdf', 'Ross W. Greene'),
('Simplicity Parenting: Using the Extraordinary Power of Less to Raise Calmer, Happier, and More Secure Kids', 'Advocates for simplifying family life to reduce stress and foster healthier development in children. It covers decluttering, rhythm, scheduling, and screening out adult influences.', 'simplicity_parenting.pdf', 'Kim John Payne with Lisa Ross'),
('Hunt, Gather, Parent: What Ancient Cultures Can Teach Us About Raising Our Kids', 'Explores parenting practices in indigenous cultures around the world, offering insights into how modern parents can integrate lessons about trust, autonomy, community, and less explicit instruction into their own parenting.', 'hunt_gather_parent.pdf', 'Michaeleen Doucleff'),
('Bringing Up Bébé: One American Mother Discovers the Wisdom of French Parenting', 'A humorous and insightful look at French parenting methods from an American perspective, focusing on concepts like allowing children more independence, teaching patience, and the importance of parental authority and personal time.', 'bringing_up_bebe.pdf', 'Pamela Druckerman'),
('Peaceful Parent, Happy Kids: How to Stop Yelling and Start Connecting', 'Offers practical strategies for parents to manage their own emotions and reactions, creating a more peaceful home environment and fostering stronger, more connected relationships with their children.', 'peaceful_parent_happy_kids.pdf', 'Laura Markham');




-- Politics
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('The Whole-Brain Child: 12 Revolutionary Strategies to Nurture Your Child''s Developing Mind', 'Offers strategies for parents to foster healthy brain development in children by understanding how the brain functions. It provides practical tips for dealing with everyday parenting challenges by integrating different parts of the brain.', 'whole_brain_child.pdf', 'Daniel J. Siegel and Tina Payne Bryson'),
('No-Drama Discipline: The Whole-Brain Way to Calm the Chaos and Nurture Your Child''s Developing Mind', 'Expands on the whole-brain approach, showing parents how to use discipline as an opportunity to teach and grow, rather than just punish, fostering self-control and resilience in children.', 'no_drama_discipline.pdf', 'Daniel J. Siegel and Tina Payne Bryson'),
('How to Talk So Kids Will Listen & Listen So Kids Will Talk', 'A classic guide to improving communication between parents and children. It offers practical, effective techniques for fostering cooperation, problem-solving, and healthy relationships without resorting to threats or lectures.', 'how_to_talk_so_kids_will_listen.pdf', 'Adele Faber and Elaine Mazlish'),
('Positive Discipline', 'Introduces a gentle yet firm approach to parenting that emphasizes mutual respect, problem-solving skills, and a sense of belonging and significance for children. It focuses on long-term skill development over short-term compliance.', 'positive_discipline.pdf', 'Jane Nelsen'),
('The Awakened Family: A Revolution in Parenting', 'Offers a spiritual and mindful approach to parenting, encouraging parents to be present, respond consciously rather than react impulsively, and foster their children''s authenticity and inner wisdom.', 'the_awakened_family.pdf', 'Shefali Tsabary'),
('The Explosive Child: A New Approach for Understanding and Parenting Easily Frustrated, Chronically Inflexible Children', 'Presents the "Collaborative & Proactive Solutions" (CPS) model for helping children with behavioral challenges. It focuses on identifying lagging skills and unsolved problems rather than simply labeling defiance.', 'the_explosive_child.pdf', 'Ross W. Greene'),
('Simplicity Parenting: Using the Extraordinary Power of Less to Raise Calmer, Happier, and More Secure Kids', 'Advocates for simplifying family life to reduce stress and foster healthier development in children. It covers decluttering, rhythm, scheduling, and screening out adult influences.', 'simplicity_parenting.pdf', 'Kim John Payne with Lisa Ross'),
('Hunt, Gather, Parent: What Ancient Cultures Can Teach Us About Raising Our Kids', 'Explores parenting practices in indigenous cultures around the world, offering insights into how modern parents can integrate lessons about trust, autonomy, community, and less explicit instruction into their own parenting.', 'hunt_gather_parent.pdf', 'Michaeleen Doucleff'),
('Bringing Up Bébé: One American Mother Discovers the Wisdom of French Parenting', 'A humorous and insightful look at French parenting methods from an American perspective, focusing on concepts like allowing children more independence, teaching patience, and the importance of parental authority and personal time.', 'bringing_up_bebe.pdf', 'Pamela Druckerman'),
('Peaceful Parent, Happy Kids: How to Stop Yelling and Start Connecting', 'Offers practical strategies for parents to manage their own emotions and reactions, creating a more peaceful home environment and fostering stronger, more connected relationships with their children.', 'peaceful_parent_happy_kids.pdf', 'Laura Markham');




-- Art & Design
INSERT INTO books (title, description, pdf_file, created_by) VALUES
('Ways of Seeing', 'Based on a BBC television series, this influential book challenges traditional ways of interpreting art, exploring how images convey ideology and shape our perception of the world, particularly in Western art history.', 'ways_of_seeing.pdf', 'John Berger'),
('Steal Like an Artist: 10 Things Nobody Told You About Being Creative', 'A concise and inspiring guide for creatives that encourages embracing influence, learning from others, and approaching creativity not as an innate talent but as a process of continuous learning and remixing.', 'steal_like_an_artist.pdf', 'Austin Kleon'),
('The Elements of Style', 'While a general guide to writing, its principles of clarity, conciseness, and effective communication are foundational to all forms of creative expression and design, making it a staple for anyone involved in crafting messages or visuals.', 'elements_of_style.pdf', 'William Strunk Jr. and E.B. White'),
('Thinking with Type: A Critical Guide for Designers, Writers, Editors, & Students', 'A comprehensive and essential guide to typography, covering its history, principles, and practical application. It helps designers and anyone working with text understand how type affects meaning and readability.', 'thinking_with_type.pdf', 'Ellen Lupton'),
('Interaction of Color', 'A seminal work on color theory by the renowned artist and educator Josef Albers. It demonstrates the relativity of color through practical exercises and visual experiments, revealing how colors influence each other.', 'interaction_of_color.pdf', 'Josef Albers'),
('Design of Everyday Things', 'A foundational book in user-centered design, explaining why some products are easy to use and others are not. It highlights the importance of good design principles in creating intuitive and functional objects.', 'design_of_everyday_things.pdf', 'Don Norman'),
('The Story of Art', 'One of the most widely read and accessible introductions to the history of art. It covers Western art from prehistoric cave paintings to modern art, explaining key movements, artists, and concepts in a clear, engaging narrative.', 'story_of_art.pdf', 'E.H. Gombrich'),
('Leonardo da Vinci', 'A comprehensive and insightful biography of the Renaissance polymath. It delves into Leonardo''s life, his groundbreaking art, scientific inquiries, and inventions, revealing the integrated nature of his genius.', 'leonardo_da_vinci.pdf', 'Walter Isaacson'),
('Grid Systems in Graphic Design / Rastersysteme für die visuelle Gestaltung', 'A highly influential guide to grid systems in graphic design. It explains the principles and practical application of grid structures for creating clear, organized, and aesthetically pleasing layouts in print and digital media.', 'grid_systems_graphic_design.pdf', 'Josef Müller-Brockmann'),
('Drawing on the Right Side of the Brain: A Course in Enhancing Creativity and Artistic Confidence', 'A popular art instruction book that teaches drawing by shifting perception from left-brain analytical thinking to right-brain visual processing, helping individuals unlock their creative potential and improve their drawing skills.', 'drawing_on_the_right_side.pdf', 'Betty Edwards');




-- Relationships
 INSERT INTO books (title, description, pdf_file, created_by) VALUES
('The 5 Love Languages: The Secret to Love That Lasts', 'Introduces the concept of five distinct ways people express and receive love: Words of Affirmation, Acts of Service, Receiving Gifts, Quality Time, and Physical Touch, helping couples understand each other better.', '5_love_languages.pdf', 'Gary Chapman'),
('Hold Me Tight: Seven Conversations for a Lifetime of Love', 'Based on Emotionally Focused Therapy (EFT), this book guides couples through seven transformative conversations to deepen their emotional connection, resolve conflicts, and strengthen their bond.', 'hold_me_tight.pdf', 'Sue Johnson'),
('Men Are from Mars, Women Are from Venus', 'A classic relationship guide that attributes communication and relationship problems between men and women to fundamental psychological differences between the sexes, offering strategies for better understanding and harmony.', 'men_are_from_mars.pdf', 'John Gray'),
('Attached: The New Science of Adult Attachment and How It Can Help You Find--and Keep--Love', 'Explores adult attachment theory, helping readers identify their attachment style (anxious, avoidant, or secure) and how it impacts their romantic relationships, offering insights for finding more fulfilling connections.', 'attached_relationship.pdf', 'Amir Levine and Rachel S.F. Heller'),
('The Seven Principles for Making Marriage Work: A Practical Guide from the Country''s Foremost Relationship Expert', 'Based on extensive research, John Gottman''s book identifies key principles for building a strong and lasting marriage, including fostering fondness and admiration, turning toward each other, and managing conflict.', 'seven_principles_marriage.pdf', 'John M. Gottman and Nan Silver'),
('Nonviolent Communication: A Language of Life', 'A transformative guide to communication that teaches readers how to express themselves honestly and listen empathetically, fostering understanding and connection in all types of relationships without resorting to blame or criticism.', 'nonviolent_communication.pdf', 'Marshall B. Rosenberg'),
('Getting the Love You Want: A Guide for Couples', 'Introduces Imago Relationship Therapy, offering a structured approach for couples to resolve conflict, heal past wounds, and transform their relationship into a source of mutual growth and joy.', 'getting_the_love_you_want.pdf', 'Harville Hendrix'),
('Come as You Are: The Surprising New Science That Will Transform Your Sex Life', 'A groundbreaking book that explores the science of female sexuality, challenging common myths and helping women understand their own sexual desire and arousal for a more fulfilling sex life within their relationships.', 'come_as_you_are.pdf', 'Emily Nagoski'),
('The Relationship Cure: A 5 Step Guide to Strengthening Your Marriage, Family, and Friendships', 'John Gottman applies his research to all relationships, not just romantic ones, identifying "bids" for emotional connection and providing five steps to respond to these bids, strengthening bonds with everyone in your life.', 'relationship_cure.pdf', 'John M. Gottman'),
('Crucial Conversations: Tools for Talking When Stakes Are High', 'While broadly applicable, this book is essential for improving relationships by teaching readers how to handle high-stakes, emotional conversations effectively, fostering open dialogue and mutual respect.', 'crucial_conversations.pdf', 'Kerry Patterson, Joseph Grenny, Ron McMillan, Al Switzler');











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


INSERT INTO book_categories (book_id, category_id) VALUES
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1);



INSERT INTO book_categories (book_id, category_id) VALUES
(21, 2), (22, 2), (23, 2), (24, 2), (25, 2), (26, 2), (27, 2), (28, 2), (29, 2), (30, 2),
(31, 3), (32, 3), (33, 3), (34, 3), (35, 3), (36, 3), (37, 3), (38, 3), (39, 3), (40, 3),
(41, 4), (42, 4), (43, 4), (44, 4), (45, 4), (46, 4), (47, 4), (48, 4), (49, 4), (50, 4),
(51, 5), (52, 5), (53, 5), (54, 5), (55, 5), (56, 5), (57, 5), (58, 5), (59, 5), (60, 5),
(61, 6), (62, 6), (63, 6), (64, 6), (65, 6), (66, 6), (67, 6), (68, 6), (69, 6), (70, 6),
(71, 7), (72, 7), (73, 7), (74, 7), (75, 7), (76, 7), (77, 7), (78, 7), (79, 7), (80, 7),
(81, 8), (82, 8), (83, 8), (84, 8), (85, 8), (86, 8), (87, 8), (88, 8), (89, 8), (90, 8),
(91, 9), (92, 9), (93, 9), (94, 9), (95, 9), (96, 9), (97, 9), (98, 9), (99, 9), (100, 9),
(101, 10), (102, 10), (103, 10), (104, 10), (105, 10), (106, 10), (107, 10), (108, 10), (109, 10), (110, 10),
(111, 11), (112, 11), (113, 11), (114, 11), (115, 11), (116, 11), (117, 11), (118, 11), (119, 11), (120, 11),
(121, 12), (122, 12), (123, 12), (124, 12), (125, 12), (126, 12), (127, 12), (128, 12), (129, 12), (130, 12),
(131, 13), (132, 13), (133, 13), (134, 13), (135, 13), (136, 13), (137, 13), (138, 13), (139, 13), (140, 13),
(141, 14), (142, 14), (143, 14), (144, 14), (145, 14), (146, 14), (147, 14), (148, 14), (149, 14), (150, 14),
(151, 15), (152, 15), (153, 15), (154, 15), (155, 15), (156, 15), (157, 15), (158, 15), (159, 15), (160, 15),
(161, 16), (162, 16), (163, 16), (164, 16), (165, 16), (166, 16), (167, 16), (168, 16), (169, 16), (170, 16),
(171, 17), (172, 17), (173, 17), (174, 17), (175, 17), (176, 17), (177, 17), (178, 17), (179, 17), (180, 17),
(181, 18), (182, 18), (183, 18), (184, 18), (185, 18), (186, 18), (187, 18), (188, 18), (189, 18), (190, 18),
(191, 19), (192, 19), (193, 19), (194, 19), (195, 19), (196, 19), (197, 19), (198, 19), (199, 19), (200, 19),
(201, 20), (202, 20), (203, 20), (204, 20), (205, 20), (206, 20), (207, 20), (208, 20), (209, 20), (210, 20);


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



