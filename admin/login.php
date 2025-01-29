<?php
// login.php (standalone)
session_start();
if (isset($_SESSION['admin_logged_in'])) {
  header('Location: dashboard.php');
  exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve username & password from POST
  $username = $_POST['username'];
  $password = $_POST['password'];

  // TODO: Validate credentials via DB
  // $hash = password_hash(...) stored in DB
  // if (password_verify($password, $hash_from_db)) ...

  // For demonstration, let's say it's successful:
  $_SESSION['admin_logged_in'] = true;
  $_SESSION['admin_username'] = $username;
  header('Location: dashboard.php');
  exit;
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
