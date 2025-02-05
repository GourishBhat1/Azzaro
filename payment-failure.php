<?php
require 'admin/connection.php';

if (!isset($_GET['booking_id'])) {
    header("Location: index.php");
    exit();
}

$booking_id = intval($_GET['booking_id']);

// Fetch booking details
$stmt = $conn->prepare("SELECT r.room_name, b.check_in, b.check_out FROM bookings b JOIN rooms r ON b.room_id = r.room_id WHERE b.booking_id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();

if (!$booking) {
    header("Location: index.php?error=invalid_booking");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Payment Failure - Azzaro Resorts & Spa</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
  <header id="header" class="header sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo"><img src="assets/new_img/azzaro_logo.jpg" alt="Azzaro"></a>
    </div>
  </header>

  <main class="main py-5">
    <div class="container text-center">
      <h2 class="text-danger mb-3">Payment Failed</h2>
      <p class="lead">Unfortunately, your payment could not be processed.</p>
      <p>Please try again or contact our support team if the issue persists.</p>

      <!-- Booking Summary -->
      <div class="border p-3 rounded mb-4">
        <h5>Booking Details</h5>
        <p><strong>Check-In:</strong> <?= $booking['check_in'] ?><br>
           <strong>Check-Out:</strong> <?= $booking['check_out'] ?><br>
           <strong>Room Type:</strong> <?= htmlspecialchars($booking['room_name']) ?></p>
      </div>

      <a href="checkout.php?booking_id=<?= $booking_id ?>" class="btn btn-get-started mt-3">Retry Payment</a>
      <a href="index.php" class="btn btn-link mt-3">Back to Home</a>
    </div>
  </main>

  <footer id="footer" class="footer text-center">
    <div class="container"><p>© 2025 Azzaro Resorts & Spa. All Rights Reserved.</p></div>
  </footer>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
