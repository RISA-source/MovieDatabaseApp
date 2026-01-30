<?php 
$pageTitle = "Delete Movie";
include __DIR__ . '/../../includes/header.php';
requireAdmin();

// Get movie ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch movie details
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    header('Location: dashboard.php');
    exit;
}

// Handle deletion confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete poster file from server
    deletePoster($movie['poster']);
    
    // Delete from database
    $stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
    $stmt->execute([$id]);
    
    header('Location: dashboard.php?success=deleted');
    exit;
}
?>

<h1 class="page-title">Delete Movie</h1>

<div class="form-card">
    <div class="message message-error">
        <strong>Warning:</strong> You are about to delete this movie permanently. This action cannot be undone.
    </div>
    
    <div style="text-align: center; margin: 2rem 0;">
        <img src="<?= BASE_URL ?>/uploads/posters/<?php echo e($movie['poster']); ?>" 
            alt="<?php echo e($movie['title']); ?>"
            style="max-width: 200px; border-radius: 8px;"
            onerror="this.src='<?= BASE_URL ?>/uploads/posters/default.jpg'">
    </div>
    
    <h2 style="text-align: center; margin-bottom: 1rem;">
        <?php echo e($movie['title']); ?> (<?php echo e($movie['year']); ?>)
    </h2>
    
    <p style="text-align: center; margin-bottom: 2rem; color: #666;">
        <strong>Genre:</strong> <?php echo e($movie['genre']); ?> | 
        <strong>Rating:</strong> <?php echo e($movie['rating']); ?>
    </p>
    
    <form method="POST" style="text-align: center;">
        <button type="submit" class="btn btn-danger">Yes, Delete This Movie</button>
        <a href="dashboard.php" class="btn">Cancel</a>
    </form>
</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>