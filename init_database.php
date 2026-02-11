<?php
// Database configuration
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "user_input");

// Create connection (without selecting database first)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to MySQL successfully!<br>";

// Create database if it doesn't exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database '" . DB_NAME . "' created or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Now select the database
$conn->select_db(DB_NAME);

// Create users table
$sql_create_users = "CREATE TABLE IF NOT EXISTS user_input (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql_create_users) === TRUE) {
    echo "Table 'user_input' created successfully or already exists.<br>";
} else {
    die("Error creating user_input table: " . $conn->error);
}

// Create posts/feed table (for storing user posts)
$sql_create_feed = "CREATE TABLE IF NOT EXISTS feed (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    username VARCHAR(50) NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_input(id) ON DELETE CASCADE
)";

if ($conn->query($sql_create_feed) === TRUE) {
    echo "Table 'feed' created successfully or already exists.<br>";
} else {
    die("Error creating feed table: " . $conn->error);
}

echo "<br><strong style='color: green;'>✓ Database setup completed successfully!</strong><br>";
echo "You can now delete this file or keep it for future reference.";

$conn->close();
?>
