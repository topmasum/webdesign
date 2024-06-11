<?php
require 'config.php';

function getAllBlogs($conn) {
    $sql = "SELECT blogs.id, blogs.title, blogs.content, users.username, blogs.user_id 
            FROM blogs 
            JOIN users ON blogs.user_id = users.id";
    $result = $conn->query($sql);

    return $result->fetch_all(MYSQLI_ASSOC);
}

function getUserBlogs($conn, $user_id) {
    $sql = "SELECT blogs.id, blogs.title, blogs.content, users.username, blogs.user_id 
            FROM blogs 
            JOIN users ON blogs.user_id = users.id
            WHERE blogs.user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
