CREATE DATABASE fuckbook;
USE fuckbook;
CREATE TABLE fuckbook_profiles(
    school VARCHAR(255) NULL,
    sex INT(8) NULL,
    birthday DATETIME NULL,
    hometown TEXT NULL,
    highschool VARCHAR(255) NULL,
    screenname VARCHAR(255) NULL,
    mobile INT(8) NULL,
    id INT(8) NOT NULL
    PRIMARY KEY (id);
);