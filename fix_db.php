<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "database.php";

echo "<h2>NESO CARS - FINAL DATABASE FIX</h2>";

// 1. Ensure 'role' column exists
$check_role = $conn->query("SHOW COLUMNS FROM user_input LIKE 'role'");
if ($check_role->num_rows == 0) {
    echo "Adding 'role' column... ";
    if ($conn->query("ALTER TABLE user_input ADD COLUMN role VARCHAR(20) DEFAULT 'user' AFTER email")) {
        echo "<span style='color:green;'>Success!</span><br>";
    } else {
        echo "<span style='color:red;'>Failed: " . $conn->error . "</span><br>";
    }
} else {
    echo "'role' column already exists.<br>";
}

// 2. Clear out any existing 'Aloyce' or 'admin' to avoid duplicates/conflicts
$conn->query("DELETE FROM user_input WHERE username = 'Aloyce'");
$conn->query("DELETE FROM user_input WHERE username = 'admin'");

// 3. Create fresh Admin 'Aloyce'
$admin_user = "Aloyce";
$admin_pass = "Aloyce360joseph";
$admin_email = "aloyce@example.com";
$hashed_pass = password_hash($admin_pass, PASSWORD_DEFAULT);

echo "Creating fresh super-admin 'Aloyce'... ";
$stmt = $conn->prepare("INSERT INTO user_input (username, email, password, role) VALUES (?, ?, ?, 'admin')");
$stmt->bind_param("sss", $admin_user, $admin_email, $hashed_pass);

if ($stmt->execute()) {
    echo "<span style='color:green;'>Success! Account recreated with ADMIN role.</span><br>";
} else {
    echo "<span style='color:red;'>Critical Error: " . $conn->error . "</span><br>";
}

// 4. Ensure 'orders' table exists
$sql_create_orders = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_input(id) ON DELETE CASCADE,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
)";
if ($conn->query($sql_create_orders) === TRUE) {
    echo "Table 'orders' checked/created successfully.<br>";
}

echo "<br><br><b>LOGIN DETAILS:</b><br>";
echo "Username: <b>Aloyce</b><br>";
echo "Password: <b>Aloyce360joseph</b><br>";
echo "<br><a href='form.php' style='padding:10px 20px; background:#eab308; color:black; text-decoration:none; border-radius:12px; font-weight:bold;'>GO TO LOGIN PORTAL</a>";

$conn->close();
?>
