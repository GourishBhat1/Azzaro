<?php
require_once 'connection.php';

// Ensure ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: user-management.php?error=Invalid+customer+ID");
    exit();
}

$customer_id = intval($_GET['id']);

// Check if the customer exists
$check_stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ? AND role = 'customer'");
$check_stmt->bind_param("i", $customer_id);
$check_stmt->execute();
$result = $check_stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: user-management.php?error=Customer+not+found");
    exit();
}

// Delete the customer (also removes associated bookings if needed)
$delete_stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
$delete_stmt->bind_param("i", $customer_id);

if ($delete_stmt->execute()) {
    header("Location: user-management.php?success=Customer+deleted+successfully");
} else {
    header("Location: user-management.php?error=Failed+to+delete+customer");
}
exit();
?>
