CREATE DATABASE dduserdb;

USE dduserdb;

CREATE TABLE tbluser (
    userid INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    agreed_terms BOOLEAN NOT NULL DEFAULT FALSE,
    agreed_privacy BOOLEAN NOT NULL DEFAULT FALSE
);
