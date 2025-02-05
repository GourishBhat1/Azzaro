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
        <p>We are pleased to inform you that your booking at Azzaro Resorts & Spa has been <strong>confirmed</strong>.</p>
        <h3>Booking Details:</h3>
        <p><strong>Booking ID:</strong> $booking_id</p>
        <p><strong>Room:</strong> $room_name</p>
        <p><strong>Check-In:</strong> $check_in</p>
        <p><strong>Check-Out:</strong> $check_out</p>
        <p>We look forward to hosting you! If you have any queries, feel free to reach out to us at <a href='mailto:info@azzarodiu.com'>info@azzarodiu.com</a>.</p>
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
        <p>We regret to inform you that your booking at Azzaro Resorts & Spa has been <strong>cancelled</strong>.</p>
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

// Handle Booking Confirmation
if (isset($_GET['confirm'])) {
    $booking_id = intval($_GET['confirm']);

    // Fetch customer details for the booking
    $stmt = $conn->prepare("SELECT u.email, u.username, r.room_name, b.check_in, b.check_out FROM bookings b
                            JOIN users u ON b.user_id = u.user_id
                            JOIN rooms r ON b.room_id = r.room_id
                            WHERE b.booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        // Update booking status
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Confirmed' WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            // Send confirmation email
            sendConfirmationEmail($booking['email'], $booking['username'], $booking_id, $booking['check_in'], $booking['check_out'], $booking['room_name']);
            echo "<script>alert('Booking confirmed successfully and email sent'); window.location.href='bookings.php';</script>";
        } else {
            echo "<script>alert('Error confirming booking');</script>";
        }
    } else {
        echo "<script>alert('Booking not found');</script>";
    }
}

// Handle Booking Cancellation
if (isset($_GET['cancel'])) {
    $booking_id = intval($_GET['cancel']);

    // Fetch customer details for the booking
    $stmt = $conn->prepare("SELECT u.email, u.username, r.room_name, b.check_in, b.check_out, b.payment_status FROM bookings b
                            JOIN users u ON b.user_id = u.user_id
                            JOIN rooms r ON b.room_id = r.room_id
                            WHERE b.booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        // Update booking status
        $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            // Send cancellation email
            sendCancellationEmail($booking['email'], $booking['username'], $booking_id, $booking['check_in'], $booking['check_out'], $booking['room_name'], $booking['payment_status']);
            echo "<script>alert('Booking cancelled successfully and email sent'); window.location.href='bookings.php';</script>";
        } else {
            echo "<script>alert('Error cancelling booking');</script>";
        }
    } else {
        echo "<script>alert('Booking not found');</script>";
    }
}

// Fetch All Bookings with Users & Room Data
$query = "
    SELECT b.booking_id, u.username, u.email, r.room_name, b.check_in, b.check_out, b.status, b.payment_status
    FROM bookings b
    JOIN users u ON b.user_id = u.user_id
    JOIN rooms r ON b.room_id = r.room_id
    ORDER BY b.created_at DESC";
$bookings = $conn->query($query);
?>


<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manage Bookings</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Bookings</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Bookings</h5>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Customer</th>
              <th>Room</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Status</th>
              <th>Payment</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($booking = $bookings->fetch_assoc()) : ?>
            <tr>
              <td><?= $booking['booking_id'] ?></td>
              <td><?= htmlspecialchars($booking['username']) ?></td>
              <td><?= htmlspecialchars($booking['room_name']) ?></td>
              <td><?= $booking['check_in'] ?></td>
              <td><?= $booking['check_out'] ?></td>
              <td>
                <?php if ($booking['status'] == 'Confirmed') : ?>
                  <span class="badge bg-success">Confirmed</span>
                <?php elseif ($booking['status'] == 'Cancelled') : ?>
                  <span class="badge bg-danger">Cancelled</span>
                <?php else : ?>
                  <span class="badge bg-warning">Pending</span>
                <?php endif; ?>
              </td>
              <td>
                <?php if ($booking['payment_status'] == 'Paid') : ?>
                  <span class="badge bg-success">Paid</span>
                <?php else : ?>
                  <span class="badge bg-danger">Unpaid</span>
                <?php endif; ?>
              </td>
              <td>
                <a href="view-booking.php?id=<?= $booking['booking_id'] ?>" class="btn btn-sm btn-primary">View</a>
                <?php if ($booking['status'] == 'Pending') : ?>
                  <a href="?confirm=<?= $booking['booking_id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Confirm this booking?')">Confirm</a>
                  <a href="?cancel=<?= $booking['booking_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Cancel this booking?')">Cancel</a>
                <?php endif; ?>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
