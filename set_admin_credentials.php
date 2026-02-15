<?php
require_once "database.php";

$admin_user = "Aloyce";
$admin_pass = "Aloyce360joseph";
$admin_email = "aloyce@example.com";
$hashed_pass = password_hash($admin_pass, PASSWORD_DEFAULT);

// Check if this specific admin already exists
$check_admin = "SELECT id FROM user_input WHERE username = ?";
$stmt = $conn->prepare($check_admin);
$stmt->bind_param("s", $admin_user);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    // Create the new admin
    $stmt_insert = $conn->prepare("INSERT INTO user_input (username, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt_insert->bind_param("sss", $admin_user, $admin_email, $hashed_pass);
    if ($stmt_insert->execute()) {
        echo "Admin 'Aloyce' created successfully.<br>";
    } else {
        echo "Error creating admin: " . $conn->error . "<br>";
    }
} else {
    // Update existing user to be admin with the specified password
    $stmt_update = $conn->prepare("UPDATE user_input SET password = ?, role = 'admin' WHERE username = ?");
    $stmt_update->bind_param("ss", $hashed_pass, $admin_user);
    if ($stmt_update->execute()) {
        echo "Admin 'Aloyce' credentials updated successfully.<br>";
    } else {
        echo "Error updating admin: " . $conn->error . "<br>";
    }
}

// Optional: Remove the temporary 'admin' user created earlier for security
$conn->query("DELETE FROM user_input WHERE username = 'admin'");

echo "<br><a href='form.php'>Go to Login Page</a>";
$conn->close();
?>
