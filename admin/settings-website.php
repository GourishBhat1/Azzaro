<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Website Settings</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Website Settings</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">General Information</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Resort Name</label>
            <input type="text" class="form-control" name="resort_name" value="Azzaro Resort & Spa">
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="resort_address">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="resort_phone">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="resort_email">
          </div>
          <div class="mb-3">
            <label class="form-label">Social Links</label>
            <textarea class="form-control" name="social_links"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
