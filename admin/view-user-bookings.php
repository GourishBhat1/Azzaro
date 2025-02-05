<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Validate & Get User ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid user ID.");
}
$user_id = intval($_GET['id']);

// Fetch user details
$user_stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();

// Fetch user bookings
$booking_stmt = $conn->prepare("
    SELECT b.booking_id, r.room_name, b.check_in, b.check_out, b.status, b.payment_status
    FROM bookings b
    JOIN rooms r ON b.room_id = r.room_id
    WHERE b.user_id = ?
    ORDER BY b.created_at DESC
");
$booking_stmt->bind_param("i", $user_id);
$booking_stmt->execute();
$bookings = $booking_stmt->get_result();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Bookings for <?= htmlspecialchars($user['username']) ?></h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="user-management.php">Customers</a></li>
        <li class="breadcrumb-item active">View Bookings</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Customer Information</h5>
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Bookings</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Booking ID</th><th>Room</th><th>Check-in</th><th>Check-out</th><th>Status</th><th>Payment</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($booking = $bookings->fetch_assoc()): ?>
            <tr>
              <td><?= $booking['booking_id'] ?></td>
              <td><?= htmlspecialchars($booking['room_name']) ?></td>
              <td><?= $booking['check_in'] ?></td>
              <td><?= $booking['check_out'] ?></td>
              <td>
                <span class="badge <?= ($booking['status'] === 'Confirmed') ? 'bg-success' : (($booking['status'] === 'Pending') ? 'bg-warning' : 'bg-danger') ?>">
                  <?= $booking['status'] ?>
                </span>
              </td>
              <td>
                <span class="badge <?= ($booking['payment_status'] === 'Paid') ? 'bg-success' : 'bg-danger' ?>">
                  <?= $booking['payment_status'] ?>
                </span>
              </td>
              <td>
                <a href="booking-details.php?id=<?= $booking['booking_id'] ?>" class="btn btn-sm btn-primary">View</a>
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
