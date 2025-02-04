<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

if (!isset($_GET['id'])) {
    header("Location: bookings.php");
    exit();
}

$booking_id = intval($_GET['id']);
$stmt = $conn->prepare("
    SELECT b.*, u.username, u.email, r.room_name, p.razorpay_payment_id 
    FROM bookings b
    JOIN users u ON b.user_id = u.user_id
    JOIN rooms r ON b.room_id = r.room_id
    LEFT JOIN payments p ON b.booking_id = p.booking_id
    WHERE b.booking_id = ?
");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$booking = $stmt->get_result()->fetch_assoc();

// Handle Booking Actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['confirm'])) {
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Confirmed' WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        header("Location: view-booking.php?id=$booking_id");
        exit();
    }
    if (isset($_POST['cancel'])) {
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        header("Location: view-booking.php?id=$booking_id");
        exit();
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Booking Details</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="bookings.php">Bookings</a></li>
        <li class="breadcrumb-item active">Booking #<?= $booking['booking_id'] ?></li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Booking #<?= $booking['booking_id'] ?></h5>

        <table class="table">
          <tr><th>Customer:</th><td><?= htmlspecialchars($booking['username']) ?> (<?= htmlspecialchars($booking['email']) ?>)</td></tr>
          <tr><th>Room:</th><td><?= htmlspecialchars($booking['room_name']) ?></td></tr>
          <tr><th>Check-in:</th><td><?= $booking['check_in'] ?></td></tr>
          <tr><th>Check-out:</th><td><?= $booking['check_out'] ?></td></tr>
          <tr><th>Status:</th>
              <td>
                <?php if ($booking['status'] == 'Confirmed') : ?>
                  <span class="badge bg-success">Confirmed</span>
                <?php elseif ($booking['status'] == 'Cancelled') : ?>
                  <span class="badge bg-danger">Cancelled</span>
                <?php else : ?>
                  <span class="badge bg-warning">Pending</span>
                <?php endif; ?>
              </td>
          </tr>
          <tr><th>Payment Status:</th>
              <td>
                <?php if ($booking['payment_status'] == 'Paid') : ?>
                  <span class="badge bg-success">Paid</span>
                <?php else : ?>
                  <span class="badge bg-danger">Unpaid</span>
                <?php endif; ?>
              </td>
          </tr>
          <tr><th>Razorpay Payment ID:</th><td><?= $booking['razorpay_payment_id'] ?? 'N/A' ?></td></tr>
        </table>

        <form method="POST" class="mt-3">
          <?php if ($booking['status'] == 'Pending') : ?>
            <button type="submit" name="confirm" class="btn btn-success">Mark as Confirmed</button>
            <button type="submit" name="cancel" class="btn btn-danger">Cancel Booking</button>
          <?php endif; ?>
          <a href="bookings.php" class="btn btn-secondary">Back</a>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
