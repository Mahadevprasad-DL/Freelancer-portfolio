-- MySQL dump to align with index.php form

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS feedback_engine;
USE feedback_engine;

-- --------------------------------------------------------

-- Table structure for feedback responses
CREATE TABLE `feedback` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `client_name` VARCHAR(255) NOT NULL,
  `project_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `rating` TINYINT(1) NOT NULL,  -- Rating from 1 to 5
  `view` ENUM('excellent', 'good', 'neutral', 'poor') NOT NULL,
  `comments` TEXT NOT NULL,
  `client_image` VARCHAR(255) DEFAULT NULL, -- Store image file path
  `timestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sample data for `feedback`
INSERT INTO `feedback` (`client_name`, `project_name`, `email`, `rating`, `view`, `comments`, `client_image`) VALUES
('John Doe', 'Website Redesign', 'johndoe@example.com', 5, 'excellent', 'Amazing experience!', 'uploads/johndoe.jpg');

-- --------------------------------------------------------

-- Table structure for admin users
CREATE TABLE `user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sample data for `user`
INSERT INTO `user` (`email`, `password`) VALUES
('admin@admin.com', 'admin');  -- Note: It's recommended to hash passwords in production.

-- --------------------------------------------------------

-- Set up AUTO_INCREMENT for tables if necessary
ALTER TABLE `feedback`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
