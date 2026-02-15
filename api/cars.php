<?php
// backend/api/cars.php
require_once "config.php";

$query = "SELECT * FROM cars ORDER BY created_at DESC";
$result = $conn->query($query);

if ($result) {
    if ($result->num_rows > 0) {
        $cars_arr = array();
        $cars_arr["data"] = array();
        $cars_arr["success"] = true;

        while ($row = $result->fetch_assoc()) {
            $car_item = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "brand" => $row['brand'],
                "price" => $row['price'],
                "description" => $row['description'],
                "image" => $row['image']
            );
            array_push($cars_arr["data"], $car_item);
        }

        http_response_code(200);
        echo json_encode($cars_arr);
    } else {
        http_response_code(404);
        echo json_encode(array("success" => false, "message" => "No cars found."));
    }
} else {
    http_response_code(500);
    echo json_encode(array("success" => false, "message" => "Database query failed."));
}

$conn->close();
?>
