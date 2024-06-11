<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $password);

    if ($stmt->execute()) {
        header('Location: login.php');
        exit();
    } else {
        $error = "Registration failed. Username might be already taken.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up</title>
</head>
<body>
    <form method="POST">
        <h1>Sign Up</h1>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>
