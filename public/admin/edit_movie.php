<?php 
$pageTitle = "Edit Movie";
include __DIR__ . '/../../includes/header.php';
requireAdmin();

// Get movie ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch movie
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    $title = trim($_POST['title']);
    $year = (int)$_POST['year'];
    $genre = trim($_POST['genre']);
    $rating = (float)$_POST['rating'];
    $description = trim($_POST['description']);
    $cast = trim($_POST['cast']);
    
    if (empty($title)) $errors[] = 'Title is required';
    if ($year < 1800 || $year > date('Y') + 5) $errors[] = 'Invalid year';
    if (empty($genre)) $errors[] = 'Genre is required';
    if ($rating < 0 || $rating > 10) $errors[] = 'Rating must be between 0 and 10';
    if (empty($description)) $errors[] = 'Description is required';
    
    // Handle file upload
    $posterFilename = $movie['poster'];
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadResult = uploadPoster($_FILES['poster']);
        if ($uploadResult['success']) {
            // Delete old poster if not default
            deletePoster($movie['poster']);
            $posterFilename = $uploadResult['filename'];
        } else {
            $errors[] = $uploadResult['message'];
        }
    }
    
    // Update if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE movies SET title = ?, year = ?, genre = ?, rating = ?, description = ?, cast = ?, poster = ? WHERE id = ?");
        $stmt->execute([$title, $year, $genre, $rating, $description, $cast, $posterFilename, $id]);
        
        header('Location: dashboard.php?success=updated');
        exit;
    }
}
?>

<h1 class="page-title">Edit Movie</h1>

<div class="form-card">
    <?php if (!empty($errors)): ?>
        <div class="message message-error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title *</label>
            <input type="text" id="title" name="title" required value="<?php echo e($movie['title']); ?>">
        </div>
        
        <div class="form-group">
            <label for="year">Year *</label>
            <input type="number" id="year" name="year" required value="<?php echo e($movie['year']); ?>">
        </div>
        
        <div class="form-group">
            <label for="genre">Genre *</label>
            <input type="text" id="genre" name="genre" required value="<?php echo e($movie['genre']); ?>">
        </div>
        
        <div class="form-group">
            <label for="rating">Rating (0-10) *</label>
            <input type="number" step="0.1" id="rating" name="rating" min="0" max="10" required value="<?php echo e($movie['rating']); ?>">
        </div>
        
        <div class="form-group">
            <label for="cast">Cast</label>
            <input type="text" id="cast" name="cast" value="<?php echo e($movie['cast']); ?>">
        </div>
        
        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" required><?php echo e($movie['description']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Current Poster</label>
            <img src="<?= BASE_URL ?>/uploads/posters/<?php echo e($movie['poster']); ?>" 
                style="max-width: 200px; display: block; margin-bottom: 10px;"
                onerror="this.src='<?= BASE_URL ?>/uploads/posters/default.jpg'">
        </div>
        
        <div class="form-group">
            <label for="poster">Change Poster (JPG, PNG, GIF - Max 5MB)</label>
            <input type="file" id="poster" name="poster" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-success">Update Movie</button>
        <a href="dashboard.php" class="btn">Cancel</a>
    </form>
</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>