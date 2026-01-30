<?php

require_once __DIR__ . '/../config/app.php';

session_start();

// Check if admin is logged in
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

// Redirect if not admin
function requireAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: ' . BASE_URL . '/public/admin/login.php');
        exit;
    }
}

// Sanitize output to prevent XSS
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Handle file upload for movie posters
function uploadPoster($file) {
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $maxSize = 5 * 1024 * 1024; // 5MB
    
    // Check if file was uploaded
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload error occurred'];
    }
    
    // Check file size
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'File size exceeds 5MB'];
    }
    
    // Check file type
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed)) {
        return ['success' => false, 'message' => 'Only JPG, PNG, GIF allowed'];
    }
    
    // Verify it's actually an image
    $check = getimagesize($file['tmp_name']);
    if ($check === false) {
        return ['success' => false, 'message' => 'File is not a valid image'];
    }
    
    // Generate unique filename
    $filename = uniqid() . '_' . time() . '.' . $ext;
    
    // Create upload directory if it doesn't exist
    $uploadDir = BASE_PATH . '/uploads/posters/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $destination = $uploadDir . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => true, 'filename' => $filename];
    }
    
    return ['success' => false, 'message' => 'Failed to save file'];
}

// Delete poster file
function deletePoster($filename) {
    if ($filename && $filename !== 'default.jpg') {
        $path = BASE_PATH . '/uploads/posters/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
?>