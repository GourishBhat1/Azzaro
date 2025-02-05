<?php
session_start();
require_once 'admin/connection.php';

// ✅ Handle Login Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Debugging: Check if SQL Query Fails
    $stmt = $conn->prepare("SELECT user_id, username, password_hash FROM users WHERE email = ? AND role = 'customer'");
    if (!$stmt) {
        die("SQL Prepare Error: " . $conn->error);  // ✅ Debugging Step
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - Azzaro Resorts & Spa</title>

  <!-- Favicons & CSS -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    .login-container {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: #ffffff;
      border-radius: 8px;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    .login-container h2 {
      margin-bottom: 20px;
      font-weight: 700;
      color: #1b7a78;
    }
    .form-control {
      height: 45px;
      font-size: 16px;
      border-radius: 5px;
    }
    .btn-login {
      background-color: #1b7a78;
      color: white;
      font-size: 18px;
      font-weight: 600;
      padding: 12px;
      border-radius: 5px;
      width: 100%;
      transition: 0.3s;
    }
    .btn-login:hover {
      background-color: #154a4f;
    }
    .error {
      color: red;
      font-size: 14px;
    }
    .login-container p a {
      color: #1b7a78;
      font-weight: 600;
      text-decoration: none;
    }
    .login-container p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/new_img/azzaro_logo.jpg" alt="">
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
          <li><a href="rooms.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'rooms.php' ? 'active' : ''; ?>">Stays</a></li>
          <li><a href="gallery.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : ''; ?>">Gallery</a></li>
          <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>

          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php else: ?>
            <li><a href="login.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">Login</a></li>
          <?php endif; ?>
        </ul>
        
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
</header>

<main class="main">
  <section class="section pt-5">
    <div class="container" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="login-container">
            <h2>Login</h2>

            <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>

            <form action="login.php" method="POST">
              <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email Address" required>
              </div>
              <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <button type="submit" class="btn btn-login">Login</button>
            </form>

            <p class="mt-3">Don't have an account? <a href="register.php">Register</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<footer id="footer" class="footer light-background">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3 mb-3 mb-md-0">
          <div class="widget">
            <h3 class="widget-heading">About Us</h3>
            <p class="mb-4">
              Escape into luxury at our resort, where relaxation meets nature's finest.
            </p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ps-lg-5 mb-3 mb-md-0">
          <div class="widget">
            <h3 class="widget-heading">Navigation</h3>
            <ul class="list-unstyled">
              <li><a href="index.php">Home</a></li>
              <li><a href="rooms.html">Stays</a></li>
              <li><a href="gallery.html">Gallery</a></li>
              <li><a href="contact.html">Contact</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 pl-lg-5">
          <div class="widget">
            <h3 class="widget-heading">Latest Blogs</h3>
            <ul class="list-unstyled">
              <li><a href="#">Visit Diu - A Visual Journey</a></li>
              <li><a href="#">A Complete Travel Guide to Diu</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 pl-lg-5">
          <div class="widget">
            <h3 class="widget-heading">Connect</h3>
            <ul class="list-unstyled">
              <li><a href="#"><i class="bi bi-facebook"></i> Facebook</a></li>
              <li><a href="#"><i class="bi bi-instagram"></i> Instagram</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</footer>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>
