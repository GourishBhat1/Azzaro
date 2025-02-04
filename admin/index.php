<?php
// index.php (Admin Login)
session_start();
require_once 'connection.php'; // Database connection

// Redirect if already logged in via session or cookie
if (isset($_SESSION['admin_logged_in']) || isset($_COOKIE['azzaro_admin'])) {
    header('Location: dashboard.php');
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Check credentials in the database
        $stmt = $conn->prepare("SELECT user_id, username, password_hash FROM users WHERE username = ? AND role = 'admin'");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($admin_id, $db_username, $db_password_hash);
            $stmt->fetch();

            if (password_verify($password, $db_password_hash)) {
                // Set session variables
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_username'] = $db_username;

                // Set a persistent cookie for automatic login (valid for 30 days)
                setcookie("azzaro_admin", $db_username, [
                    'expires' => time() + (30 * 24 * 60 * 60), // 30 days
                    'path' => '/',
                    'secure' => isset($_SERVER['HTTPS']), // Enable only if using HTTPS
                    'httponly' => true,
                    'samesite' => 'Strict'
                ]);

                header('Location: dashboard.php');
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
        $stmt->close();
    } else {
        $error = "Please enter both username and password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Azzaro Admin - Login</title>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="text-center">
  <div class="container mt-5" style="max-width:400px;">
    <h1>Admin Login</h1>
    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required />
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required />
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a href="forgot-password.php" class="d-block mt-2">Forgot Password?</a>
    </form>
  </div>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
