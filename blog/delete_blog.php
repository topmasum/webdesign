<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $blog_id = $_POST['blog_id'];
    $user_id = $_SESSION['user_id'];

    // Check if the blog belongs to the logged-in user
    $sql = "DELETE FROM blogs WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $blog_id, $user_id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        $error = "Failed to delete the blog.";
    }
}
?>
