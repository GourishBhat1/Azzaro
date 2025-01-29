<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Manage Bookings</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Bookings</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Bookings</h5>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Customer</th><th>Room</th><th>Check-in</th><th>Check-out</th><th>Status</th><th>Payment</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- SELECT from bookings joined with users, rooms -->
            <tr>
              <td>1001</td>
              <td>john_doe</td>
              <td>Deluxe Sea View</td>
              <td>2024-02-15</td>
              <td>2024-02-20</td>
              <td>Pending</td>
              <td>Unpaid</td>
              <td>
                <button class="btn btn-sm btn-primary">View</button>
                <button class="btn btn-sm btn-success">Confirm</button>
                <button class="btn btn-sm btn-danger">Cancel</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
