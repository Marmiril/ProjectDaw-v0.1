CREATE DATABASE IF NOT EXISTS storyteller_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE storyteller_db;

-- Tabla de usuarios.

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    
-- Preferencias de usuarios.

CREATE TABLE user_preferences (
    user_id INT PRIMARY KEY,
    favorite_number INT,
    favorite_color VARCHAR(30),
    height DECIMAL(5,2),
    weight DECIMAL(5,2),
    age INT,
    gender ENUM('M', 'F'),
    FOREIGN KEY (user_id) REFERENCES users(id)
    );

-- Información de las historias.

CREATE TABLE stories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    theme VARCHAR(50) NOT NULL,
    guide_word VARCHAR(100) NOT NULL,
    max_steps INT NOT NULL,
    current_step INT DEFAULT 1,
    user_id INT NOT NULL,
    created_at DATETIME NOT NULL,
    finished_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tabla de colaboraciones.

CREATE TABLE collaborations ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    story_id INT,
    user_id INT,
    content TEXT NOT NULL,
    step_number INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (story_id) REFERENCES stories(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Estadísticas

CREATE TABLE story_statistics (
    story_id INT PRIMARY KEY,
    total_collaborators INT DEFAULT 0,
    average_age FLOAT,
    average_height FLOAT,
    average_weight FLOAT,
    average_favorite_number FLOAT,
    most_common_color VARCHAR(30),
    gender_distribution JSON,
    completion_date TIMESTAMP,
    total_words INT DEFAULT 0,
    FOREIGN KEY (story_id) REFERENCES stories(id)
);