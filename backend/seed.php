<?php
require_once "config/Database.php";

try {

    $db = (new Database())->connect();

    // Create Users Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100),
            email VARCHAR(100) UNIQUE,
            password VARCHAR(255),
            role ENUM('admin','user') DEFAULT 'user'
        )
    ");

    // Create Rooms Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS rooms (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100)
        )
    ");

    // Create Bookings Table
    $db->exec("
        CREATE TABLE IF NOT EXISTS bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            room_id INT,
            date DATE,
            time_slot VARCHAR(50),
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
        )
    ");

    // Insert Admin (if not exists)
    $hashedPassword = password_hash("admin123", PASSWORD_DEFAULT);

    $stmt = $db->prepare("
        INSERT IGNORE INTO users (name, email, password, role)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        "Admin",
        "admin@swahilipot.com",
        $hashedPassword,
        "admin"
    ]);

    // Insert Default Rooms
    $db->exec("
        INSERT IGNORE INTO rooms (id, name) VALUES
        (1, 'Conference Room'),
        (2, 'Training Room'),
        (3, 'Meeting Room')
    ");

    echo "Database seeded successfully!";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}