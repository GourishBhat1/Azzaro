<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

if (!isset($_GET['id'])) {
    header("Location: room-pricing.php");
    exit();
}

$package_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM room_packages WHERE package_id = ?");
$stmt->bind_param("i", $package_id);
$stmt->execute();
$package = $stmt->get_result()->fetch_assoc();

// Handle package update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_package'])) {
    $package_name = trim($_POST['package_name']);
    $discount = intval($_POST['discount']);

    if (!empty($package_name)) {
        $update_stmt = $conn->prepare("UPDATE room_packages SET package_name = ?, discount = ? WHERE package_id = ?");
        $update_stmt->bind_param("sii", $package_name, $discount, $package_id);
        if ($update_stmt->execute()) {
            echo "<script>alert('Package updated successfully'); window.location.href='room-pricing.php';</script>";
        } else {
            echo "<script>alert('Error updating package');</script>";
        }
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Package</h1>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Package Name</label>
            <input type="text" class="form-control" name="package_name" value="<?= htmlspecialchars($package['package_name']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Discount (%)</label>
            <input type="number" class="form-control" name="discount" value="<?= $package['discount'] ?>" required min="0">
          </div>
          <button type="submit" name="update_package" class="btn btn-primary">Update Package</button>
          <a href="room-pricing.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
