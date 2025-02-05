<?php
session_start();
require_once 'admin/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Insert data into inquiries table
    $stmt = $conn->prepare("INSERT INTO inquiries (name, email, subject, message) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect back with success or error message
    header("Location: contact.php?status=success");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Contact - Azzaro Resorts & Spas</title>
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

<body class="contact-page">

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
      <h1>Contact</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="index.php">Home</a></li>
          <li class="current">Contact</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Contact Section -->
  <section id="contact" class="contact section">
    <div class="container" data-aos="fade">

      <div class="row gy-5 gx-lg-5">
        <!-- Contact Info -->
        <div class="col-lg-4">
          <div class="info">
            <h3>Get in touch</h3>
            <p>Have questions or need assistance? We're here to help—reach out anytime!</p>

            <div class="info-item d-flex">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h4>Location:</h4>
                <p>Nagoa Beach Road, Fudam, Diu, Dadra and Nagar Haveli and Daman and Diu, 362520</p>
              </div>
            </div>

            <div class="info-item d-flex">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h4>Email:</h4>
                <p><a href="mailto:info@azzarodiu.com">info@azzarodiu.com</a></p>
              </div>
            </div>

            <div class="info-item d-flex">
              <i class="bi bi-phone flex-shrink-0"></i>
              <div>
                <h4>Call:</h4>
                <p><a href="tel:+917201000746">+91 72010 00746</a></p>
              </div>
            </div>
          </div>
        </div>
        <!-- End Contact Info -->

        <!-- Google Map -->
        <div class="col-lg-8">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3731.9125658007288!2d70.96772577541124!3d20.713774798522397!2m3!1f0!2f0.0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be31ce45e75849b%3A0x357a6ba873c1a26d!2sAzzaro%20Resorts%20%26%20spa!5e0!3m2!1sen!2sin!4v1737144495705!5m2!1sen!2sin"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
        <!-- End Google Map -->
      </div>

      <div class="row mt-5 gy-5 gx-lg-5">
        <!-- Contact Form -->
        <div class="col-lg-12">
          <form id="contactForm" action="contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>

            <!-- Success/Error Messages -->
            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
              <div class="alert alert-success">Your message has been sent. Thank you!</div>
            <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
              <div class="alert alert-danger">There was an error submitting your inquiry. Please try again.</div>
            <?php endif; ?>

            <div class="text-center">
              <button type="submit">Send Message</button>
            </div>
          </form>
        </div>
        <!-- End Contact Form -->
      </div>
    </div>
  </section>
  <!-- End Contact Section -->

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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

  <script>
    document.getElementById("contactForm").addEventListener("submit", function(event){
        event.preventDefault(); // Prevent default form submission
    
        let formData = new FormData(this);
    
        fetch("contact.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                alert("Your message has been sent successfully!");
                document.getElementById("contactForm").reset();
            } else {
                alert("Error: " + data);
            }
        })
        .catch(error => console.error("Error:", error));
    });
    </script>

</body>

</html>
