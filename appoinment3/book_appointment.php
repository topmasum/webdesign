<?php
include 'config.php';

$doctor_id = $_POST['doctor_id'];
$time_id = $_POST['time_slot'];

// Check if the time slot is already occupied
$sql = "SELECT is_occupied FROM appointment_times WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $time_id);
$stmt->execute();
$result = $stmt->get_result();
$time = $result->fetch_assoc();

if ($time['is_occupied']) {
    // Redirect with an error message
    header("Location: index.php?doctor_id=$doctor_id&error=Time slot occupied");
    exit;
}

// Update the time slot to be occupied
$sql = "UPDATE appointment_times SET is_occupied = TRUE WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $time_id);
$stmt->execute();

// Redirect with a success message
header("Location: index.php?success=Appointment booked");
exit;
?>
