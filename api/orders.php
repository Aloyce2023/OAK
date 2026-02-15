<?php
// backend/api/orders.php
require_once "config.php";

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->car_id)) {
    
    // Sanitize input
    $user_id = htmlspecialchars(strip_tags($data->user_id));
    $car_id = htmlspecialchars(strip_tags($data->car_id));


    // Basic validation: Check if car exists (optional but good practice)
    // For now, we trust the ID or let the database FK constraint fail if invalid.

    $query = "INSERT INTO orders (user_id, car_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $car_id);

    if ($stmt->execute()) {
        http_response_code(201); // Created
        echo json_encode(array("success" => true, "message" => "Order placed successfully."));
    } else {
        http_response_code(503); // Service Unavailable
        echo json_encode(array("success" => false, "message" => "Unable to place order."));
    }
} else {
    http_response_code(400); // Bad Request
    echo json_encode(array("success" => false, "message" => "Incomplete data. User ID and Car ID needed."));
}

$conn->close();
?>
