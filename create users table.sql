-- create database (if not existing)
CREATE DATABASE IF NOT EXISTS traffic_management CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE traffic_management;

-- users table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(60) NOT NULL UNIQUE,
  full_name VARCHAR(150),
  email VARCHAR(150) NOT NULL UNIQUE,
  phone_number VARCHAR(30),
  password VARCHAR(255) NOT NULL,
  gender VARCHAR(20),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
