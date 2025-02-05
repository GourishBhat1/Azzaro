<?php
session_start();
require_once 'admin/connection.php';

// Get the room ID from URL parameter
$room_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch room details
$room_query = "SELECT room_id, room_name, price, occupancy FROM rooms WHERE room_id = ?";
$stmt = $conn->prepare($room_query);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();

// Redirect if room not found
if (!$room) {
    header("Location: rooms.php");
    exit();
}

// Fetch booked dates for this room (only confirmed & paid bookings)
$booked_dates_query = "SELECT check_in, check_out FROM bookings WHERE room_id = ? AND status = 'Confirmed' AND payment_status = 'Paid'";
$stmt = $conn->prepare($booked_dates_query);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

// Store booked dates in an array
$booked_dates = [];
while ($row = $result->fetch_assoc()) {
    $start = new DateTime($row['check_in']);
    $end = new DateTime($row['check_out']);
    while ($start <= $end) {
        $booked_dates[] = $start->format('Y-m-d');
        $start->modify('+1 day');
    }
}

// Encode booked dates to JSON for JavaScript
$booked_dates_json = json_encode($booked_dates);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Book <?= htmlspecialchars($room['room_name']) ?> - Azzaro Resorts & Spa</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts & Vendor CSS -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
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
  <!-- End Header -->

  <main class="main">
    <section class="section pt-5">
      <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h2 class="text-center mb-4">Book Your Stay</h2>

            <!-- Booking Form -->
            <form action="checkout.php" method="POST">
              <input type="hidden" name="room_id" value="<?= $room['room_id'] ?>">

              <!-- Dates -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="checkinDate" class="form-label">Check-In Date</label>
                  <input type="date" class="form-control" id="checkinDate" name="checkin" required>
                </div>
                <div class="col-md-6">
                  <label for="checkoutDate" class="form-label">Check-Out Date</label>
                  <input type="date" class="form-control" id="checkoutDate" name="checkout" required>
                </div>
              </div>

              <!-- Guests & Room Type -->
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="guests" class="form-label">Number of Guests</label>
                  <input type="number" class="form-control" id="guests" name="guests" min="1" max="<?= $room['occupancy'] ?>" required>
                </div>
                <div class="col-md-6">
                  <label for="roomType" class="form-label">Room Type</label>
                  <input type="text" class="form-control" id="roomType" name="roomType" value="<?= htmlspecialchars($room['room_name']) ?>" readonly>
                </div>
              </div>

              <!-- Personal Info -->
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
              </div>
              <div class="mb-3">
                <label for="emailAddress" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="emailAddress" name="email" required>
              </div>
              <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phone" required>
              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn btn-get-started">Proceed to Checkout</button>
              </div>
            </form>
            <!-- /Booking Form -->
          </div>
        </div>
      </div>
    </section>
</main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer light-background">
    <div class="container">
      <p>© 2025 Azzaro Resorts & Spa. All Rights Reserved.</p>
    </div>
  </footer>
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
document.addEventListener("DOMContentLoaded", function () {
    const bookedDates = <?= $booked_dates_json ?>;  // Load booked dates from PHP

    function disableBookedDates(inputField) {
        inputField.addEventListener("input", function () {
            if (bookedDates.includes(this.value)) {
                alert("This date is already booked. Please select a different date.");
                this.value = ""; // Clear selected date
            }
        });
    }

    disableBookedDates(document.getElementById("checkinDate"));
    disableBookedDates(document.getElementById("checkoutDate"));

    // Ensure check-out date is after check-in date
    document.getElementById("checkinDate").addEventListener("change", function () {
        let checkin = new Date(this.value);
        let checkout = document.getElementById("checkoutDate").value ? new Date(document.getElementById("checkoutDate").value) : null;
        if (checkout && checkin >= checkout) {
            alert("Check-out date must be after check-in date.");
            document.getElementById("checkoutDate").value = "";
        }
    });

    document.getElementById("checkoutDate").addEventListener("change", function () {
        let checkin = new Date(document.getElementById("checkinDate").value);
        let checkout = new Date(this.value);
        if (checkin >= checkout) {
            alert("Check-out date must be after check-in date.");
            this.value = "";
        }
    });
});
</script>
</body>
</html>