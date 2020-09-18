DROP DATABASE IF EXISTS social_network;
CREATE DATABASE social_network CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE social_network;

CREATE TABLE `user` (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    pass CHAR(60) NOT NULL
);

CREATE UNIQUE INDEX emailindex ON user(email);

CREATE TABLE post (
    id INT NOT NULL PRIMARY KEY auto_increment,
    content text,
    user_id INT NOT NULL,
    date datetime NOT NULL DEFAULT now(),
    FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE comment (
    id INT NOT NULL PRIMARY KEY auto_increment,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    content text NOT NULL,
    date datetime NOT NULL DEFAULT now(),
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (post_id) REFERENCES post(id)
);

CREATE TABLE likes (
    id INT NOT NULL PRIMARY KEY auto_increment,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (post_id) REFERENCES post(id)
);

INSERT INTO user (id, first_name, last_name, email, pass) VALUES (1, 'Pero', 'Perić', 'pero@example.com', '$2y$10$P.UVGAWu.Yyp9SfZ9Rn7NuHZgKvBXo5LWJTlUvJhBZyJtKNlQOk36');
INSERT INTO post (content, user_id) VALUES ('Evo danas pada kiša opet :(', 1), ('Jedem jagode.', 1);
