<?php 
$pageTitle = "Search Movies";
include __DIR__ . '/../includes/header.php'; 

$searchResults = [];
$searched = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searched = true;
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $year = isset($_POST['year']) ? trim($_POST['year']) : '';
    $genre = isset($_POST['genre']) ? trim($_POST['genre']) : '';
    $rating = isset($_POST['rating']) ? trim($_POST['rating']) : '';
    
    // Build dynamic query with prepared statements
    $sql = "SELECT * FROM movies WHERE 1=1";
    $params = [];
    
    if ($title) {
        $sql .= " AND title LIKE ?";
        $params[] = "%$title%";
    }
    
    if ($year) {
        $sql .= " AND year = ?";
        $params[] = $year;
    }
    
    if ($genre) {
        $sql .= " AND genre LIKE ?";
        $params[] = "%$genre%";
    }
    
    if ($rating) {
        $sql .= " AND rating >= ?";
        $params[] = $rating;
    }
    
    $sql .= " ORDER BY created_at DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $searchResults = $stmt->fetchAll();
}
?>

<h1 class="page-title">Search Movies</h1>

<div class="search-form">
    <form method="POST">
        <div class="search-grid">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="Search by title">
            </div>
            
            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" id="year" name="year" placeholder="e.g., 2024">
            </div>
            
            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" placeholder="e.g., Action">
            </div>
            
            <div class="form-group">
                <label for="rating">Minimum Rating</label>
                <select id="rating" name="rating">
                    <option value="">Any</option>
                    <option value="9">9.0+</option>
                    <option value="8">8.0+</option>
                    <option value="7">7.0+</option>
                    <option value="6">6.0+</option>
                    <option value="5">5.0+</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="btn">Search</button>
    </form>
</div>

<?php if ($searched): ?>
    <h2>Search Results (<?php echo count($searchResults); ?> found)</h2>
    
    <?php if (empty($searchResults)): ?>
        <p>No movies match your search criteria.</p>
    <?php else: ?>
        <div class="movie-grid">
            <?php foreach ($searchResults as $movie): ?>
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
<?php endif; ?>

<?php include __DIR__ . '/../includes/footer.php'; ?>