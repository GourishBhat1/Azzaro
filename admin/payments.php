<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Payment Tracking</h1>
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
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Booking ID</th><th>Amount</th><th>Razorpay ID</th><th>Status</th><th>Date</th>
            </tr>
          </thead>
          <tbody>
            <!-- SELECT * FROM payments ORDER BY payment_date DESC -->
            <tr>
              <td>1</td>
              <td>1001</td>
              <td>$500</td>
              <td>pay_ABC123xyz</td>
              <td>Success</td>
              <td>2024-02-10 12:34:56</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
