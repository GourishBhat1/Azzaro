<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php require_once 'connection.php'; ?>

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

        <?php
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $key_id = trim($_POST['razorpay_key_id']);
            $key_secret = trim($_POST['razorpay_key_secret']);
            $webhook_secret = trim($_POST['razorpay_webhook_secret']);

            if (!empty($key_id) && !empty($key_secret)) {
                // Check if settings exist
                $check_query = "SELECT * FROM website_settings WHERE setting_key IN ('razorpay_key_id', 'razorpay_key_secret', 'razorpay_webhook_secret')";
                $result = $conn->query($check_query);

                if ($result->num_rows > 0) {
                    // Update existing keys
                    $conn->query("UPDATE website_settings SET setting_value='$key_id' WHERE setting_key='razorpay_key_id'");
                    $conn->query("UPDATE website_settings SET setting_value='$key_secret' WHERE setting_key='razorpay_key_secret'");
                    $conn->query("UPDATE website_settings SET setting_value='$webhook_secret' WHERE setting_key='razorpay_webhook_secret'");
                } else {
                    // Insert new keys
                    $conn->query("INSERT INTO website_settings (setting_key, setting_value) VALUES 
                                  ('razorpay_key_id', '$key_id'),
                                  ('razorpay_key_secret', '$key_secret'),
                                  ('razorpay_webhook_secret', '$webhook_secret')");
                }

                echo "<div class='alert alert-success'>Razorpay settings updated successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Key ID and Key Secret are required.</div>";
            }
        }

        // Fetch stored settings
        $settings_query = "SELECT setting_key, setting_value FROM website_settings WHERE setting_key IN ('razorpay_key_id', 'razorpay_key_secret', 'razorpay_webhook_secret')";
        $settings_result = $conn->query($settings_query);
        $settings = [];
        while ($row = $settings_result->fetch_assoc()) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }

        $stored_key_id = $settings['razorpay_key_id'] ?? '';
        $stored_key_secret = $settings['razorpay_key_secret'] ?? '';
        $stored_webhook_secret = $settings['razorpay_webhook_secret'] ?? '';
        ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Key ID</label>
            <input type="text" class="form-control" name="razorpay_key_id" value="<?= htmlspecialchars($stored_key_id) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Key Secret</label>
            <input type="text" class="form-control" name="razorpay_key_secret" value="<?= htmlspecialchars($stored_key_secret) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Webhook Secret (optional)</label>
            <input type="text" class="form-control" name="razorpay_webhook_secret" value="<?= htmlspecialchars($stored_webhook_secret) ?>">
          </div>
          <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
