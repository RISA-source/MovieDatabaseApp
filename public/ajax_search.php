<?php
require_once __DIR__ . '/../config/database.php';

header('Content-Type: application/json');

$query = isset($_GET['q']) ? trim($_GET['q']) : '';

if (strlen($query) >= 2) {
    $stmt = $pdo->prepare("SELECT id, title, year FROM movies WHERE title LIKE ? LIMIT 8");
    $stmt->execute(["%$query%"]);
    $results = $stmt->fetchAll();
    
    echo json_encode($results);
} else {
    echo json_encode([]);
}
?>