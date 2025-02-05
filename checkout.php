<?php
session_start();
require_once 'admin/connection.php';
require_once 'vendor/autoload.php';

use Razorpay\Api\Api;

// ✅ Ensure POST data is received
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Error: Booking details not received. Please go back and try again.");
}

// ✅ Fetch Data from Form
$room_id = isset($_POST['room_id']) ? intval($_POST['room_id']) : 0;
$checkin = $_POST['checkin'] ?? null;
$checkout = $_POST['checkout'] ?? null;
$guests = $_POST['guests'] ?? 1;
$fullName = $_POST['fullName'] ?? null;
$email = $_POST['email'] ?? null;
$phone = $_POST['phone'] ?? null;

// ✅ Get User ID (if logged in) or Default to NULL for guest users
$user_id = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : NULL; 

// ✅ Validate Required Fields
if (!$room_id || !$checkin || !$checkout || !$fullName || !$email || !$phone) {
    die("Error: Missing required booking information.");
}

// ✅ Fetch Room Details
$stmt = $conn->prepare("SELECT room_name, price FROM rooms WHERE room_id = ?");
if (!$stmt) {
    die("DB Error: " . $conn->error);
}
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();
if (!$room) {
    die("Error: Invalid room selection.");
}

// ✅ Calculate Total Price
$checkin_date = new DateTime($checkin);
$checkout_date = new DateTime($checkout);
$nights = $checkin_date->diff($checkout_date)->days;
$total_price = $nights * $room['price'] * 100; // Convert to paise for Razorpay

// ✅ Insert Booking into Database
$insert_query = "INSERT INTO bookings (user_id, room_id, check_in, check_out, status, payment_status, payment_amount) 
                 VALUES (?, ?, ?, ?, 'Pending', 'Unpaid', ?)";

$stmt = $conn->prepare($insert_query);
$stmt->bind_param("iissd", $user_id, $room_id, $checkin, $checkout, $total_price);
$stmt->execute();
$booking_id = $stmt->insert_id;

if ($booking_id == 0) {
    die("Error: Booking ID not generated. Check MySQL AUTO_INCREMENT settings.");
}

// ✅ Store `booking_id` in session for `payment-success.php`
$_SESSION['booking_id'] = $booking_id;

// ✅ Initialize Razorpay API
$api = new Api("rzp_test_6WQEoVI2zNMjdN", "qPU3ksEX5ZAjTGGYPlxlZyQ6");

// ✅ Create Order for Razorpay
$orderData = [
    'receipt'         => "order_" . $booking_id,
    'amount'          => $total_price,
    'currency'        => 'INR',
    'payment_capture' => 1
];

try {
    $razorpayOrder = $api->order->create($orderData);
    $order_id = $razorpayOrder['id'];
} catch (Exception $e) {
    die("Razorpay Order Error: " . $e->getMessage());
}

// ✅ Store order_id in session for later reference
$_SESSION['order_id'] = $order_id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Checkout - Azzaro Resorts & Spa</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/new_img/azzaro_logo.jpg" alt="Azzaro Logo">
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
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h2 class="text-center mb-4">Confirm & Pay</h2>

            <div class="border p-3 rounded mb-4">
              <h5>Booking Details</h5>
              <p><strong>Check-In:</strong> <?= htmlspecialchars($checkin) ?><br>
                 <strong>Check-Out:</strong> <?= htmlspecialchars($checkout) ?><br>
                 <strong>Guests:</strong> <?= htmlspecialchars($guests) ?><br>
                 <strong>Room Type:</strong> <?= htmlspecialchars($room['room_name']) ?></p>
              <p><strong>Name:</strong> <?= htmlspecialchars($fullName) ?><br>
                 <strong>Email:</strong> <?= htmlspecialchars($email) ?><br>
                 <strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
              <h6>Total Cost: <span class="text-primary">₹ <?= number_format($total_price / 100, 2) ?></span></h6>
            </div>

            <!-- Razorpay Payment -->
            <div class="text-center">
              <p class="mb-3">Proceed to pay securely via Razorpay.</p>
              <button id="payBtn" class="btn btn-get-started">Pay with Razorpay</button>
            </div>

            <div class="mt-3 text-center">
              <a href="booking.php?id=<?= $booking_id ?>" class="btn btn-link">Edit Booking</a>
            </div>

          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- ✅ Razorpay Payment Script -->
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    var options = {
        "key": "rzp_test_6WQEoVI2zNMjdN",
        "amount": "<?= $total_price ?>",
        "currency": "INR",
        "name": "Azzaro Resort",
        "description": "Room Booking Payment",
        "image": "assets/new_img/azzaro_logo.jpg",
        "order_id": "<?= $order_id ?>",
        "handler": function (response) {
            window.location.href = "payment-success.php?payment_id=" + response.razorpay_payment_id + "&booking_id=<?= $booking_id ?>";
        },
        "prefill": {
            "name": "<?= htmlspecialchars($fullName) ?>",
            "email": "<?= htmlspecialchars($email) ?>",
            "contact": "<?= htmlspecialchars($phone) ?>"
        },
        "theme": {
            "color": "#1b7a78"
        }
    };

    document.getElementById('payBtn').onclick = function () {
        var rzp = new Razorpay(options);
        rzp.open();
    };
  </script>

  <!-- ✅ Fix Preloader Issue -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("preloader").style.display = "none";
    });
  </script>

  <footer id="footer" class="footer light-background">
    <div class="container">
      <p>© 2025 Azzaro Resorts & Spa. All Rights Reserved.</p>
    </div>
  </footer>

  <a href="#" class="scroll-top"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
