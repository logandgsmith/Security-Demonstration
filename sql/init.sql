CREATE USER 'thirstybois'@'localhost' IDENTIFIED BY 'ExtremeThirst';

CREATE DATABASE thirstybois;

USE thirstybois;

CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(256) NOT NULL,
    password_hash VARCHAR(128) NOT NULL,
    token VARCHAR(1024) NOT NULL,
    balance FLOAT NOT NULL DEFAULT 0.0
);

CREATE TABLE transfers(
    email VARCHAR(256) NOT NULL,
    message VARCHAR(255) NOT NULL,
    amount INT NOT NULL
);

GRANT ALL PRIVILEGES ON thirstybois.users TO 'thirstybois'@'localhost';
GRANT ALL PRIVILEGES ON thirstybois.transfers TO 'thirstybois'@'localhost';

FLUSH PRIVILEGES;
