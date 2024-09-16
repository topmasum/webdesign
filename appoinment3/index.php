<?php
include 'config.php';

// Fetch doctors
$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);

$success = isset($_GET['success']) ? $_GET['success'] : '';
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Appointment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Select a Doctor</h1>
        <?php if ($success): ?>
            <p class="message"><?php echo htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="select_time.php">
            <select name="doctor_id" onchange="this.form.submit()">
                <option value="">Select a Doctor</option>
                <?php while($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                <?php endwhile; ?>
            </select>
        </form>
    </div>
</body>
</html>