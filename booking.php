<?php
session_start();
require_once 'admin/connection.php';

// ✅ Validate Room ID
$room_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ✅ Fetch room details
$stmt = $conn->prepare("SELECT room_id, room_name, price, occupancy, inventory FROM rooms WHERE room_id = ?");
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();

// ✅ Redirect if room not found
if (!$room) {
    header("Location: rooms.php");
    exit();
}

// ✅ Fetch booked dates for this room (Confirmed & Paid)
$booked_dates_query = "
    SELECT check_in, check_out FROM bookings 
    WHERE room_id = ? AND status = 'Confirmed' AND payment_status = 'Paid'
";
$stmt = $conn->prepare($booked_dates_query);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

// ✅ Store booked dates in an array
$booked_dates = [];
while ($row = $result->fetch_assoc()) {
    $start = new DateTime($row['check_in']);
    $end = new DateTime($row['check_out']);
    while ($start <= $end) {
        $booked_dates[] = $start->format('Y-m-d');
        $start->modify('+1 day');
    }
}
$booked_dates_json = json_encode($booked_dates);

// ✅ Fetch user details if logged in
$user_fullname = $user_email = $user_phone = "";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT full_name, email, phone FROM users WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        
        if ($user) {
            $user_fullname = htmlspecialchars($user['full_name']);
            $user_email = htmlspecialchars($user['email']);
            $user_phone = htmlspecialchars($user['phone']);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Book <?= htmlspecialchars($room['room_name']) ?> - Azzaro Resorts & Spa</title>

  <!-- ✅ Favicons & Vendor CSS -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- ✅ jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <style>
    /* ✅ Style for Datepickers */
    .datepicker {
        cursor: pointer;
        background-color: #fff;
    }
  </style>
</head>

<body>

<!-- ✅ Header -->
<header id="header" class="header d-flex align-items-center sticky-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo d-flex align-items-center">
      <img src="assets/new_img/azzaro_logo.png" alt="Azzaro Logo">
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
    </nav>
  </div>
</header>

<!-- ✅ Booking Section -->
<main class="main">
  <section class="section pt-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h2 class="text-center mb-4">Book Your Stay</h2>

          <!-- ✅ Booking Form -->
          <form action="checkout.php" method="POST" id="bookingForm">
            <input type="hidden" name="room_id" value="<?= $room['room_id'] ?>">

            <!-- Dates -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="checkinDate" class="form-label">Check-In Date</label>
                <input type="text" class="form-control datepicker" id="checkinDate" name="checkin" required autocomplete="off">
              </div>
              <div class="col-md-6">
                <label for="checkoutDate" class="form-label">Check-Out Date</label>
                <input type="text" class="form-control datepicker" id="checkoutDate" name="checkout" required autocomplete="off">
              </div>
            </div>

            <!-- Guests -->
            <div class="mb-3">
              <label for="guests" class="form-label">Number of Guests</label>
              <select class="form-select" id="guests" name="guests" required>
                <?php for ($i = 1; $i <= $room['occupancy']; $i++): ?>
                  <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
              </select>
            </div>

            <!-- Personal Info -->
            <div class="mb-3">
              <label for="fullName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullName" name="fullName" value="<?= $user_fullname ?>" required>
            </div>
            <div class="mb-3">
              <label for="emailAddress" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="emailAddress" name="email" value="<?= $user_email ?>" required>
            </div>
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phoneNumber" name="phone" value="<?= $user_phone ?>" required>
            </div>

            <!-- ✅ Availability Message -->
            <div id="availabilityMessage" class="alert d-none"></div>

            <div class="text-center mt-4">
              <button type="submit" class="btn btn-outline-primary">Proceed to Checkout</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- ✅ jQuery, jQuery UI & JavaScript -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function () {
    const bookedDates = <?= $booked_dates_json ?>;
    let availableRooms = <?= $room['inventory'] ?> - bookedDates.length;

    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        beforeShowDay: function(date) {
            let formattedDate = $.datepicker.formatDate("yy-mm-dd", date);
            return [bookedDates.indexOf(formattedDate) === -1];
        }
    });

    $("#bookingForm").on("submit", function (e) {
        if (availableRooms <= 0) {
            e.preventDefault();
            $("#availabilityMessage").removeClass("d-none").addClass("alert-danger").text("No rooms available for the selected dates.");
        }
    });
});
</script>

</body>
</html>
