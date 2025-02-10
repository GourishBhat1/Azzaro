<?php
session_start();
require_once 'admin/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home - Azzaro Resorts & Spa</title>
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

<body class="index-page">

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

    <!-- About Section -->
    <section id="about" class="about section">
  <div class="container">
    <div class="row align-items-center justify-content-between">
      <!-- Video Section -->
      <div class="col-lg-7 mb-5 mb-lg-0 order-lg-2" data-aos="fade-up" data-aos-delay="400">
        <video class="img-fluid" autoplay muted loop playsinline>
          <source src="assets/img/azzaro_welcome.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
      <!-- Content Section -->
      <div class="col-lg-4 order-lg-1">
        <span class="section-subtitle" data-aos="fade-up">Welcome</span>
        <h1 class="mb-4" data-aos="fade-up">Azzaro Resort & Spa</h1>
        <p data-aos="fade-up">
          Welcome to Azzaro Resort & Spa, a luxurious retreat where elegance meets serenity. Nestled between pristine beaches and lush greenery, our resort is a haven for those seeking unparalleled comfort, world-class amenities, and unforgettable experiences.
        </p>
        <p data-aos="fade-up">
          Indulge in our thoughtfully designed accommodations, rejuvenating spa treatments, and gourmet dining options. Explore nearby attractions such as Nagoa Beach, Diu Fort, and the iconic INS Khukri Memorial while we take care of every detail to make your stay extraordinary.
        </p>
        <p class="mt-5" data-aos="fade-up">
          <a href="rooms.php" class="btn btn-get-started">Book Your Stay Now</a>
        </p>
      </div>
    </div>
  </div>
</section>


    <!-- About 2 Section -->
<section id="about-2" class="about-2 section light-background">
  <div class="container-fluid">
    <div class="content">
      <div class="row align-items-center justify-content-center">
        
        <!-- Image Column (Increased size) -->
        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 order-lg-2">
          <div class="img-wrap text-center text-md-left" data-aos="fade-up" data-aos-delay="100">
            <div class="img">
              <img src="assets/img/rooms/outdoor_3.jpg" alt="Azzaro Resort" 
                   class="img-fluid" 
                   style="max-width: 100%; height: auto; display: block;">
            </div>
          </div>
        </div>

        <!-- Text Content Column (Slightly reduced width) -->
        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4" data-aos="fade-up">
          <div class="px-3">
            <span class="content-subtitle">Our Mission</span>
            <h2 class="content-title">
              Delivering unparalleled luxury and comfort to every guest.
            </h2>
            <p class="lead">
              At Azzaro Resorts & Spa, our mission is to create a sanctuary where guests can immerse themselves in the tranquility of nature, embrace world-class amenities, and experience impeccable service.
            </p>
            <p class="mb-5">
              We are dedicated to crafting unforgettable experiences through our luxurious accommodations, gourmet dining, rejuvenating spa therapies, and curated activities that reflect the vibrant local culture.
            </p>
            <p>
              <!-- <a href="about.html" class="btn-get-started" style="display: inline-block; background-color: #1b7a78; color: #ffffff; border: 2px solid #1b7a78; border-radius: 5px; font-weight: 600; padding: 10px 20px; text-decoration: none; transition: all 0.3s ease-in-out;"
                 onmouseover="this.style.backgroundColor='#154a4f'; this.style.borderColor='#154a4f';" 
                 onmouseout="this.style.backgroundColor='#1b7a78'; this.style.borderColor='#1b7a78';">
                Learn More
              </a> -->
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- /About 2 Section -->

    <!-- Services Section -->
<section id="services" class="services section light-background">
  <div class="container">
    <div class="row gy-4 justify-content-center">

      <!-- Service 1: Nilaya Spa -->
      <div class="col-lg-3">
        <a href="gallery.html" class="services-item text-decoration-none" data-aos="fade-up">
          <div class="services-icon">
            <i class="bi bi-flower1"></i> <!-- Spa icon -->
          </div>
          <div>
            <h3>Nilaya Spa</h3>
            <p>
              A serene retreat offering relaxation and rejuvenation through therapeutic treatments like massages, facials, and wellness therapies.
            </p>
          </div>
        </a>
      </div>

      <!-- Service 2: Gym -->
      <div class="col-lg-3">
        <a href="gallery.html" class="services-item text-decoration-none" data-aos="fade-up" data-aos-delay="100">
          <div class="services-icon">
            <i class="bi bi-person-arms-up"></i> <!-- Gym icon -->
          </div>
          <div>
            <h3>Gym</h3>
            <p>
              Equipped with various exercise machines and free weights to help individuals improve their fitness and health.
            </p>
          </div>
        </a>
      </div>

      <!-- Service 3: Games Room -->
      <div class="col-lg-3">
        <a href="gallery.html" class="services-item text-decoration-none" data-aos="fade-up" data-aos-delay="200">
          <div class="services-icon">
            <i class="bi bi-controller"></i> <!-- Game controller icon -->
          </div>
          <div>
            <h3>Games Room</h3>
            <p>
              The games room features a pool table and a carrom board, perfect for endless hours of fun and friendly competition.
            </p>
          </div>
        </a>
      </div>

    </div>

    <div class="row gy-4 justify-content-center mt-4">

      <!-- Service 4: Outdoor Play Area -->
      <div class="col-lg-3">
        <a href="gallery.html" class="services-item text-decoration-none" data-aos="fade-up" data-aos-delay="300">
          <div class="services-icon">
            <i class="bi bi-tree-fill"></i> <!-- Tree icon -->
          </div>
          <div>
            <h3>Outdoor Play Area</h3>
            <p>
              A spacious play area designed for children to enjoy fun activities in a safe outdoor environment.
            </p>
          </div>
        </a>
      </div>

      <!-- Service 5: Restaurant & Dining -->
      <div class="col-lg-3">
        <a href="gallery.html" class="services-item text-decoration-none" data-aos="fade-up" data-aos-delay="400">
          <div class="services-icon">
            <i class="bi bi-egg-fried"></i> <!-- Food icon -->
          </div>
          <div>
            <h3>Restaurant & Dining</h3>
            <p>
              A selection of two fine dining restaurants and a cosy coffee shop offering a variety of culinary experiences.
            </p>
          </div>
        </a>
      </div>

      <!-- Service 6: Banquet Hall/Ballroom -->
      <div class="col-lg-3">
        <a href="gallery.html" class="services-item text-decoration-none" data-aos="fade-up" data-aos-delay="500">
          <div class="services-icon">
            <i class="bi bi-buildings"></i> <!-- Hall icon -->
          </div>
          <div>
            <h3>Banquet Hall/Ballroom</h3>
            <p>
              The two elegant banquet halls offer versatile spaces, perfect for both weddings and conferences.
            </p>
          </div>
        </a>
      </div>

    </div>

    <div class="row gy-4 justify-content-center mt-4">

      <!-- Service 7: Bar Areas -->
      <div class="col-lg-3">
        <a href="gallery.html" class="services-item text-decoration-none" data-aos="fade-up" data-aos-delay="600">
          <div class="services-icon">
            <i class="bi bi-cup-straw"></i> <!-- Bar icon -->
          </div>
          <div>
            <h3>Bar Areas</h3>
            <p>
              Our resort features two bar areas, including a lively poolside setting and an intimate nook perfect for private chats.
            </p>
          </div>
        </a>
      </div>

    </div>

  </div>
</section>
<!-- /Services Section -->



<!-- Stats Section -->
<section id="stats" class="stats section light-background">

<div class="container">

<div class="row gy-4 justify-content-center">

  <!-- Image Section -->
  <div class="col-lg-5">
    <div class="images-overlap">
      <img src="assets/img/rooms/gallery/pool4.jpg" alt="Luxurious Spa" class="img-fluid img-1" data-aos="fade-up">
    </div>
  </div>

  <!-- Stats Content -->
  <div class="col-lg-4 ps-lg-5">
    <span class="content-subtitle">Why Choose Us</span>
    <h2 class="content-title">Unmatched Luxury & Comfort</h2>
    <p class="lead">
      Surrounded by a wide range of green land, Azzaro offers you a peaceful, soothing and refreshing view. With gracious hospitality and courteous staff, experience the luxury and make your stay memorable. 
    </p>
    <p class="mb-5">
      Every benefit clubbed together, Azzaro in Diu makes in for a perfect beach destination to get away from the hustle of the city. 
    </p>
    <div class="row mb-5 count-numbers">

      <!-- Start Stats Item: Happy Guests -->
      <div class="col-4 counter" data-aos="fade-up" data-aos-delay="100">
        <span class="purecounter number" data-purecounter-start="0" data-purecounter-end="5000" data-purecounter-duration="1"></span>
        <span class="d-block">Happy Guests</span>
      </div>
      <!-- End Stats Item -->
    
      <!-- Start Stats Item: Spa Treatments -->
      <div class="col-4 counter" data-aos="fade-up" data-aos-delay="200">
        <span class="purecounter number" data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="1"></span>
        <span class="d-block">Spa Treatments</span>
      </div>
      <!-- End Stats Item -->
    
      <!-- Start Stats Item: Events Hosted -->
      <div class="col-4 counter" data-aos="fade-up" data-aos-delay="300">
        <span class="purecounter number" data-purecounter-start="0" data-purecounter-end="750" data-purecounter-duration="1"></span>
        <span class="d-block">Events Hosted</span>
      </div>
      <!-- End Stats Item -->
    
    </div>
    
    <!-- Include PureCounter.js -->
    <script src="https://cdn.jsdelivr.net/npm/purecounterjs@1.0.1/dist/purecounter.js"></script>
    
    <!-- Fix for Appending the "+" Sign After Count -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const counters = document.querySelectorAll('.purecounter');
    
        counters.forEach(counter => {
          const observer = new MutationObserver(() => {
            if (!counter.innerHTML.includes('+')) {
              counter.innerHTML += '+';
            }
          });
    
          observer.observe(counter, { childList: true });
        });
      });
    </script>
  </div>

</div>

</div>
</section>
<!-- /Stats Section -->


<?php

// Fetch Club Royale and Suite rooms from the database
$query = "SELECT room_id, room_name, description, images FROM rooms WHERE category_id IN 
          (SELECT category_id FROM room_categories WHERE category_name IN ('Suite', 'Club Royale')) LIMIT 2";
$result = $conn->query($query);
?>

<!-- Blog Posts Section -->
<section id="blog-posts" class="blog-posts section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <p>Explore Our Rooms</p>
    <h2>Accommodations</h2>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4 justify-content-center">

      <?php while ($room = $result->fetch_assoc()): ?>
        <?php 
          // Decode JSON images and fetch the first image
          $image_list = json_decode($room['images'], true);
          $image_path = (!empty($image_list) && isset($image_list[0])) ? 'admin/' . $image_list[0] : 'assets/img/default-room.jpg';
        ?>
        <div class="col-md-6 col-lg-5">
          <div class="card shadow-sm border-0 h-100" data-aos="fade-up">
            <img src="<?= htmlspecialchars($image_path) ?>" 
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





<!-- Tabs Section -->
<section id="tabs" class="tabs section light-background">
  <div class="container">
    <div class="row gap-x-lg-4 justify-content-between">

      <!-- Tabs Navigation -->
      <div class="col-lg-4 js-custom-dots">
        <a href="#" class="service-item link horizontal d-flex active" data-aos="fade-left" data-aos-delay="0">
          <div class="service-icon color-1 mb-4">
            <i class="bi bi-cup"></i>
          </div>
          <div class="service-contents">
            <h3>Dine & Unwind</h3>
            <p>
              Discover exquisite dining experiences with our variety of fine dining, specialty restaurants, and bars.
            </p>
          </div>
        </a>
        <a href="#" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="100">
          <div class="service-icon color-2 mb-4">
            <i class="bi bi-basket3"></i>
          </div>
          <div class="service-contents">
            <h3>Outdoor Play Area</h3>
            <p>
              Enjoy a fun-filled outdoor space designed for families and adventure seekers alike.
            </p>
          </div>
        </a>
        <a href="#" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="200">
          <div class="service-icon color-3 mb-4">
            <i class="bi bi-flower1"></i>
          </div>
          <div class="service-contents">
            <h3>Spa</h3>
            <p>
            A tranquil retreat for relaxation and renewal with expert massages, facials, and wellness therapies.
            </p>
          </div>
        </a>
        <a href="#" class="service-item link horizontal d-flex" data-aos="fade-left" data-aos-delay="300">
          <div class="service-icon color-3 mb-4">
            <i class="bi bi-water"></i>
          </div>
          <div class="service-contents">
            <h3>Swimming Pool</h3>
            <p>
              Relax and rejuvenate in our tranquil swimming pool, the perfect escape from your daily routine.
            </p>
          </div>
        </a>
      </div>
      <!-- End Tabs Navigation -->

      <!-- Tabs Content -->
      <div class="col-lg-8">
        <div class="swiper init-swiper-tabs">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 1000,
              "autoHeight": true,
              "autoplay": {
                "delay": 10000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 1,
                  "spaceBetween": 1
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <!-- Slide 1: Restaurant (Carousel with auto-scroll) -->
            <div class="swiper-slide">
              <div id="restaurantCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-inner">

                  <!-- Slide 1 -->
                  <div class="carousel-item active">
                    <img src="assets/new_img/Opus/Copy of OPUS RESTOBAR.JPG"
                         alt="Opus Multi-Cuisine Restaurant"
                         class="img-fluid"
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="p-4">
                      <h3 class="text-black h5 mb-2">Opus</h3>
                      <p class="mb-0">
                        A multi-cuisine restaurant with global flavors.
                      </p>
                    </div>
                  </div>

                  <!-- Slide 2 -->
                  <div class="carousel-item">
                    <img src="assets/new_img/Kebab/soy 13.JPG"
                         alt="Kebab Specialty Restaurant"
                         class="img-fluid"
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="p-4">
                      <h3 class="text-black h5 mb-2">Kebab</h3>
                      <p class="mb-0">
                        A cozy specialty restaurant offering authentic flavors.
                      </p>
                    </div>
                  </div>

                  <!-- Slide 3 -->
                  <!-- <div class="carousel-item">
                    <img src="assets/new_img/Spa/IMG_4121.JPG"
                         alt="Nilaya Spa"
                         class="img-fluid"
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="p-4">
                      <h3 class="text-black h5 mb-2">Spa</h3>
                      <p class="mb-0">
                        A coffee shop with aromatic brews and fresh treats.
                      </p>
                    </div>
                  </div> -->

                  <!-- Slide 4 -->
                  <div class="carousel-item">
                    <img src="assets/new_img/Aquasia/AQUASIA - THE POOL BAR.JPG"
                         alt="Aquasia Poolside Bar"
                         class="img-fluid"
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="p-4">
                      <h3 class="text-black h5 mb-2">Aquasia</h3>
                      <p class="mb-0">
                        A poolside bar for refreshing drinks and light bites.
                      </p>
                    </div>
                  </div>

                  <!-- Slide 5 -->
                  <div class="carousel-item">
                    <img src="assets/new_img/Hi-Spirit/hi - sprit 4.JPG"
                         alt="Hi-Spirit Bar"
                         class="img-fluid"
                         style="width: 100%; height: 400px; object-fit: cover;">
                    <div class="p-4">
                      <h3 class="text-black h5 mb-2">Hi-Spirit</h3>
                      <p class="mb-0">
                        A refined bar for intimate conversations.
                      </p>
                    </div>
                  </div>

                </div>
                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#restaurantCarousel" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#restaurantCarousel" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
              </div>
            </div>
            <!-- End Slide 1 -->

            <!-- Slide 2: Outdoor Play Area -->
            <div class="swiper-slide">
              <img src="assets/new_img/Outdoor Landscape Shots/Copy of AZR_2794.JPG"
                   alt="Outdoor Play Area"
                   class="img-fluid"
                   style="width: 100%; height: 400px; object-fit: cover;">
              <div class="p-4">
                <!-- <h3 class="text-black h5 mb-3">Outdoor Play Area</h3>
                <p>
                  Our outdoor play area is designed for kids and adults alike to engage in fun activities.
                </p> -->
              </div>
            </div>
            <!-- End Slide 2 -->

            <div class="swiper-slide">
              <img src="assets/new_img/Spa/IMG_4121.JPG"
                   alt="Nilaya Spa"
                   class="img-fluid"
                   style="width: 100%; height: 400px; object-fit: cover;">
              <div class="p-4">
                <!-- <h3 class="text-black h5 mb-3">Swimming Pool</h3>
                <p>
                  Take a refreshing dip in our pristine swimming pool, surrounded by lush greenery and serene vibes.
                </p> -->
              </div>
            </div>

            <!-- Slide 3: Swimming Pool -->
            <div class="swiper-slide">
              <img src="assets/new_img/Pool Shots/Copy of 470A8212.JPG"
                   alt="Tranquil Swimming Pool"
                   class="img-fluid"
                   style="width: 100%; height: 400px; object-fit: cover;">
              <div class="p-4">
                <!-- <h3 class="text-black h5 mb-3">Swimming Pool</h3>
                <p>
                  Take a refreshing dip in our pristine swimming pool, surrounded by lush greenery and serene vibes.
                </p> -->
              </div>
            </div>
            <!-- End Slide 3 -->

          </div> <!-- End Swiper Wrapper -->
        </div>
      </div>
      <!-- End Tabs Content -->

    </div>
  </div>
</section>
<!-- /Tabs Section -->





<!-- Faq Section -->
<section id="faq" class="faq section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <p>Visitor Queries</p>
    <h2>Frequently Asked Questions</h2>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up">
    <div class="row">
      <div class="col-12">
        <div class="custom-accordion" id="accordion-faq">
          
          <!-- FAQ Item 1 -->
          <div class="accordion-item">
            <h2 class="mb-0">
              <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-1" aria-expanded="true">
                How can I reach the resort?
              </button>
            </h2>
            <div id="collapse-faq-1" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion-faq">
              <div class="accordion-body">
                Our resort is located at the very center of Diu, and a mere ~5 km (or an 8 min drive) away from the airport. Shuttle services & airport pickups are also available on request.
              </div>
            </div>
          </div>

          <!-- FAQ Item 2 -->
          <div class="accordion-item">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-2">
                What amenities are included?
              </button>
            </h2>
            <div id="collapse-faq-2" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion-faq">
              <div class="accordion-body">
                Our resort offers a swimming pool, gym, games room, children’s play area, a selection of two fine dining restaurants, a coffee shop, as well as a rejuvenating spa experience. Complimentary Wi-Fi is also available in all rooms and public areas.
              </div>
            </div>
          </div>

          <!-- FAQ Item 3 -->
          <div class="accordion-item">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-3">
                What are some tourist attractions in Diu that we should explore?
              </button>
            </h2>
            <div id="collapse-faq-3" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion-faq">
              <div class="accordion-body">
                Diu offers a blend of natural beauty and historical charm. Must-visit attractions include:
                <ul>
                  <li><strong>Nagoa Beach:</strong> Perfect for relaxation and water sports.</li>
                  <li><strong>Diu Fort:</strong> A historic fort with stunning sea views.</li>
                  <li><strong>Naida Caves:</strong> A natural marvel with intricate rock formations.</li>
                  <li><strong>St. Paul’s Church:</strong> A stunning example of Baroque architecture.</li>
                  <li><strong>Ghoghla Beach:</strong> Known for its tranquillity and golden sands.</li>
                  <li><strong>Panikotha Fort:</strong> A sea-bound fortress accessible by boat.</li>
                  <li><strong>Gangeshwar Temple:</strong> With its five sea-immersed Shiva Lingas, the temple is a serene tribute to Lord Shiva, blending mythological significance with natural beauty.</li>
                </ul>
                These attractions make Diu an ideal destination for history buffs, nature lovers, and adventure seekers alike.
              </div>
            </div>
          </div>

          <!-- FAQ Item 4 -->
          <div class="accordion-item">
            <h2 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-faq-4">
                Are there any On-Prem Guides available at the property?
              </button>
            </h2>
            <div id="collapse-faq-4" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordion-faq">
              <div class="accordion-body">
                While we do not have an On-Prem Guide, we are connected with every possible travel partner you’d need in order to make your experience in Diu a pleasant one. Whether it be transportation for your adventures across Diu or a local guide to help you wander through our renowned tourist attractions, we can assist you in planning your perfect trip.
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section><!-- /Faq Section -->

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <p>Happy Guests</p>
    <h2>Testimonials</h2>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
      <div class="col-lg-7">
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 1,
                  "spaceBetween": 1
                }
              }
            }
          </script>

          <div class="swiper-wrapper">
            <!-- Testimonial 1 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of Bipasha Basu.jpeg" alt="Bipasha Basu's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">Bipasha Basu</h3>
                <p class="profession">Actress</p>
                <blockquote>
                  <p>“Azzaro Resorts provided an unforgettable experience! The ambiance, service, and luxury were beyond expectations.”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of Ekta & Karan Malhotra.jpeg" alt="Ekta & Karan Malhotra's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">Ekta & Karan Malhotra</h3>
                <p class="profession">Film Director & Producer</p>
                <blockquote>
                  <p>“A perfect getaway! The resort’s hospitality and serene surroundings made our vacation special.”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of H.H. Maharaja Gaj Singh II of Jodhpur, President of IHHA.jpeg" alt="Maharaja Gaj Singh II's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">H.H. Maharaja Gaj Singh II</h3>
                <p class="profession">Maharaja of Jodhpur</p>
                <blockquote>
                  <p>“A truly royal experience! The hospitality and grandeur of the resort make it one of the finest stays.”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of Jasbir Jassi.jpeg" alt="Jasbir Jassi's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">Jasbir Jassi</h3>
                <p class="profession">Singer</p>
                <blockquote>
                  <p>“The peaceful surroundings and excellent hospitality made this an incredible stay.”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 5 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of Mika Singh.jpeg" alt="Mika Singh's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">Mika Singh</h3>
                <p class="profession">Singer</p>
                <blockquote>
                  <p>“Had an amazing time at Azzaro Resorts! The hospitality was top-notch, and the vibes were absolutely fantastic.”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 6 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of Priyadarshan.jpeg" alt="Priyadarshan's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">Priyadarshan</h3>
                <p class="profession">Film Director</p>
                <blockquote>
                  <p>“One of the finest luxury resorts I have visited. An absolute pleasure!”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 7 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of Rani Mukerji.jpeg" alt="Rani Mukerji's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">Rani Mukerji</h3>
                <p class="profession">Actress</p>
                <blockquote>
                  <p>“An elegant and charming experience. Highly recommended for a peaceful retreat.”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 8 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of Shreya Ghoshal.jpeg" alt="Shreya Ghoshal's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">Shreya Ghoshal</h3>
                <p class="profession">Singer</p>
                <blockquote>
                  <p>“The peace and luxury at Azzaro Resorts are unparalleled. It’s the perfect escape from the city hustle.”</p>
                </blockquote>
              </div>
            </div>

            <!-- Testimonial 9 -->
            <div class="swiper-slide">
              <div class="testimonial mx-auto text-center">
                <figure>
                  <img src="assets/new_img/Testimonials/Copy of SMT. Pratibhai Devisingh Patil (Former Honarable President of India).jpeg" alt="SMT. Pratibha Devisingh Patil's Experience" class="img-fluid testimonial-img">
                </figure>
                <h3 class="name">SMT. Pratibha Devisingh Patil</h3>
                <p class="profession">Former President of India</p>
                <blockquote>
                  <p>“A wonderful experience at Azzaro Resorts. The hospitality and attention to detail were remarkable.”</p>
                </blockquote>
              </div>
            </div>

          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section><!-- /Testimonials Section -->


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

  <script>
  let progress = 0;
  const loaderText = document.getElementById('preloader-percentage');

  const interval = setInterval(() => {
    progress += 5; // or your actual progress logic
    if (progress >= 100) {
      progress = 100;
      clearInterval(interval);
      // Optionally hide the preloader here
      // document.getElementById('preloader').style.display = 'none';
    }
    loaderText.textContent = progress + '%';
  }, 300);
</script>

</body>

</html>
