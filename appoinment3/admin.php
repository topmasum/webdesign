<?php
include 'config.php';

// Handle doctor form submission
if (isset($_POST['add_doctor'])) {
    $doctor_name = $_POST['doctor_name'];
    $sql = "INSERT INTO doctors (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $doctor_name);
    $stmt->execute();
}

// Handle time slot form submission
if (isset($_POST['add_time_slot'])) {
    $doctor_id = $_POST['doctor_id'];
    $time_slot = $_POST['time_slot'];
    $sql = "INSERT INTO appointment_times (doctor_id, time_slot, is_occupied) VALUES (?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $doctor_id, $time_slot);
    $stmt->execute();
}

// Fetch existing doctors
$doctors_result = $conn->query("SELECT * FROM doctors");

// Fetch existing time slots
$time_slots_result = $conn->query("SELECT t.id, t.time_slot, t.is_occupied, d.name AS doctor_name FROM appointment_times t JOIN doctors d ON t.doctor_id = d.id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Doctors and Time Slots</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin - Manage Doctors and Time Slots</h1>
        
        <!-- Add Doctor -->
        <h2>Add Doctor</h2>
        <form method="POST" action="admin.php">
            <label for="doctor_name">Doctor Name:</label>
            <input type="text" id="doctor_name" name="doctor_name" required>
            <input type="submit" name="add_doctor" value="Add Doctor">
        </form>
        
        <!-- Add Time Slot -->
        <h2>Add Time Slot for Doctor</h2>
        <form method="POST" action="admin.php">
            <label for="doctor_id">Select Doctor:</label>
            <select id="doctor_id" name="doctor_id" required>
                <option value="">Select a Doctor</option>
                <?php while ($row = $doctors_result->fetch_assoc()): ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                <?php endwhile; ?>
            </select>
            
            <label for="time_slot">Time Slot (e.g. 10:00 AM - 11:00 AM):</label>
            <input type="text" id="time_slot" name="time_slot" required>
            
            <input type="submit" name="add_time_slot" value="Add Time Slot">
        </form>
        
        <!-- Display Time Slots -->
        <h2>Existing Time Slots</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time Slot</th>
                    <th>Doctor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $time_slots_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['time_slot']); ?></td>
                        <td><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                        <td><?php echo $row['is_occupied'] ? 'Occupied' : 'Available'; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
