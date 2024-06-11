<?php
session_start();
require 'config.php';
require 'functions.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $blogs = getUserBlogs($conn, $user_id);
} else {
    $blogs = getAllBlogs($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Blog Website</title>
<style type="text/css">
    .learn-more-button {
    background-color: #16a085;
    color: white;
    border: 1px solid ;
    padding: 0.5em 1em;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.3s;
    text-transform: uppercase; /* Uppercase text */
    font-weight: bold; /* Bold text */
}

.learn-more-button:hover {
    background-color: #fff;
    color: #16a085;
    border: 1px solid #16a085;
    transform: scale(1.05); /* Scale effect on hover */
}

</style>
</head>
<body>
    <header>
        <h1>Blog Website</h1>
        <div class="auth-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="post_blog.php">Post Blog</a> | 
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a> | 
                <a href="register.php">Sign Up</a>
            <?php endif; ?>
        </div>
    </header>
    <main>
        <div class="blog-container">
            <?php foreach ($blogs as $blog): ?>
                <div class="blog-card">
                    <h2><?= htmlspecialchars($blog['title']) ?></h2>
                    <p>by <?= htmlspecialchars($blog['username']) ?></p>
                    <p><?= htmlspecialchars(substr($blog['content'], 0, 100)) ?>...</p>
                    <button class="learn-more-button" onclick="window.location.href='blog.php?id=<?= htmlspecialchars($blog['id']) ?>'">Learn More</button>
                    <?php if (isset($_SESSION['user_id']) && $blog['user_id'] == $_SESSION['user_id']): ?>
                        <form action="delete_blog.php" method="POST" style="display:inline;">
                            <input type="hidden" name="blog_id" value="<?= htmlspecialchars($blog['id']) ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this blog?')">Delete</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>
