<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Customer Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Customer Management</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Customers</h5>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Username</th><th>Email</th><th>Status</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop: SELECT * FROM users WHERE role='customer' -->
            <tr>
              <td>2</td>
              <td>john_doe</td>
              <td>john@example.com</td>
              <td>Active</td>
              <td>
                <button class="btn btn-sm btn-primary">View Bookings</button>
                <button class="btn btn-sm btn-warning">Deactivate</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
