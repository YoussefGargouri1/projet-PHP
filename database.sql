Create Database systemeGestion;
Use systemegestion;


CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    role ENUM('administrateur', 'user') NOT NULL
);


CREATE TABLE section (
    id INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(100) NOT NULL,
    description VARCHAR(500)
);


CREATE TABLE etudiant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL,
    image VARCHAR(255),
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES section(id) ON DELETE SET NULL
);


INSERT INTO user (username, email, role) VALUES
('Youssef', 'youssef@example.com', 'administrateur'),
('Aziz', 'aziz@example.com', 'user'),
('Firas', 'firas@example.com', 'user');


INSERT INTO section (designation, description) VALUES
('GL', 'Génie Logiciel'),
('RT', 'Réseaux et Telecommunications');


INSERT INTO etudiant (name, birthday, image, section_id) VALUES
('Firas Guizani', '2004-12-25', 'firas222.jpg', 1),
('Youssef Gargouri', '2005-02-21', 'PHOTO_ysf1.jpg', 1),
('Aziz Kchaou', '2005-01-20', 'aziz.jpg', 1);


