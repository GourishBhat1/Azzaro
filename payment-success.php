<?php
session_start();
require_once 'admin/connection.php';

// ✅ Validate Razorpay Payment ID & Booking ID
$payment_id = $_GET['payment_id'] ?? null;
$booking_id = $_SESSION['booking_id'] ?? $_GET['booking_id'] ?? null;

if (!$payment_id || !$booking_id) {
    die("Error: Missing payment details. Please contact support.");
}

// ✅ Check if Payment Already Exists
$check_payment = $conn->prepare("SELECT COUNT(*) FROM payments WHERE razorpay_payment_id = ?");
if (!$check_payment) {
    die("DB Error: " . $conn->error);
}
$check_payment->bind_param("s", $payment_id);
$check_payment->execute();
$check_payment->bind_result($existing_payment_count);
$check_payment->fetch();
$check_payment->close();

if ($existing_payment_count > 0) {
    // ✅ Payment already recorded, prevent duplicate entry
    header("Location: index.php"); // Redirect to home (or any confirmation page)
    exit();
}

// ✅ Fetch Booking Details
$stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
if (!$stmt) {
    die("DB Error: " . $conn->error);
}
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();

if (!$booking) {
    die("Error: Booking not found. Please contact support.");
}

// ✅ Convert Stored Amount from Paise to INR
$total_amount_paise = $booking['payment_amount'] ?? null;
if (!$total_amount_paise) {
    die("Error: Missing payment amount in database.");
}
$total_amount_inr = $total_amount_paise / 100; // Convert from paise to ₹ INR

// ✅ Update Payment Status in `bookings`
$update_payment = "UPDATE bookings SET payment_status = 'Paid' WHERE booking_id = ?";
$stmt = $conn->prepare($update_payment);
if (!$stmt) {
    die("SQL Prepare Error: " . $conn->error);
}
$stmt->bind_param("i", $booking_id);
if (!$stmt->execute()) {
    die("SQL Execution Error: " . $stmt->error);
}

// ✅ Insert Correct Amount into `payments` Table
$insert_payment = "INSERT INTO payments (booking_id, amount, razorpay_payment_id, status, payment_date) 
                   VALUES (?, ?, ?, 'Success', NOW())";
$stmt = $conn->prepare($insert_payment);
if (!$stmt) {
    die("SQL Prepare Error: " . $conn->error);
}
$stmt->bind_param("ids", $booking_id, $total_amount_inr, $payment_id);
if (!$stmt->execute()) {
    die("SQL Execution Error: " . $stmt->error);
}

// ✅ Unset Session Variables to Prevent Reprocessing
unset($_SESSION['booking_id']);
unset($_SESSION['order_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Payment Success - Azzaro Resorts & Spa</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <style>
    /* ✅ Preloader Fix */
    #preloader {
      position: fixed;
      width: 100%;
      height: 100%;
      background: white url('assets/img/loading.gif') no-repeat center center;
      z-index: 9999;
    }
    #preloader.hidden {
      display: none;
    }
  </style>
</head>

<body>
  <!-- ✅ Preloader -->
  <div id="preloader"></div>

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo">
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

  <main class="main py-5">
    <div class="container text-center">
      <h2 class="text-success mb-3">Payment Successful!</h2>
      <p class="lead">Thank you for your payment. Your booking is confirmed.</p>
      <p>A confirmation email has been sent to your inbox.</p>

      <div class="border p-3 rounded mt-4">
        <h5>Booking Details</h5>
        <p><strong>Booking ID:</strong> <?= htmlspecialchars($booking_id) ?></p>
        <p><strong>Check-In:</strong> <?= htmlspecialchars($booking['check_in']) ?></p>
        <p><strong>Check-Out:</strong> <?= htmlspecialchars($booking['check_out']) ?></p>
        <p><strong>Total Paid:</strong> ₹ <?= number_format($total_amount_inr, 2) ?></p>
        <p><strong>Payment ID:</strong> <?= htmlspecialchars($payment_id) ?></p>
      </div>

      <a href="index.php" class="btn btn-get-started mt-3">Back to Home</a>
    </div>
  </main>

  <footer id="footer" class="footer light-background">
    <div class="container text-center">
      <p>© 2025 Azzaro Resorts & Spa. All Rights Reserved.</p>
    </div>
  </footer>

  <a href="#" class="scroll-top"><i class="bi bi-arrow-up-short"></i></a>

  <!-- ✅ JavaScript to Remove Preloader -->
  <script>
    window.onload = function () {
      document.getElementById('preloader').classList.add('hidden');
    };
  </script>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
