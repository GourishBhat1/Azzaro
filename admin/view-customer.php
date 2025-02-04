<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Validate & Get User ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid user ID.");
}
$user_id = intval($_GET['id']);

// Fetch customer details
$user_stmt = $conn->prepare("SELECT username, email, created_at FROM users WHERE user_id = ? AND role = 'customer'");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();

// If user not found
if (!$user) {
    die("Customer not found.");
}

// Fetch total bookings
$booking_stmt = $conn->prepare("SELECT COUNT(*) AS total_bookings FROM bookings WHERE user_id = ?");
$booking_stmt->bind_param("i", $user_id);
$booking_stmt->execute();
$booking_result = $booking_stmt->get_result();
$total_bookings = $booking_result->fetch_assoc()['total_bookings'];

// Fetch last booking date
$last_booking_stmt = $conn->prepare("SELECT MAX(created_at) AS last_booking FROM bookings WHERE user_id = ?");
$last_booking_stmt->bind_param("i", $user_id);
$last_booking_stmt->execute();
$last_booking_result = $last_booking_stmt->get_result();
$last_booking = $last_booking_result->fetch_assoc()['last_booking'] ?? 'No Bookings Yet';
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Customer Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="user-management.php">Customers</a></li>
        <li class="breadcrumb-item active">Customer Profile</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Customer Information</h5>
        <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        <p><strong>Registered On:</strong> <?= $user['created_at'] ?></p>
        <p><strong>Total Bookings:</strong> <?= $total_bookings ?></p>
        <p><strong>Last Booking Date:</strong> <?= $last_booking ?></p>
        
        <div class="mt-4">
          <a href="view-user-bookings.php?id=<?= $user_id ?>" class="btn btn-primary">View Bookings</a>
          <a href="edit-customer.php?id=<?= $user_id ?>" class="btn btn-warning">Edit</a>
          <a href="delete-customer.php?id=<?= $user_id ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</a>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
