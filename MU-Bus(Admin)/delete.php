<?php
include 'includes/header.php';
include 'db.php';

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid request. No schedule ID provided.</div>";
    exit;
}

$id = intval($_GET['id']);

// First, fetch the `day` of the record so we can redirect to the correct dashboard
$stmt = $conn->prepare("SELECT day FROM bus_schedule WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-warning'>No schedule found with the given ID.</div>";
    exit;
}

$row = $result->fetch_assoc();
$day = $row['day'];

// Delete the schedule
$delete = $conn->prepare("DELETE FROM bus_schedule WHERE id = ?");
$delete->bind_param("i", $id);
$delete->execute();

// Redirect back to the same day dashboard
header("Location: dashboard.php?day=" . urlencode($day));
exit;
?>
