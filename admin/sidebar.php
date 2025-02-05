<?php
// sidebar.php
?>
<style>/* Sidebar Styling */
.sidebar-nav .nav-item a {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  font-size: 14px;
  color: #333; /* Uniform text color */
  background: transparent; /* Remove unwanted background colors */
  border-radius: 5px;
  transition: all 0.3s ease-in-out;
}

.sidebar-nav .nav-item a i {
  font-size: 18px;
  margin-right: 10px;
}

/* Ensure all items have the same hover effect */
.sidebar-nav .nav-item a:hover,
.sidebar-nav .nav-item a.active {
  background: #f4f4f4; /* Light background on hover */
  color: #003580; /* Uniform blue color */
}

/* Submenu items uniform styling */
.sidebar-nav .nav-content {
  padding-left: 20px;
}

.sidebar-nav .nav-content a {
  padding: 8px 15px;
  font-size: 13px;
  color: #555; /* Slightly dimmed */
  border-radius: 4px;
  transition: all 0.3s ease-in-out;
}

.sidebar-nav .nav-content a:hover {
  color: #003580;
  background: #f4f4f4;
}

/* Remove extra bold/blue styling */
.sidebar-nav .nav-item a.active {
  font-weight: normal;
  background: transparent;
  color: #003580;
}</style>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- Dashboard -->
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <!-- Admin Management -->
    <li class="nav-item">
      <a class="nav-link" href="admin-management.php">
        <i class="bi bi-people"></i>
        <span>Admin Management</span>
      </a>
    </li>

    <!-- Customer Management -->
    <li class="nav-item">
      <a class="nav-link" href="user-management.php">
        <i class="bi bi-person-check-fill"></i>
        <span>Customer Management</span>
      </a>
    </li>

    <!-- Room Management -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#room-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-building"></i><span>Rooms</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="room-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="room-management.php">
            <i class="bi bi-circle"></i><span>Manage Rooms</span>
          </a>
        </li>
        <li>
          <a href="room-categories.php">
            <i class="bi bi-circle"></i><span>Room Categories</span>
          </a>
        </li>
        <!-- <li>
          <a href="room-pricing.php">
            <i class="bi bi-circle"></i><span>Pricing & Packages</span>
          </a>
        </li> -->
      </ul>
    </li>

    <!-- Bookings -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#booking-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-card-checklist"></i><span>Bookings</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="booking-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="booking-management.php">
            <i class="bi bi-circle"></i><span>Manage Bookings</span>
          </a>
        </li>
        <!-- <li>
          <a href="view-booking.php">
            <i class="bi bi-circle"></i><span>View Booking</span>
          </a>
        </li> -->
        <li>
          <a href="booking-calendar.php">
            <i class="bi bi-circle"></i><span>Calendar View</span>
          </a>
        </li>
      </ul>
    </li>

    <!-- Payments & Razorpay -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#payments-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-currency-dollar"></i><span>Payments</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="payments-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="payments.php">
            <i class="bi bi-circle"></i><span>Payment Tracking</span>
          </a>
        </li>
        <!-- <li>
          <a href="razorpay-settings.php">
            <i class="bi bi-circle"></i><span>Razorpay Settings</span>
          </a>
        </li> -->
      </ul>
    </li>

    <!-- Gallery Management -->
    <li class="nav-item">
      <a class="nav-link" href="gallery-management.php">
        <i class="bi bi-images"></i>
        <span>Gallery Management</span>
      </a>
    </li>

    <!-- Inquiries -->
    <li class="nav-item">
      <a class="nav-link" href="inquiries.php">
        <i class="bi bi-envelope"></i>
        <span>Customer Inquiries</span>
      </a>
    </li>

    <!-- Content Management -->
    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#content-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-text"></i><span>Content</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="content-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="cms-pages.php">
            <i class="bi bi-circle"></i><span>Website Pages</span>
          </a>
        </li>
        <li>
          <a href="testimonials.php">
            <i class="bi bi-circle"></i><span>Testimonials</span>
          </a>
        </li>
        <li>
          <a href="blog-management.php">
            <i class="bi bi-circle"></i><span>Blog Management</span>
          </a>
        </li>
      </ul>
    </li> -->

    <!-- Reports & Analytics -->
    <li class="nav-item">
      <a class="nav-link" href="reports-analytics.php">
        <i class="bi bi-bar-chart"></i>
        <span>Reports & Analytics</span>
      </a>
    </li>

    <!-- Settings -->
    <!-- <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear"></i><span>Settings</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="settings-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="settings-website.php">
            <i class="bi bi-circle"></i><span>Website Settings</span>
          </a>
        </li>
        <li>
          <a href="settings-payment.php">
            <i class="bi bi-circle"></i><span>Payment Settings</span>
          </a>
        </li>
      </ul>
    </li> -->

  </ul>

</aside><!-- End Sidebar -->
