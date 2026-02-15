<?php
// backend/api/login.php
require_once "config.php";

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->username) && !empty($data->password)) {
    $username = $data->username;
    $password = $data->password;

    $query = "SELECT id, username, password, role FROM user_input WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            // Bulletproof Admin Check for Aloyce
            if (strtolower($user['username']) === 'aloyce') {
                $user['role'] = 'admin';
            }

            http_response_code(200);
            echo json_encode(array(
                "success" => true,
                "message" => "Login successful.",
                "user_id" => $user['id'],
                "username" => $user['username'],
                "role" => $user['role']
            ));
        } else {
            http_response_code(401);
            echo json_encode(array("success" => false, "message" => "Invalid password."));
        }
    } else {
        http_response_code(401);
        echo json_encode(array("success" => false, "message" => "User not found."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "message" => "Incomplete data."));
}

$conn->close();
?>
