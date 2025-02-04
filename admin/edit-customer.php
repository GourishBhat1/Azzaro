<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Validate & Get User ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid user ID.");
}
$user_id = intval($_GET['id']);

// Fetch customer details
$user_stmt = $conn->prepare("SELECT username, email, status FROM users WHERE user_id = ? AND role = 'customer'");
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user = $user_result->fetch_assoc();

// If user not found
if (!$user) {
    die("Customer not found.");
}

// Initialize variables
$success_msg = "";
$error_msg = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $status = $_POST['status'];

    // Basic validation
    if (empty($username) || empty($email)) {
        $error_msg = "Username and email cannot be empty.";
    } else {
        // Update query
        $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, status = ? WHERE user_id = ?");
        $update_stmt->bind_param("sssi", $username, $email, $status, $user_id);
        if ($update_stmt->execute()) {
            $success_msg = "Customer details updated successfully.";
            $user['username'] = $username;
            $user['email'] = $email;
            $user['status'] = $status;
        } else {
            $error_msg = "Failed to update customer.";
        }
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Customer</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="user-management.php">Customers</a></li>
        <li class="breadcrumb-item active">Edit Customer</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Customer Details</h5>

        <?php if ($success_msg): ?>
          <div class="alert alert-success"><?= htmlspecialchars($success_msg) ?></div>
        <?php endif; ?>
        <?php if ($error_msg): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($error_msg) ?></div>
        <?php endif; ?>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Account Status</label>
            <select name="status" class="form-select">
              <option value="Active" <?= $user['status'] == 'Active' ? 'selected' : '' ?>>Active</option>
              <option value="Inactive" <?= $user['status'] == 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Update Customer</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
