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
    SELECT b.booking_id, r.room_name, b.check_in, b.check_out, b.status, p.razorpay_payment_id, b.payment_amount
    FROM bookings b
    JOIN rooms r ON b.room_id = r.room_id
    LEFT JOIN payments p ON b.booking_id = p.booking_id
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>

  <style>
    /* Dashboard Styling */
    .dashboard-container {
      max-width: 900px;
      margin: 50px auto;
      padding: 30px;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.12);
    }

    .dashboard-header {
      text-align: center;
      margin-bottom: 20px;
    }

    .dashboard-header h2 {
      font-weight: 700;
      color: #1b7a78;
      font-size: 28px;
    }

    /* Tab Styling */
    .nav-tabs {
      border-bottom: 2px solid #ddd;
    }

    .nav-tabs .nav-link {
      color: #1b7a78;
      font-weight: 600;
      border: none;
    }

    .nav-tabs .nav-link.active {
      color: white;
      background-color: #1b7a78;
      border-radius: 8px;
    }

    /* Booking Cards */
    .booking-card {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease-in-out;
    }

    .booking-card:hover {
      transform: translateY(-5px);
    }

    .booking-card h5 {
      font-size: 18px;
      font-weight: 700;
      color: #1b7a78;
    }

    .status-badge {
      font-size: 14px;
      font-weight: 600;
    }

    .status-confirmed {
      color: #28a745;
    }

    .status-pending {
      color: #ffc107;
    }

    .status-canceled {
      color: #dc3545;
    }

    .download-btn {
      background-color: #1b7a78;
      color: white;
      font-weight: 600;
      padding: 8px 15px;
      border-radius: 5px;
      display: block;
      text-align: center;
      margin-top: 10px;
      cursor: pointer;
      transition: background 0.3s ease-in-out;
    }

    .download-btn:hover {
      background-color: #154a4f;
    }

    /* Account Cards */
    .dashboard-card {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.08);
      text-align: center;
      transition: transform 0.3s ease-in-out;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
    }
  </style>
</head>
<body>

<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/new_img/azzaro_logo.png" alt="">
        <!-- <h1 class="sitename">Azzaro Resorts.</h1> -->
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

        <!-- Tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#bookings">Bookings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#account">Account</a>
          </li>
        </ul>

        <div class="tab-content mt-3">
          <!-- Bookings Tab -->
          <div class="tab-pane fade show active" id="bookings">
            <div class="row g-4">
              <?php while ($booking = $recent_bookings->fetch_assoc()): ?>
                <div class="col-md-6">
                  <div class="booking-card" id="booking-<?= $booking['booking_id'] ?>">
                    <h5><?= htmlspecialchars($booking['room_name']) ?></h5>
                    <p><strong>Check-in:</strong> <?= htmlspecialchars($booking['check_in']) ?></p>
                    <p><strong>Check-out:</strong> <?= htmlspecialchars($booking['check_out']) ?></p>
                    <p class="status-badge <?= $booking['status'] == 'Confirmed' ? 'status-confirmed' : ($booking['status'] == 'Pending' ? 'status-pending' : 'status-canceled') ?>">
                      <?= htmlspecialchars(ucfirst($booking['status'])) ?>
                    </p>
                    <button class="download-btn" onclick="downloadPDF(<?= $booking['booking_id'] ?>, '<?= $booking['room_name'] ?>', '<?= $booking['check_in'] ?>', '<?= $booking['check_out'] ?>', '<?= $booking['razorpay_payment_id'] ?>', '<?= $booking['payment_amount'] ?>')">
                      Download Receipt
                    </button>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>

          <!-- Account Tab -->
          <div class="tab-pane fade" id="account">
            <div class="dashboard-card">
              <h4>Account Information</h4>
              <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
              <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
              <a href="edit-profile.php" class="download-btn">Edit Profile</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script>
  AOS.init();
</script>

<script>
    function downloadPDF(bookingID, roomName, checkIn, checkOut, paymentID, paymentAmount) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Convert amount from stored paise to INR
    let formattedAmount = (parseFloat(paymentAmount) / 100).toLocaleString("en-IN", {
        style: "currency",
        currency: "INR"
    });

    // Ensure all values are converted to string
    bookingID = String(bookingID);
    roomName = String(roomName);
    checkIn = String(checkIn);
    checkOut = String(checkOut);
    paymentID = String(paymentID);
    formattedAmount = String(formattedAmount);

    // Set Font & Formatting
    doc.setFont("helvetica", "bold");
    doc.setFontSize(18);
    doc.text("Azzaro Resorts & Spa", 15, 20);

    doc.setFontSize(12);
    doc.setFont("helvetica", "normal");
    doc.text("------------------------------", 15, 25);
    doc.text("Booking Receipt", 15, 35);
    doc.text("------------------------------", 15, 40);

    doc.setFont("helvetica", "bold");
    doc.text("Booking ID:", 15, 50);
    doc.setFont("helvetica", "normal");
    doc.text(bookingID, 55, 50);

    doc.setFont("helvetica", "bold");
    doc.text("Room:", 15, 60);
    doc.setFont("helvetica", "normal");
    doc.text(roomName, 55, 60);

    doc.setFont("helvetica", "bold");
    doc.text("Check-In:", 15, 70);
    doc.setFont("helvetica", "normal");
    doc.text(checkIn, 55, 70);

    doc.setFont("helvetica", "bold");
    doc.text("Check-Out:", 15, 80);
    doc.setFont("helvetica", "normal");
    doc.text(checkOut, 55, 80);

    doc.setFont("helvetica", "bold");
    doc.text("Payment ID:", 15, 90);
    doc.setFont("helvetica", "normal");
    doc.text(paymentID, 55, 90);

    doc.setFont("helvetica", "bold");
    doc.text("Amount Paid:", 15, 100);
    doc.setFont("helvetica", "bold");
    doc.setTextColor(0, 128, 0); // Green color for amount
    doc.text(formattedAmount, 55, 100);

    doc.setTextColor(0, 0, 0); // Reset to black
    doc.setFontSize(12);
    doc.setFont("helvetica", "normal");
    doc.text("------------------------------", 15, 110);
    doc.text("Thank you for booking with us!", 15, 120);

    // Save the PDF
    doc.save(`Azzaro_Booking_Receipt_${bookingID}.pdf`);
}

</script>


</body>
</html>
