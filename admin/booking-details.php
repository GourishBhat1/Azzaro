<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Validate & Get Booking ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid booking ID.");
}
$booking_id = intval($_GET['id']);

// Fetch booking details
$booking_stmt = $conn->prepare("
    SELECT b.booking_id, u.username, u.email, r.room_name, b.check_in, b.check_out, b.status, 
           b.payment_status, b.payment_amount, b.created_at, b.updated_at
    FROM bookings b
    JOIN rooms r ON b.room_id = r.room_id
    LEFT JOIN users u ON b.user_id = u.user_id
    WHERE b.booking_id = ?
");
$booking_stmt->bind_param("i", $booking_id);
$booking_stmt->execute();
$booking_result = $booking_stmt->get_result();
$booking = $booking_result->fetch_assoc();

if (!$booking) {
    die("Booking not found.");
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Booking Details</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="user-management.php">Customers</a></li>
        <li class="breadcrumb-item"><a href="view-user-bookings.php?id=<?= $booking['user_id'] ?>">Bookings</a></li>
        <li class="breadcrumb-item active">Booking #<?= $booking['booking_id'] ?></li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Customer Information</h5>
        <p><strong>Username:</strong> <?= htmlspecialchars($booking['username'] ?? 'Guest') ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($booking['email'] ?? 'N/A') ?></p>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Booking Information</h5>
        <p><strong>Booking ID:</strong> <?= $booking['booking_id'] ?></p>
        <p><strong>Room:</strong> <?= htmlspecialchars($booking['room_name']) ?></p>
        <p><strong>Check-in:</strong> <?= $booking['check_in'] ?></p>
        <p><strong>Check-out:</strong> <?= $booking['check_out'] ?></p>
        <p><strong>Status:</strong> 
          <span class="badge <?= ($booking['status'] === 'Confirmed') ? 'bg-success' : (($booking['status'] === 'Pending') ? 'bg-warning' : 'bg-danger') ?>">
            <?= $booking['status'] ?>
          </span>
        </p>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Payment Details</h5>
        <p><strong>Payment Status:</strong> 
          <span class="badge <?= ($booking['payment_status'] === 'Paid') ? 'bg-success' : 'bg-danger' ?>">
            <?= $booking['payment_status'] ?>
          </span>
        </p>
        <p><strong>Amount Paid:</strong> Rs. <?= number_format($booking['payment_amount'] / 100, 2) ?></p>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
