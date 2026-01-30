<?php 
include __DIR__ . '/../includes/header.php'; 

// Get movie ID from URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch movie details using prepared statement
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    echo "<p>Movie not found.</p>";
    include __DIR__ . '/../includes/footer.php';
    exit;
}

$pageTitle = e($movie['title']) . " - Movie Database";
?>

<h1 class="page-title"><?php echo e($movie['title']); ?></h1>

<div class="movie-detail">
    <div>
        <img src="<?= BASE_URL ?>/uploads/posters/<?php echo e($movie['poster']); ?>" 
             alt="<?php echo e($movie['title']); ?>"
             onerror="this.src='<?= BASE_URL ?>/uploads/posters/default.jpg'">
    </div>
    <div class="movie-detail-info">
        <h1><?php echo e($movie['title']); ?> (<?php echo e($movie['year']); ?>)</h1>
        <p><strong>Genre:</strong> <?php echo e($movie['genre']); ?></p>
        <p><strong>Rating:</strong> <?php echo e($movie['rating']); ?> / 10</p>
        <p><strong>Cast:</strong> <?php echo e($movie['cast']); ?></p>
        <p><strong>Description:</strong></p>
        <p><?php echo nl2br(e($movie['description'])); ?></p>
        <a href="index.php" class="btn">Back to Movies</a>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>