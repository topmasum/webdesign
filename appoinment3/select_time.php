<?php
include 'config.php';

$doctor_id = $_POST['doctor_id'];

if (!$doctor_id) {
    header("Location: index.php");
    exit;
}

// Fetch available times
$sql = "SELECT * FROM appointment_times WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Time</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Available Times</h1>
        <form method="POST" action="book_appointment.php">
            <input type="hidden" name="doctor_id" value="<?php echo htmlspecialchars($doctor_id); ?>">
            <select name="time_slot">
                <option value="">Select a Time</option>
                <?php while($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>" class="<?php echo $row['is_occupied'] ? 'option-occupied' : ''; ?>">
                        <?php echo htmlspecialchars($row['time_slot']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <input type="submit" value="Book Appointment">
        </form>
    </div>
</body>
</html>
