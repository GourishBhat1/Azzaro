<?php
session_start();
require_once 'admin/connection.php';

// ✅ Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch user data
$stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// ✅ Fetch recent bookings
$bookings_stmt = $conn->prepare("
    SELECT b.booking_id, r.room_name, b.check_in, b.check_out, b.status 
    FROM bookings b
    JOIN rooms r ON b.room_id = r.room_id
    WHERE b.user_id = ?
    ORDER BY b.booking_id DESC LIMIT 3
");
$bookings_stmt->bind_param("i", $user_id);
$bookings_stmt->execute();
$recent_bookings = $bookings_stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Dashboard - Azzaro Resorts & Spa</title>

  <!-- Favicons & CSS -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    /* Professional Dashboard Styling */
    .dashboard-container {
      max-width: 1000px;
      margin: 50px auto;
      padding: 30px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.12);
    }

    .dashboard-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .dashboard-header h2 {
      font-weight: 700;
      color: #1b7a78;
      font-size: 28px;
    }

    .dashboard-header p {
      font-size: 16px;
      color: #666;
    }

    .dashboard-card {
      background: #f8f9fa;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.08);
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
    }

    .dashboard-card h4 {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .dashboard-card p {
      font-size: 15px;
      color: #555;
    }

    .btn-dashboard {
      background-color: #1b7a78;
      color: white;
      font-size: 16px;
      font-weight: 600;
      padding: 12px;
      border-radius: 8px;
      width: 100%;
      transition: background 0.3s ease-in-out;
    }

    .btn-dashboard:hover {
      background-color: #154a4f;
    }

    .booking-table th {
      background-color: #1b7a78;
      color: white;
      font-size: 15px;
    }

    .status-confirmed {
      color: #28a745;
      font-weight: 600;
    }

    .status-pending {
      color: #ffc107;
      font-weight: 600;
    }

    .status-canceled {
      color: #dc3545;
      font-weight: 600;
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
      <div class="dashboard-container">
        <div class="dashboard-header">
          <h2>Welcome, <?= htmlspecialchars($user['username']) ?>!</h2>
          <p>Your personal dashboard for bookings and account management.</p>
        </div>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="dashboard-card">
              <h4>Account Information</h4>
              <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
              <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
              <a href="edit-profile.php" class="btn btn-dashboard">Edit Profile</a>
            </div>
          </div>

          <div class="col-md-6">
            <div class="dashboard-card">
              <h4>Upcoming Stays</h4>
              <p><strong>Next Check-in:</strong> <?= $recent_bookings->num_rows > 0 ? htmlspecialchars($recent_bookings->fetch_assoc()['check_in']) : 'No upcoming stays' ?></p>
              <a href="my-bookings.php" class="btn btn-dashboard">View Bookings</a>
            </div>
          </div>
        </div>

        <h3 class="mt-5">Recent Bookings</h3>
        <table class="table table-hover booking-table">
          <thead>
            <tr>
              <th>Booking ID</th>
              <th>Room</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($booking = $recent_bookings->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                <td><?= htmlspecialchars($booking['room_name']) ?></td>
                <td><?= htmlspecialchars($booking['check_in']) ?></td>
                <td><?= htmlspecialchars($booking['check_out']) ?></td>
                <td class="<?= $booking['status'] == 'confirmed' ? 'status-confirmed' : ($booking['status'] == 'pending' ? 'status-pending' : 'status-canceled') ?>">
                  <?= htmlspecialchars(ucfirst($booking['status'])) ?>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

      </div>
    </div>
  </section>
</main>

<footer id="footer" class="footer light-background">
    <div class="container text-center">
      <p>© <?= date("Y") ?> Azzaro Resorts & Spas. All Rights Reserved.</p>
    </div>
</footer>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>
