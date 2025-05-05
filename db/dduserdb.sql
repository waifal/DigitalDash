CREATE DATABASE dduserdb;

USE dduserdb;

CREATE TABLE tbluser (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    agreed_terms TINYINT(1) NOT NULL DEFAULT 0,
    agreed_privacy TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(64) NOT NULL UNIQUE,
    expires_at INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES tbluser(user_id) ON DELETE CASCADE
);