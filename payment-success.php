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

// ✅ Fetch Booking Details with GST Rate
$stmt = $conn->prepare("
    SELECT b.*, u.email, r.room_name, r.price, r.gst_rate 
    FROM bookings b
    JOIN users u ON b.user_id = u.user_id
    JOIN rooms r ON b.room_id = r.room_id
    WHERE b.booking_id = ?
");
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

// ✅ Calculate Base Price and GST
$base_price = ($total_amount_inr * 100) / (100 + $booking['gst_rate']); // Reverse calculation
$gst_amount = $total_amount_inr - $base_price;

// ✅ Update Payment Status in `bookings`
$update_payment = "UPDATE bookings SET payment_status = 'Paid' WHERE booking_id = ?";
$stmt = $conn->prepare($update_payment);
$stmt->bind_param("i", $booking_id);
$stmt->execute();

// ✅ Insert Payment Record
$insert_payment = "INSERT INTO payments (booking_id, amount, razorpay_payment_id, status, payment_date) 
                   VALUES (?, ?, ?, 'Success', NOW())";
$stmt = $conn->prepare($insert_payment);
$stmt->bind_param("ids", $booking_id, $total_amount_inr, $payment_id);
$stmt->execute();

// ✅ Generate Unique Verification Code for Admin
$verification_code = md5($booking_id . $booking['check_in'] . $booking['check_out'] . $payment_id);

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
          <li><a href="index.php">Home</a></li>
          <li><a href="rooms.php">Stays</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="contact.php">Contact</a></li>

          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="dashboard.php">Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php else: ?>
            <li><a href="login.php">Login</a></li>
          <?php endif; ?>
        </ul>
        
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main py-5">
    <div class="container text-center">
      <div class="border p-3 rounded mt-4" id="booking-details">
        <img src="assets/new_img/azzaro_logo.jpg" width="150" class="mb-3" alt="Azzaro Resort Logo">
        <h2 class="text-success mb-3">Payment Successful!</h2>
        <p class="lead">Thank you for your payment. Your booking request has been received.</p>
        
        <h5>Booking Details</h5>
        <p><strong>Booking ID:</strong> <?= htmlspecialchars($booking_id) ?></p>
        <p><strong>Room:</strong> <?= htmlspecialchars($booking['room_name']) ?></p>
        <p><strong>Check-In:</strong> <?= htmlspecialchars($booking['check_in']) ?></p>
        <p><strong>Check-Out:</strong> <?= htmlspecialchars($booking['check_out']) ?></p>
        <h6>Base Price: ₹ <?= number_format($base_price, 2) ?></h6>
        <h6>GST (<?= $booking['gst_rate'] ?>%): ₹ <?= number_format($gst_amount, 2) ?></h6>
        <h5>Total Paid: <span class="text-primary">₹ <?= number_format($total_amount_inr, 2) ?></span></h5>
        <p><strong>Payment ID:</strong> <?= htmlspecialchars($payment_id) ?></p>
        <p>Your booking confirmation email will be sent shortly.</p>
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
    const doc = new jsPDF('p', 'mm', 'a4'); // Standard A4 PDF

    let element = document.querySelector("#booking-details"); // Target the entire receipt section

    // ✅ Use html2canvas with higher scale for better clarity
    html2canvas(element, { scale: 3, useCORS: true }).then(canvas => {
        let imgData = canvas.toDataURL("image/png");
        let imgWidth = 190; // Scale image width to fit within A4
        let imgHeight = (canvas.height * imgWidth) / canvas.width; // Maintain aspect ratio

        doc.addImage(imgData, "PNG", 10, 10, imgWidth, imgHeight); // Add image to PDF
        doc.save("Azzaro_Booking_Receipt.pdf"); // Download PDF
    }).catch(error => {
        console.error("PDF Generation Error:", error);
        alert("Error generating PDF. Please try again.");
    });
}

</script>

</body>
</html>
