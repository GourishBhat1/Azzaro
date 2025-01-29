<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Customer Inquiries</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Inquiries</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Inquiries</h5>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Status</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- SELECT * FROM inquiries ORDER BY created_at DESC -->
            <tr>
              <td>1</td>
              <td>Jane Smith</td>
              <td>jane@example.com</td>
              <td>Booking Question</td>
              <td>New</td>
              <td><button class="btn btn-sm btn-primary">View</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
