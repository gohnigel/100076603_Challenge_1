SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+08:00";

-- Create database if it does not exist
CREATE DATABASE IF NOT EXISTS `form_approval`;

-- Create table for registered users
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(225) NOT NULL,
    `email` VARCHAR(225) NOT NULL,
    `password` VARCHAR(225) NOT NULL,
    `role` VARCHAR(225) NOT NULL,
	PRIMARY KEY (`user_id`)
);

INSERT INTO `users` (`name`, `email`, `password`, `role`) VALUES ('Nathan Dinus', 'ndinus@gmail.com', '111111', 'Admin'), ('Lee Ping Yang', 'pylee@hotmail.com', '222222', 'Manager'), ('Muhammad Baharuddin bin Muhammad Bakar', 'mbahar@gmail.com', '333333', 'Employee');

-- Create table that contains a form --
CREATE TABLE IF NOT EXISTS `form` (
    `form_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `name` VARCHAR(225) NOT NULL,
    `gender` VARCHAR(225) NOT NULL,
    `address` VARCHAR(225) NOT NULL,
    `country` VARCHAR(225) NOT NULL,
    `file1` MEDIUMBLOB NOT NULL,
    `verify1` VARCHAR(225) NULL,
    `file2` MEDIUMBLOB NOT NULL,
    `verify2` VARCHAR(225) NULL,
    `descr` VARCHAR(225) NOT NULL,
    `reason` VARCHAR(225) NULL,
    `approve` VARCHAR(225) NULL,
    `form_date` DATE NOT NULL,
    PRIMARY KEY (`form_id`),
    FOREIGN KEY (`user_id`) REFERENCES users(`user_id`)
);




