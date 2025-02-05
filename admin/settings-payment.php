<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Fetch existing settings
$query = "SELECT setting_key, setting_value FROM website_settings 
          WHERE setting_key IN ('default_currency', 'enable_razorpay', 'enable_cod', 'enable_bank_transfer')";
$result = $conn->query($query);

$settings = [];
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $default_currency = $_POST['default_currency'];
    $enable_razorpay = isset($_POST['enable_razorpay']) ? 1 : 0;
    $enable_cod = isset($_POST['enable_cod']) ? 1 : 0;
    $enable_bank_transfer = isset($_POST['enable_bank_transfer']) ? 1 : 0;

    // Update settings in the database
    $update_queries = [
        "UPDATE website_settings SET setting_value='$default_currency' WHERE setting_key='default_currency'",
        "UPDATE website_settings SET setting_value='$enable_razorpay' WHERE setting_key='enable_razorpay'",
        "UPDATE website_settings SET setting_value='$enable_cod' WHERE setting_key='enable_cod'",
        "UPDATE website_settings SET setting_value='$enable_bank_transfer' WHERE setting_key='enable_bank_transfer'"
    ];

    foreach ($update_queries as $query) {
        $conn->query($query);
    }

    echo "<script>alert('Payment settings updated successfully!'); window.location.href='settings-payment.php';</script>";
}
?>

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
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Default Currency</label>
            <select name="default_currency" class="form-select">
              <option value="INR" <?= ($settings['default_currency'] == "INR") ? "selected" : "" ?>>INR (₹)</option>
              <option value="USD" <?= ($settings['default_currency'] == "USD") ? "selected" : "" ?>>USD ($)</option>
              <option value="EUR" <?= ($settings['default_currency'] == "EUR") ? "selected" : "" ?>>EUR (€)</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Enable Payment Methods</label><br>
            <input type="checkbox" name="enable_razorpay" value="1" <?= ($settings['enable_razorpay'] == "1") ? "checked" : "" ?>> Razorpay<br>
            <input type="checkbox" name="enable_cod" value="1" <?= ($settings['enable_cod'] == "1") ? "checked" : "" ?>> Cash on Delivery (COD)<br>
            <input type="checkbox" name="enable_bank_transfer" value="1" <?= ($settings['enable_bank_transfer'] == "1") ? "checked" : "" ?>> Bank Transfer<br>
          </div>

          <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
