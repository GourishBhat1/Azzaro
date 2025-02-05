<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Fetch existing settings
$query = "SELECT setting_key, setting_value FROM website_settings 
          WHERE setting_key IN ('resort_name', 'resort_address', 'resort_phone', 'resort_email', 'social_links')";
$result = $conn->query($query);

$settings = [];
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resort_name = $conn->real_escape_string($_POST['resort_name']);
    $resort_address = $conn->real_escape_string($_POST['resort_address']);
    $resort_phone = $conn->real_escape_string($_POST['resort_phone']);
    $resort_email = $conn->real_escape_string($_POST['resort_email']);
    $social_links = $conn->real_escape_string($_POST['social_links']);

    // Update settings in the database
    $update_queries = [
        "UPDATE website_settings SET setting_value='$resort_name' WHERE setting_key='resort_name'",
        "UPDATE website_settings SET setting_value='$resort_address' WHERE setting_key='resort_address'",
        "UPDATE website_settings SET setting_value='$resort_phone' WHERE setting_key='resort_phone'",
        "UPDATE website_settings SET setting_value='$resort_email' WHERE setting_key='resort_email'",
        "UPDATE website_settings SET setting_value='$social_links' WHERE setting_key='social_links'"
    ];

    foreach ($update_queries as $query) {
        $conn->query($query);
    }

    echo "<script>alert('Website settings updated successfully!'); window.location.href='settings-website.php';</script>";
}
?>

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
            <input type="text" class="form-control" name="resort_name" value="<?= htmlspecialchars($settings['resort_name'] ?? '') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="resort_address" value="<?= htmlspecialchars($settings['resort_address'] ?? '') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="resort_phone" value="<?= htmlspecialchars($settings['resort_phone'] ?? '') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="resort_email" value="<?= htmlspecialchars($settings['resort_email'] ?? '') ?>">
          </div>
          <div class="mb-3">
            <label class="form-label">Social Links (JSON Format)</label>
            <textarea class="form-control" name="social_links" rows="3"><?= htmlspecialchars($settings['social_links'] ?? '') ?></textarea>
          </div>
          <button type="submit" class="btn btn-success">Save Settings</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
