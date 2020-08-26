CREATE DATABASE Dawoon_test;

use Dawoon_test;

CREATE TABLE assignment (
	id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
	unitid VARCHAR(30) NOT NULL,
	unitname VARCHAR(50) NOT NULL,
	asname VARCHAR(30),
    duedate VARCHAR(30),
	date TIMESTAMP
);

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);