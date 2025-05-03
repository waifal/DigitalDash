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