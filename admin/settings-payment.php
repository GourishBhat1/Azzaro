<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Payment Settings</h1>
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
        <h5 class="card-title">Configure Payment Options</h5>
        <p>Example: Enable or disable certain payment gateways, set default currency, etc.</p>
        <form method="POST">
          <!-- Payment options here -->
          <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
