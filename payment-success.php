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
$check_payment->bind_param("s", $payment_id);
$check_payment->execute();
$check_payment->bind_result($existing_payment_count);
$check_payment->fetch();
$check_payment->close();

if ($existing_payment_count > 0) {
    // ✅ Payment already recorded, prevent duplicate entry
    header("Location: index.php");
    exit();
}

// ✅ Fetch Booking Details
$stmt = $conn->prepare("SELECT b.*, u.email FROM bookings b JOIN users u ON b.user_id = u.user_id WHERE b.booking_id = ?");
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
$stmt->bind_param("i", $booking_id);
$stmt->execute();

// ✅ Insert Correct Amount into `payments` Table
$insert_payment = "INSERT INTO payments (booking_id, amount, razorpay_payment_id, status, payment_date) 
                   VALUES (?, ?, ?, 'Success', NOW())";
$stmt = $conn->prepare($insert_payment);
$stmt->bind_param("ids", $booking_id, $total_amount_inr, $payment_id);
$stmt->execute();

// ✅ Generate Unique Verification Code for Admin (MD5 Hash)
$verification_code = md5($booking_id . $booking['check_in'] . $booking['check_out'] . $payment_id);

// ✅ Send Email Notifications
$customer_email = $booking['email'];
$admin_email = "info@azzarodiu.com";

// ✅ Customer Email: Payment Confirmation
$customer_subject = "Payment Confirmation - Azzaro Resort & Spa";
$customer_message = "
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h2>Payment Successful!</h2>
    <p>Dear Guest,</p>
    <p>Your payment has been successfully received. Below are your booking details:</p>
    <p><strong>Booking ID:</strong> {$booking_id}</p>
    <p><strong>Check-In:</strong> {$booking['check_in']}</p>
    <p><strong>Check-Out:</strong> {$booking['check_out']}</p>
    <p><strong>Total Paid:</strong> ₹" . number_format($total_amount_inr, 2) . "</p>
    <p>Your booking confirmation will be sent shortly by the resort.</p>
    <p>Thank you for choosing Azzaro Resort & Spa!</p>
</body>
</html>
";

// ✅ Admin Email: New Booking Alert
$admin_subject = "New Booking Received - Azzaro Resort & Spa";
$admin_message = "
<html>
<head>
    <title>New Booking Notification</title>
</head>
<body>
    <h2>New Booking Alert</h2>
    <p>A new booking has been made.</p>
    <p><strong>Booking ID:</strong> {$booking_id}</p>
    <p><strong>Guest Email:</strong> {$customer_email}</p>
    <p><strong>Check-In:</strong> {$booking['check_in']}</p>
    <p><strong>Check-Out:</strong> {$booking['check_out']}</p>
    <p><strong>Total Paid:</strong> ₹" . number_format($total_amount_inr, 2) . "</p>
    <p><strong>Verification Code:</strong> {$verification_code}</p>
    <p>Please verify and confirm the booking.</p>
</body>
</html>
";

// ✅ Function to Send Email
function sendEmail($to, $subject, $message) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: noreply@azzarodiu.com" . "\r\n";

    mail($to, $subject, $message, $headers);
}

// ✅ Send Emails
sendEmail($customer_email, $customer_subject, $customer_message);
sendEmail($admin_email, $admin_subject, $admin_message);

// ✅ Unset Session Variables
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

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

      <div class="border p-3 rounded mt-4" id="booking-details">
        <img src="assets/new_img/azzaro_logo.jpg" width="150" class="mb-3" alt="Azzaro Resort Logo">
        <h5>Booking Details</h5>
        <p><strong>Booking ID:</strong> <?= htmlspecialchars($booking_id) ?></p>
        <p><strong>Check-In:</strong> <?= htmlspecialchars($booking['check_in']) ?></p>
        <p><strong>Check-Out:</strong> <?= htmlspecialchars($booking['check_out']) ?></p>
        <p><strong>Total Paid:</strong> ₹ <?= number_format($total_amount_inr, 2) ?></p>
        <p><strong>Payment ID:</strong> <?= htmlspecialchars($payment_id) ?></p>
        <p><strong>Verification Code:</strong> <?= $verification_code ?></p>
      </div>

      <button onclick="downloadPDF()" class="btn btn-primary mt-3">Download Receipt</button>
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

  <script>
    function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        html2canvas(document.querySelector("#booking-details")).then(canvas => {
            const imgData = canvas.toDataURL("image/png");
            doc.addImage(imgData, "PNG", 10, 10, 190, 0);
            doc.save("Azzaro_Booking_Receipt.pdf");
        });
    }
  </script>
</body>
</html>
