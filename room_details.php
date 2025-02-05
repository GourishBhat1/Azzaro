<?php
session_start();
require_once 'admin/connection.php';

// Get the room ID from URL parameter
$room_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch room details from database
$room_query = "SELECT r.*, c.category_name FROM rooms r 
               JOIN room_categories c ON r.category_id = c.category_id 
               WHERE r.room_id = ?";
$stmt = $conn->prepare($room_query);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();

// Redirect to rooms page if room is not found
if (!$room) {
    header("Location: rooms.php");
    exit();
}

// Fetch room images from JSON format
$image_list = json_decode($room['images'], true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Room Details - Azzaro Resorts & Spa</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

</head>

<body class="portfolio-details-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/new_img/azzaro_logo.jpg" alt="">
        <!-- <h1 class="sitename">Azzaro Resorts.</h1> -->
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

<!-- Page Title -->
<div class="page-title light-background">
  <div class="container">
    <h1>Room Details</h1>
    <nav class="breadcrumbs">
      <ol>
        <li><a href="index.php">Home</a></li>
        <li><a href="rooms.php">Rooms</a></li>
        <li class="current"><?= htmlspecialchars($room['room_name']) ?></li>
      </ol>
    </nav>
  </div>
</div><!-- End Page Title -->

<!-- Room Details Section -->
<section id="room-details" class="room-details section">
  <div class="container" data-aos="fade-up">

    <!-- Room Image Slider -->
    <div class="room-details-slider swiper init-swiper">
      <script type="application/json" class="swiper-config">
        {
          "loop": true,
          "speed": 600,
          "autoplay": { "delay": 5000 },
          "slidesPerView": 1,
          "navigation": { "nextEl": ".swiper-button-next", "prevEl": ".swiper-button-prev" },
          "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true }
        }
      </script>
      <div class="swiper-wrapper align-items-center">
        <?php
        if (!empty($image_list)) :
          foreach ($image_list as $image) :
            // Ensure correct image path from 'admin/uploads/rooms/'
            $image_path = 'admin/' . ltrim($image, '/');
        ?>
          <div class="swiper-slide">
            <img src="<?= htmlspecialchars($image_path) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($room['room_name']) ?>">
          </div>
        <?php endforeach; 
        else: ?>
          <div class="swiper-slide">
            <img src="assets/img/default-room.jpg" class="img-fluid rounded" alt="Default Room Image">
          </div>
        <?php endif; ?>
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-pagination"></div>
    </div>

    <div class="row justify-content-between gy-4 mt-4">

      <!-- Room Description -->
      <div class="col-lg-8" data-aos="fade-up">
        <div class="room-description">
          <h2><?= htmlspecialchars($room['room_name']) ?></h2>
          <p><?= nl2br(htmlspecialchars($room['description'])) ?></p>
        </div>
      </div>

      <!-- Room Info and Booking -->
      <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="room-info">
          <h3>Room Information</h3>
          <ul>
            <li><strong>Room Type:</strong> <?= htmlspecialchars($room['category_name']) ?></li>
            <li><strong>Price:</strong> ₹<?= number_format($room['price'], 2) ?> / Night</li>
            <li><strong>Max Occupancy:</strong> <?= $room['occupancy'] ?> Adults</li>
            <li><strong>Available:</strong> <?= ($room['occupancy'] > 0) ? "Yes" : "No" ?></li>
          </ul>
          <a href="booking.php?id=<?= $room['room_id'] ?>" class="btn btn-success btn-lg mt-3 w-100">Book Now</a>
        </div>
      </div>

    </div>

  </div>
</section><!-- /Room Details Section -->
</main>

  <footer id="footer" class="footer light-background">
    <div class="container">
      <div class="row g-4">
        
        <!-- About Us -->
        <div class="col-md-6 col-lg-3 mb-3 mb-md-0">
          <div class="widget">
            <h3 class="widget-heading">About Us</h3>
            <p class="mb-4">
              Escape into luxury at our resort, where relaxation meets nature's finest. Experience unparalleled hospitality and stunning views.
            </p>
          </div>
        </div>
  
        <!-- Navigation Links -->
<div class="col-md-6 col-lg-3 ps-lg-5 mb-3 mb-md-0">
  <div class="widget">
    <h3 class="widget-heading">Navigation</h3>
    <ul class="list-unstyled float-start me-5">
      <li><a href="index.php">Home</a></li>
      <li><a href="rooms.php">Stays</a></li>
      <li><a href="gallery.php">Gallery</a></li>
    </ul>
    <ul class="list-unstyled float-start">
      <li><a href="contact.php">Contact</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="dashboard.php">Bookings</a></li>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </div>
</div>

  
        <!-- Blog Links -->
        <div class="col-md-6 col-lg-3 pl-lg-5">
          <div class="widget">
            <h3 class="widget-heading">Latest Blogs</h3>
            <ul class="list-unstyled footer-blog-entry">
              <li>
                <a href="https://www.youtube.com/watch?v=Q2gx0cWkpRA&ab_channel=VisitDiu" target="_blank">Visit Diu - A Visual Journey</a>
              </li>
              <li>
                <a href="https://www.mysoultravels.com/india/gujarat/diu-trip/" target="_blank">A Complete Travel Guide to Diu</a>
              </li>
              <li>
                <a href="https://www.diextr.com/diu-the-land-of-surprises/" target="_blank">Diu - The Land of Surprises</a>
              </li>
              <li>
                <a href="https://www.makemytrip.com/tripideas/blog/my-escape-to-diu" target="_blank">My Escape to Diu</a>
              </li>
              <li>
                <a href="https://medium.com/@geethavj176/travel-blog-2024-diu-gir-somnath-d038258690a1" target="_blank">Diu, Gir & Somnath - A Travel Story</a>
              </li>
            </ul>
          </div>
        </div>
  
        <!-- Social Media Links -->
        <div class="col-md-6 col-lg-3 pl-lg-5">
          <div class="widget">
            <h3 class="widget-heading">Connect</h3>
            <ul class="list-unstyled social-icons light mb-3">
              <li><a href="https://www.facebook.com/azzaroresorts/" target="_blank"><span class="bi bi-facebook"></span></a></li>
              <li><a href="https://www.instagram.com/azzaroresorts/" target="_blank"><span class="bi bi-instagram"></span></a></li>
            </ul>
          </div>
        </div>
  
      </div>
  
      <div class="copyright d-flex flex-column flex-md-row align-items-center justify-content-md-between">
        <p>© <span>Copyright</span> <strong class="px-1 sitename">Azzaro Resorts & Spas.</strong> <span>All Rights Reserved.</span></p>
        <div class="credits">
          Made by <strong>Gyrono Tech</strong>
        </div>
      </div>
    </div>
  </footer>


<!-- Floating Contact Button -->
<div class="floating-contact">
  <div class="floating-toggle" onclick="toggleContactMenu()">
    <i class="bi bi-chat-dots"></i> <!-- Main Icon -->
  </div>

  <!-- Hidden Contact Options -->
  <div class="contact-options">
    <!-- WhatsApp -->
    <a href="https://wa.me/+917201000746?text=Hello!%20I%20would%20like%20to%20know%20more%20about%20Azzaro%20Resorts."
       target="_blank"
       class="contact-item whatsapp">
      <i class="bi bi-whatsapp"></i> Chat
    </a>

    <!-- Call -->
    <a href="tel:+917201000746" class="contact-item call">
      <i class="bi bi-telephone"></i> Call
    </a>
  </div>
</div>

<!-- CSS for Floating Button -->
<style>
  /* Floating Button Container */
  .floating-contact {
    position: fixed;
    bottom: 80px; /* Increased from 15px to avoid clash */
    right: 15px;
    z-index: 1000;
  }

  /* Main Toggle Button */
  .floating-toggle {
    width: 55px;
    height: 55px;
    background-color: #1b7a78;
    color: #ffffff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, transform 0.3s;
  }

  .floating-toggle:hover {
    background-color: #154a4f;
    transform: scale(1.1);
  }

  /* Contact Options (Initially Hidden) */
  .contact-options {
    position: absolute;
    bottom: 70px;
    right: 5px;
    display: none;
    flex-direction: column;
    gap: 10px;
  }

  /* Individual Contact Item */
  .contact-item {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    background-color: #ffffff;
    color: #212529;
    padding: 10px 15px;
    border-radius: 30px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    font-weight: 600;
    transition: all 0.3s;
  }

  .contact-item:hover {
    transform: scale(1.05);
  }

  /* WhatsApp Style */
  .whatsapp {
    background-color: #25D366;
    color: white;
  }

  /* Call Button Style */
  .call {
    background-color: #1b7a78;
    color: white;
  }

  /* Icon Styling */
  .contact-item i {
    font-size: 20px;
  }
</style>

<!-- JavaScript to Toggle Contact Options -->
<script>
  function toggleContactMenu() {
    var contactMenu = document.querySelector('.contact-options');
    if (contactMenu.style.display === "flex") {
      contactMenu.style.display = "none";
    } else {
      contactMenu.style.display = "flex";
    }
  }
</script>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
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

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
