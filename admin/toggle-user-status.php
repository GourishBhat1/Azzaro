<?php
require_once 'connection.php';

// Check if ID & action are set
if (!isset($_GET['id']) || !isset($_GET['action'])) {
    die("Invalid request.");
}

$user_id = intval($_GET['id']);
$action = $_GET['action'] === 'deactivate' ? 'Inactive' : 'Active';

// Update customer status
$stmt = $conn->prepare("UPDATE users SET status = ? WHERE user_id = ?");
$stmt->bind_param("si", $action, $user_id);
$stmt->execute();

// Redirect back
header("Location: user-management.php");
exit();
?>
