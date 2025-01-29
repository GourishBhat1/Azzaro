<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Razorpay Settings</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Payment Settings</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Configure Razorpay API Keys</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Key ID</label>
            <input type="text" class="form-control" name="razorpay_key_id">
          </div>
          <div class="mb-3">
            <label class="form-label">Key Secret</label>
            <input type="text" class="form-control" name="razorpay_key_secret">
          </div>
          <div class="mb-3">
            <label class="form-label">Webhook Secret (optional)</label>
            <input type="text" class="form-control" name="razorpay_webhook_secret">
          </div>
          <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
