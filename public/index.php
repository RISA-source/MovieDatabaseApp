<?php 
$pageTitle = "Home - Movie Database";
include __DIR__ . '/../includes/header.php'; 

// Fetch all movies
$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$movies = $stmt->fetchAll();
?>

<h1 class="page-title">All Movies</h1>

<?php if (empty($movies)): ?>
    <p>No movies found. Please check back later.</p>
<?php else: ?>
    <div class="movie-grid">
        <?php foreach ($movies as $movie): ?>
            <div class="movie-card">
                <img src="<?php echo getBaseUrl(); ?>/uploads/posters/<?php echo e($movie['poster']); ?>" 
                     alt="<?php echo e($movie['title']); ?>"
                     onerror="this.src='<?php echo getBaseUrl(); ?>/uploads/posters/default.jpg'">
                <div class="movie-info">
                    <h3><?php echo e($movie['title']); ?></h3>
                    <div class="movie-meta">
                        <span>Year: <?php echo e($movie['year']); ?></span>
                        <span>Rating: <?php echo e($movie['rating']); ?></span>
                    </div>
                    <p class="movie-description"><?php echo e($movie['description']); ?></p>
                    <p><strong>Genre:</strong> <?php echo e($movie['genre']); ?></p>
                    <a href="movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-small">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>