<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   <div class="container">
        <h1>Doctor Information</h1>
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Degree</th>
                <th>Medical</th>
                <th>Email</th>
                <th>Category</th>
                <th>Visiting Days</th>
                <th>Visiting Time</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['degree']; ?></td>
                <td><?php echo $row['medical']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['visiting_days']; ?></td>
                <td><?php echo $row['visiting_time']; ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
<?php $conn->close(); ?>