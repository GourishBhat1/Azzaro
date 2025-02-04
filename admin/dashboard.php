<?php
// Ensure session is not already started
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once 'connection.php';

// Redirect if not logged in
if (!isset($_SESSION['admin_logged_in']) && !isset($_COOKIE['azzaro_admin'])) {
    header('Location: index.php');
    exit();
}

// Fetch key metrics
$stats_query = "
    SELECT 
        (SELECT COUNT(*) FROM bookings) AS total_bookings,
        (SELECT COUNT(*) FROM rooms) AS total_rooms,
        (SELECT COALESCE(SUM(amount), 0) FROM payments WHERE status = 'Success') AS total_revenue,
        (SELECT COUNT(*) FROM users WHERE role = 'customer') AS total_customers
";
$stats_result = $conn->query($stats_query);
$stats = $stats_result->fetch_assoc();

// Fetch recent bookings
$recent_bookings_query = "
    SELECT b.booking_id, u.username, r.room_name, b.check_in, b.check_out, b.status
    FROM bookings b
    JOIN users u ON b.user_id = u.user_id
    JOIN rooms r ON b.room_id = r.room_id
    ORDER BY b.created_at DESC LIMIT 5
";
$recent_bookings_result = $conn->query($recent_bookings_query);

// Fetch revenue data per month for chart
$revenue_chart_query = "
    SELECT DATE_FORMAT(payment_date, '%b') AS month, SUM(amount) AS revenue 
    FROM payments 
    WHERE status = 'Success'
    GROUP BY MONTH(payment_date)
    ORDER BY MONTH(payment_date)
";
$revenue_chart_result = $conn->query($revenue_chart_query);

// Format revenue data for Chart.js
$months = [];
$revenues = [];

while ($row = $revenue_chart_result->fetch_assoc()) {
    $months[] = $row['month'];
    $revenues[] = $row['revenue'];
}

$months_json = json_encode($months);
$revenues_json = json_encode($revenues);
?>

<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">
      
      <!-- Quick Stats -->
      <div class="col-lg-3 col-md-6">
        <div class="card info-card">
          <div class="card-body">
            <h5 class="card-title">Total Bookings</h5>
            <h3><?= $stats['total_bookings'] ?></h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card info-card">
          <div class="card-body">
            <h5 class="card-title">Total Rooms</h5>
            <h3><?= $stats['total_rooms'] ?></h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card info-card">
          <div class="card-body">
            <h5 class="card-title">Total Revenue</h5>
            <h3>₹ <?= number_format($stats['total_revenue'], 2) ?></h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card info-card">
          <div class="card-body">
            <h5 class="card-title">Total Customers</h5>
            <h3><?= $stats['total_customers'] ?></h3>
          </div>
        </div>
      </div>

      <!-- Recent Bookings -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Recent Bookings</h5>
            <table class="table">
              <thead>
                <tr>
                  <th>Booking ID</th>
                  <th>Customer</th>
                  <th>Room</th>
                  <th>Check-In</th>
                  <th>Check-Out</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $recent_bookings_result->fetch_assoc()): ?>
                <tr>
                  <td><?= $row['booking_id'] ?></td>
                  <td><?= htmlspecialchars($row['username']) ?></td>
                  <td><?= htmlspecialchars($row['room_name']) ?></td>
                  <td><?= $row['check_in'] ?></td>
                  <td><?= $row['check_out'] ?></td>
                  <td>
                    <span class="badge bg-<?= $row['status'] == 'Confirmed' ? 'success' : ($row['status'] == 'Pending' ? 'warning' : 'danger') ?>">
                      <?= $row['status'] ?>
                    </span>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Revenue Chart -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Revenue Overview</h5>
            <canvas id="revenueChart"></canvas>
          </div>
        </div>
      </div>

    </div>
  </section>

</main><!-- End #main -->

<?php include 'footer.php'; ?>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Fetch PHP data for chart
  var revenueMonths = <?= $months_json ?>;
  var revenueData = <?= $revenues_json ?>;

  // Generate the Revenue Chart with live data
  var ctx = document.getElementById('revenueChart').getContext('2d');
  var revenueChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: revenueMonths,
      datasets: [{
        label: 'Revenue (₹)',
        data: revenueData,
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
