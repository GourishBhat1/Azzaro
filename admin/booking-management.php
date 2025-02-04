<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Handle Booking Confirmation
if (isset($_GET['confirm'])) {
    $booking_id = intval($_GET['confirm']);
    $stmt = $conn->prepare("UPDATE bookings SET status = 'Confirmed' WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        echo "<script>alert('Booking confirmed successfully'); window.location.href='bookings.php';</script>";
    } else {
        echo "<script>alert('Error confirming booking');</script>";
    }
}

// Handle Booking Cancellation
if (isset($_GET['cancel'])) {
    $booking_id = intval($_GET['cancel']);
    $stmt = $conn->prepare("UPDATE bookings SET status = 'Cancelled' WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        echo "<script>alert('Booking cancelled successfully'); window.location.href='bookings.php';</script>";
    } else {
        echo "<script>alert('Error cancelling booking');</script>";
    }
}

// Fetch All Bookings with Users & Room Data
$query = "
    SELECT b.booking_id, u.username, r.room_name, b.check_in, b.check_out, b.status, b.payment_status
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
