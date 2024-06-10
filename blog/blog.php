<?php
require 'config.php';

$blog_id = $_GET['id'];
$sql = "SELECT blogs.title, blogs.content, users.username FROM blogs JOIN users ON blogs.user_id = users.id WHERE blogs.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title><?= htmlspecialchars($blog['title']) ?></title>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($blog['title']) ?></h1>
        <p>by <?= htmlspecialchars($blog['username']) ?></p>
    </header>
    <main>
        <article>
            <?= nl2br(htmlspecialchars($blog['content'])) ?>
        </article>
    </main>
</body>
</html>
