<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php require_once 'connection.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Payments</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Payments</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Recent Transactions</h5>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Booking ID</th>
              <th>Amount (₹)</th>
              <th>Razorpay ID</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = "SELECT * FROM payments ORDER BY payment_date DESC";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  // Set color for status
                  $status_color = ($row['status'] == 'Success') ? 'text-success' : 'text-danger';
                  echo "<tr>
                          <td>{$row['payment_id']}</td>
                          <td>{$row['booking_id']}</td>
                          <td>₹" . number_format($row['amount'], 2) . "</td>
                          <td>{$row['razorpay_payment_id']}</td>
                          <td class='{$status_color}'>{$row['status']}</td>
                          <td>{$row['payment_date']}</td>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='6' class='text-center'>No payments found.</td></tr>";
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
