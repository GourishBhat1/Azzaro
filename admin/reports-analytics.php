<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Reports & Analytics</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Reports & Analytics</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <!-- Revenue Chart -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Revenue Reports</h5>
            <canvas id="revenueChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Booking Trends -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Booking Trends</h5>
            <canvas id="bookingTrendsChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Customer Insights -->
      <div class="col-lg-6 mt-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Customer Insights</h5>
            <canvas id="customerInsightsChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Fetch analytics data from PHP
    fetch('reports-data.php')
        .then(response => response.json())
        .then(data => {
            // Revenue Chart
            new Chart(document.getElementById("revenueChart"), {
                type: 'line',
                data: {
                    labels: data.dates,
                    datasets: [{
                        label: 'Total Revenue (₹)',
                        data: data.revenue,
                        borderColor: '#1b7a78',
                        backgroundColor: 'rgba(27, 122, 120, 0.2)',
                        fill: true
                    }]
                }
            });

            // Booking Trends Chart
            new Chart(document.getElementById("bookingTrendsChart"), {
                type: 'bar',
                data: {
                    labels: data.room_types,
                    datasets: [{
                        label: 'Number of Bookings',
                        data: data.bookings,
                        backgroundColor: '#003580'
                    }]
                }
            });

            // Customer Insights Chart
            new Chart(document.getElementById("customerInsightsChart"), {
                type: 'doughnut',
                data: {
                    labels: ['Returning Customers', 'New Customers'],
                    datasets: [{
                        data: data.customers,
                        backgroundColor: ['#28a745', '#ffc107']
                    }]
                }
            });
        });
});
</script>
