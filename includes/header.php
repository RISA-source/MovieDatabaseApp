<?php require_once __DIR__ . '/../config/database.php'; ?>
<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? e($pageTitle) : 'Movie Database'; ?></title>
    <link rel="stylesheet" href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/MovieApp/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/MovieApp/public/index.php" class="logo">Movie Database</a>
            <ul class="nav-links">
                <li><a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/MovieApp/public/index.php">Home</a></li>
                <li><a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/MovieApp/public/search.php">Search</a></li>
                <?php if (isAdminLoggedIn()): ?>
                    <li><a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/MovieApp/public/admin/dashboard.php">Admin Dashboard</a></li>
                    <li><a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/MovieApp/public/admin/login.php?logout=1">Logout</a></li>
                <?php else: ?>
                    <li><a href="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/MovieApp/public/admin/login.php">Admin Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <main class="container">