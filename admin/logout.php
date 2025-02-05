<?php
// logout.php - Admin Logout
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Clear persistent login cookie
if (isset($_COOKIE['azzaro_admin'])) {
    setcookie("azzaro_admin", "", time() - 3600, "/");
}

// Redirect to login page
header("Location: index.php");
exit();
?>
