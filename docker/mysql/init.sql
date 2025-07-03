GRANT ALL PRIVILEGES ON *.* TO 'juanra'@'%' IDENTIFIED BY 'test';
FLUSH PRIVILEGES;

CREATE DATABASE IF NOT EXISTS quental;
USE quental;

CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     name VARCHAR(100) NOT NULL
    );

INSERT INTO users (name) VALUES ('juanra');
