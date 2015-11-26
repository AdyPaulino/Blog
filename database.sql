/* First, create our articles table: */
CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    body TEXT,
    created DATETIME DEFAULT NOW(),
    modified DATETIME DEFAULT NOW()
);# MySQL returned an empty result set (i.e. zero rows).
/* Then insert some articles for testing: */
INSERT INTO articles (title,body,created)
    VALUES ('The title', 'This is the article body.', NOW());# 1 row affected.
INSERT INTO articles (title,body,created)
    VALUES ('A title once again', 'And the article body follows.', NOW());# 1 row affected.
INSERT INTO articles (title,body,created)
    VALUES ('Title strikes back', 'This is really exciting! Not.', NOW());# 1 row affected.

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    role VARCHAR(20),
    created DATETIME DEFAULT NOW(),
    modified DATETIME DEFAULT NOW()
);

ALTER TABLE articles ADD COLUMN user_id INT(11);

CREATE TABLE comments ( 
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	title VARCHAR(50), 
	body TEXT, 
	approved BOOLEAN DEFAULT 0, 
	article_id INT, 
	created DATETIME DEFAULT NOW(), 
	modified DATETIME DEFAULT NOW() 
)