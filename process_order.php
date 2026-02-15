<?php
session_start();
require("database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: form.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $car_id = $_POST['car_id'];

    if (empty($car_id)) {
        header("Location: Dashbord.php?error=invalid_car");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO orders (user_id, car_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $car_id);

    if ($stmt->execute()) {
        header("Location: Dashbord.php?success=1");
    } else {
        header("Location: Dashbord.php?error=1");
    }
    $stmt->close();
    $conn->close();
} else {
    header("Location: Dashbord.php");
    exit();
}
?>
