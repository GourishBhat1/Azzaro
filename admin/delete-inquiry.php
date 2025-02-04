<?php
require_once 'connection.php';

// Check if inquiry ID is set
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: inquiries.php");
    exit();
}

$inquiry_id = $_GET['id'];

// Prepare and execute delete query
$stmt = $conn->prepare("DELETE FROM inquiries WHERE inquiry_id = ?");
$stmt->bind_param("i", $inquiry_id);
if ($stmt->execute()) {
    echo "<script>alert('Inquiry deleted successfully!'); window.location.href='inquiries.php';</script>";
} else {
    echo "<script>alert('Error deleting inquiry!'); window.location.href='inquiries.php';</script>";
}
exit();
?>
