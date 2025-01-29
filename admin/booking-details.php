<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Booking Details</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="booking-management.php">Bookings</a></li>
        <li class="breadcrumb-item active">Booking Details</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Booking #1001</h5>
        <!-- Display full booking info -->
        <p><strong>Customer:</strong> John Doe</p>
        <p><strong>Room:</strong> Deluxe Sea View</p>
        <p><strong>Check-in:</strong> 2024-02-15</p>
        <p><strong>Check-out:</strong> 2024-02-20</p>
        <p><strong>Status:</strong> Pending</p>
        <p><strong>Payment Status:</strong> Unpaid</p>
        <p><strong>Razorpay ID:</strong> N/A</p>

        <!-- Actions -->
        <button class="btn btn-success">Mark as Confirmed</button>
        <button class="btn btn-danger">Cancel Booking</button>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
