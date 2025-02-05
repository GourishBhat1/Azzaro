<?php
session_start();
require_once 'admin/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Stays - Azzaro Resorts & Spas</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="blog-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/new_img/azzaro_logo.jpg" alt="">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
          <li><a href="rooms.php" class="<?= basename($_SERVER['PHP_SELF']) == 'rooms.php' ? 'active' : ''; ?>">Stays</a></li>
          <li><a href="gallery.php" class="<?= basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : ''; ?>">Gallery</a></li>
          <li><a href="contact.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>

          <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">Bookings</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php else: ?>
            <li><a href="login.php" class="<?= basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">Login</a></li>
          <?php endif; ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <main class="main">

    <!-- Rooms Page Title -->
    <div class="page-title light-background">
      <div class="container">
        <h1>Our Stays</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Stays</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <?php
    // Fetch all rooms from the database
    $query = "SELECT room_id, room_name, description, images FROM rooms";
    $result = $conn->query($query);
    ?>

    <!-- Blog Posts Section -->
    <section id="blog-posts" class="blog-posts section">
      <div class="container section-title" data-aos="fade-up">
        <p>Explore Our Rooms</p>
        <h2>Accommodations</h2>
      </div>

      <div class="container">
        <div class="row gy-4 justify-content-center">

          <?php while ($room = $result->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-5">
              <div class="card shadow-sm border-0 h-100" data-aos="fade-up">
                <?php
                // Fixing image path issue
                $image_list = json_decode($room['images'], true);
                $first_image = !empty($image_list) ? "admin/" . htmlspecialchars($image_list[0]) : "assets/img/default-room.jpg";
                ?>
                <img src="<?= $first_image ?>" 
                     alt="<?= htmlspecialchars($room['room_name']) ?>" 
                     style="width: 100%; height: 280px; object-fit: cover; border-radius: 5px 5px 0 0;">
                <div class="card-body text-center">
                  <h5 class="card-title fw-semibold text-heading"><?= htmlspecialchars($room['room_name']) ?></h5>
                  <p class="card-text text-muted">
                    <?= htmlspecialchars($room['description']) ?>
                  </p>
                  <a href="room_details.php?id=<?= $room['room_id'] ?>" 
                     style="display: inline-block; background-color: #1b7a78; color: #ffffff; border: 2px solid #1b7a78; border-radius: 5px; font-weight: 600; padding: 10px 20px; text-decoration: none; transition: all 0.3s ease-in-out;"
                     onmouseover="this.style.backgroundColor='#154a4f'; this.style.borderColor='#154a4f';" 
                     onmouseout="this.style.backgroundColor='#1b7a78'; this.style.borderColor='#1b7a78';">
                     Book Now
                  </a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>

        </div>
      </div>
    </section>
    <!-- /Blog Posts Section -->

  </main>

  <footer id="footer" class="footer light-background">
    <div class="container">
      <p>© 2025 Azzaro Resorts & Spa. All Rights Reserved.</p>
    </div>
  </footer>

  <a href="#" class="scroll-top"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>
</html>
