<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Handle form submission for adding a new package
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_package'])) {
    $package_name = trim($_POST['package_name']);
    $discount = intval($_POST['discount']);

    if (!empty($package_name) && $discount >= 0) {
        $stmt = $conn->prepare("INSERT INTO room_packages (package_name, discount) VALUES (?, ?)");
        $stmt->bind_param("si", $package_name, $discount);
        if ($stmt->execute()) {
            echo "<script>alert('Package added successfully'); window.location.href='room-pricing.php';</script>";
        } else {
            echo "<script>alert('Error adding package');</script>";
        }
    }
}

// Handle package deletion
if (isset($_GET['delete'])) {
    $package_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM room_packages WHERE package_id = ?");
    $stmt->bind_param("i", $package_id);
    if ($stmt->execute()) {
        echo "<script>alert('Package deleted successfully'); window.location.href='room-pricing.php';</script>";
    } else {
        echo "<script>alert('Error deleting package');</script>";
    }
}

// Fetch all pricing packages
$packages = $conn->query("SELECT * FROM room_packages ORDER BY package_id ASC");
?>

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

        <!-- Pricing Packages Table -->
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Package Name</th>
              <th>Discount (%)</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($package = $packages->fetch_assoc()) : ?>
            <tr>
              <td><?= $package['package_id'] ?></td>
              <td><?= htmlspecialchars($package['package_name']) ?></td>
              <td><?= $package['discount'] ?>%</td>
              <td>
                <a href="edit-package.php?id=<?= $package['package_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="?delete=<?= $package['package_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

        <!-- Add New Package Form -->
        <h5 class="mt-4">Add New Package</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Package Name</label>
            <input type="text" class="form-control" name="package_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Discount (%)</label>
            <input type="number" class="form-control" name="discount" required min="0">
          </div>
          <button type="submit" name="add_package" class="btn btn-success">Add Package</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
