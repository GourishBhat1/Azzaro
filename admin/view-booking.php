<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Function to send confirmation email
function sendConfirmationEmail($email, $username, $booking_id, $check_in, $check_out, $room_name) {
    $subject = "Booking Confirmation - Azzaro Resorts & Spa";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: Azzaro Resorts <info@azzarodiu.com>" . "\r\n";

    $message = "
    <html>
    <head>
        <title>Booking Confirmation</title>
    </head>
    <body>
        <h2>Dear $username,</h2>
        <p>Your booking at <strong>Azzaro Resorts & Spa</strong> has been successfully <strong>confirmed</strong>.</p>
        <h3>Booking Details:</h3>
        <p><strong>Booking ID:</strong> $booking_id</p>
        <p><strong>Room:</strong> $room_name</p>
        <p><strong>Check-In:</strong> $check_in</p>
        <p><strong>Check-Out:</strong> $check_out</p>
        <p>We look forward to welcoming you! If you have any questions, please contact us at <a href='mailto:info@azzarodiu.com'>info@azzarodiu.com</a>.</p>
        <p>Best Regards,<br><strong>Azzaro Resorts & Spa</strong></p>
    </body>
    </html>";

    mail($email, $subject, $message, $headers);
}

// Function to send cancellation email
function sendCancellationEmail($email, $username, $booking_id, $check_in, $check_out, $room_name, $payment_status) {
    $subject = "Booking Cancellation - Azzaro Resorts & Spa";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: Azzaro Resorts <info@azzarodiu.com>" . "\r\n";

    $refund_text = ($payment_status == "Paid") 
        ? "<p>Your refund will be processed within 5-7 business days.</p>"
        : "<p>No payment was made, so no refund is required.</p>";

    $message = "
    <html>
    <head>
        <title>Booking Cancellation</title>
    </head>
    <body>
        <h2>Dear $username,</h2>
        <p>We regret to inform you that your booking at <strong>Azzaro Resorts & Spa</strong> has been <strong>cancelled</strong>.</p>
        <h3>Booking Details:</h3>
        <p><strong>Booking ID:</strong> $booking_id</p>
        <p><strong>Room:</strong> $room_name</p>
        <p><strong>Check-In:</strong> $check_in</p>
        <p><strong>Check-Out:</strong> $check_out</p>
        $refund_text
        <p>For any inquiries, please contact us at <a href='mailto:info@azzarodiu.com'>info@azzarodiu.com</a>.</p>
        <p>Best Regards,<br><strong>Azzaro Resorts & Spa</strong></p>
    </body>
    </html>";

    mail($email, $subject, $message, $headers);
}

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
    if (isset($_POST['confirm']) && $booking['status'] == 'Pending') {
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Confirmed' WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            sendConfirmationEmail($booking['email'], $booking['username'], $booking_id, $booking['check_in'], $booking['check_out'], $booking['room_name']);
            echo "<script>alert('Booking confirmed successfully and email sent'); window.location.href='view-booking.php?id=$booking_id';</script>";
        } else {
            echo "<script>alert('Error confirming booking');</script>";
        }
    }
    if (isset($_POST['cancel']) && $booking['status'] == 'Pending') {
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            sendCancellationEmail($booking['email'], $booking['username'], $booking_id, $booking['check_in'], $booking['check_out'], $booking['room_name'], $booking['payment_status']);
            echo "<script>alert('Booking cancelled successfully and email sent'); window.location.href='view-booking.php?id=$booking_id';</script>";
        } else {
            echo "<script>alert('Error cancelling booking');</script>";
        }
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
          <tr><th>Status:</th><td><span class="badge bg-<?= $booking['status'] == 'Confirmed' ? 'success' : ($booking['status'] == 'Cancelled' ? 'danger' : 'warning') ?>"><?= $booking['status'] ?></span></td></tr>
          <tr><th>Payment Status:</th><td><span class="badge bg-<?= $booking['payment_status'] == 'Paid' ? 'success' : 'danger' ?>"><?= $booking['payment_status'] ?></span></td></tr>
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
