-- Buat database
CREATE DATABASE IF NOT EXISTS ultrasonic_game;
USE ultrasonic_game;

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  point INT DEFAULT 0,
  life INT DEFAULT 3,
  target INT DEFAULT 0,
  status VARCHAR(20) DEFAULT 'start'
);

-- Tabel measurements
CREATE TABLE IF NOT EXISTS measurements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  result INT,
  is_read BOOLEAN DEFAULT FALSE,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);