<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Pricing & Packages</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Pricing & Packages</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Seasonal Offers / Packages</h5>
        <!-- Example: List of special packages -->
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Package Name</th><th>Discount</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Winter Special</td>
              <td>20% off</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Delete</button></td>
            </tr>
          </tbody>
        </table>

        <h5 class="mt-4">Add New Package</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Package Name</label>
            <input type="text" class="form-control" name="package_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Discount (%)</label>
            <input type="number" class="form-control" name="discount" required>
          </div>
          <button type="submit" class="btn btn-success">Add Package</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
