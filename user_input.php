<?php

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Redirect to login if not logged in
function require_login() {
    if (!is_logged_in()) {
        header('location: form.php');
        exit;
    }
}

// Get current logged in user
function get_current_username() {
    if (is_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

// Get current user ID
function get_current_user_id() {
    if (is_logged_in()) {
        return $_SESSION['user_id'];
    }
    return null;
}

// Logout user
function logout() {
    session_start();
    session_destroy();
    header('location: form.php');
    exit;
}

// Get user by ID
function get_user_by_id($id) {
    global $conn;
    $query = "SELECT * FROM user_input WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Get all users
function get_all_users() {
    global $conn;
    $query = "SELECT id, username, email, created_at FROM user_input ORDER BY created_at DESC";
    $result = $conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Get user feed/posts
function get_user_feed($user_id = null) {
    global $conn;
    
    if ($user_id === null) {
        $user_id = get_current_user_id();
    }
    
    $query = "SELECT * FROM feed WHERE user_id = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Create a new post
function create_post($body) {
    global $conn;
    
    if (!is_logged_in()) {
        return false;
    }
    
    $user_id = get_current_user_id();
    $username = get_current_username();
    $body = trim($body);
    
    if (empty($body)) {
        return false;
    }
    
    $query = "INSERT INTO feed (user_id, username, body) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $user_id, $username, $body);
    
    return $stmt->execute();
}

// Delete a post
function delete_post($post_id) {
    global $conn;
    
    if (!is_logged_in()) {
        return false;
    }
    
    $user_id = get_current_user_id();
    
    $query = "DELETE FROM feed WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $post_id, $user_id);
    
    return $stmt->execute();
}

// Sanitize input
function sanitize_input($input) {
    return htmlspecialchars(trim($input));
}

/**
 * Check if the current user has admin privileges.
 */
function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * Check if the current user is specifically the super-admin 'Aloyce'.
 */
function is_super_admin() {
    return is_admin() && $_SESSION['username'] === 'Aloyce';
}

?>
