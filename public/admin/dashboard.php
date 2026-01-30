<?php 
$pageTitle = "Admin Dashboard";
include __DIR__ . '/../../includes/header.php';
requireAdmin();

// Fetch all movies
$stmt = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$movies = $stmt->fetchAll();
?>

<h1 class="page-title">Admin Dashboard</h1>

<?php if (isset($_GET['success'])): ?>
    <div class="message message-success">
        <?php
        if ($_GET['success'] === 'added') echo 'Movie added successfully';
        if ($_GET['success'] === 'updated') echo 'Movie updated successfully';
        if ($_GET['success'] === 'deleted') echo 'Movie deleted successfully';
        ?>
    </div>
<?php endif; ?>

<a href="add_movie.php" class="btn btn-success">Add New Movie</a>

<table class="table" style="margin-top: 2rem;">
    <thead>
        <tr>
            <th>Poster</th>
            <th>Title</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movies as $movie): ?>
            <tr>
                <td>
                    <img src="<?= BASE_URL ?>/uploads/posters/<?php echo e($movie['poster']); ?>" 
                         alt="<?php echo e($movie['title']); ?>"
                         onerror="this.src='<?= BASE_URL ?>/uploads/posters/default.jpg'">
                </td>
                <td><?php echo e($movie['title']); ?></td>
                <td><?php echo e($movie['year']); ?></td>
                <td><?php echo e($movie['genre']); ?></td>
                <td><?php echo e($movie['rating']); ?></td>
                <td>
                    <a href="edit_movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-small">Edit</a>
                    <a href="delete_movie.php?id=<?php echo $movie['id']; ?>" class="btn btn-small btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../../includes/footer.php'; ?>