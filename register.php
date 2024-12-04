<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $degree = $_POST['degree'];
    $medical = $_POST['medical'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    $visiting_days = $_POST['visiting_days'];
    $visiting_time = $_POST['visiting_time'];

    $sql = "INSERT INTO doctors (name, degree, medical, email, category, visiting_days, visiting_time) 
            VALUES ('$name', '$degree', '$medical', '$email', '$category', '$visiting_days', '$visiting_time')";

    if ($conn->query($sql) === TRUE) {
        echo "Doctor registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
