<?php
require_once "database.php";

// Add role column if it doesn't exist
$sql = "SHOW COLUMNS FROM user_input LIKE 'role'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $sql_alter = "ALTER TABLE user_input ADD COLUMN role VARCHAR(20) DEFAULT 'user' AFTER email";
    if ($conn->query($sql_alter) === TRUE) {
        echo "Column 'role' added successfully.<br>";
    } else {
        echo "Error adding column: " . $conn->error . "<br>";
    }
} else {
    echo "Column 'role' already exists.<br>";
}

// Create an admin user if not exists
$admin_user = "admin";
$admin_pass = "admin123";
$admin_email = "admin@example.com";
$hashed_pass = password_hash($admin_pass, PASSWORD_DEFAULT);

$check_admin = "SELECT id FROM user_input WHERE username = 'admin'";
$res = $conn->query($check_admin);

if ($res->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO user_input (username, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param("sss", $admin_user, $admin_email, $hashed_pass);
    if ($stmt->execute()) {
        echo "Admin user created successfully (User: admin, Pass: admin123).<br>";
    } else {
        echo "Error creating admin: " . $stmt->error . "<br>";
    }
} else {
    // Make sure existing admin has the role
    $conn->query("UPDATE user_input SET role = 'admin' WHERE username = 'admin'");
    echo "Admin user already exists, role updated to 'admin'.<br>";
}

echo "<br><a href='form.php'>Go to Login Page</a>";
$conn->close();
?>
