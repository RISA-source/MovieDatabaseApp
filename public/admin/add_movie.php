<?php 
$pageTitle = "Add Movie";
include __DIR__ . '/../../includes/header.php';
requireAdmin();

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
    $posterFilename = 'default.jpg';
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] !== UPLOAD_ERR_NO_FILE) {
        $uploadResult = uploadPoster($_FILES['poster']);
        if ($uploadResult['success']) {
            $posterFilename = $uploadResult['filename'];
        } else {
            $errors[] = $uploadResult['message'];
        }
    }
    
    // Insert if no errors
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO movies (title, year, genre, rating, description, cast, poster) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $year, $genre, $rating, $description, $cast, $posterFilename]);
        
        header('Location: dashboard.php?success=added');
        exit;
    }
}
?>

<h1 class="page-title">Add New Movie</h1>

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
            <input type="text" id="title" name="title" required value="<?php echo isset($_POST['title']) ? e($_POST['title']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="year">Year *</label>
            <input type="number" id="year" name="year" required value="<?php echo isset($_POST['year']) ? e($_POST['year']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="genre">Genre *</label>
            <input type="text" id="genre" name="genre" required placeholder="e.g., Action, Drama, Comedy" value="<?php echo isset($_POST['genre']) ? e($_POST['genre']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="rating">Rating (0-10) *</label>
            <input type="number" step="0.1" id="rating" name="rating" min="0" max="10" required value="<?php echo isset($_POST['rating']) ? e($_POST['rating']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="cast">Cast</label>
            <input type="text" id="cast" name="cast" placeholder="e.g., Actor 1, Actor 2, Actor 3" value="<?php echo isset($_POST['cast']) ? e($_POST['cast']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="description">Description *</label>
            <textarea id="description" name="description" required><?php echo isset($_POST['description']) ? e($_POST['description']) : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="poster">Poster Image (JPG, PNG, GIF - Max 5MB)</label>
            <input type="file" id="poster" name="poster" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-success">Add Movie</button>
        <a href="dashboard.php" class="btn">Cancel</a>
    </form>
</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>