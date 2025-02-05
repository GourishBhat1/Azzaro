<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Check if admin ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$admin_id = intval($_GET['id']);

// Fetch the admin details
$stmt = $conn->prepare("SELECT username, email, role FROM users WHERE user_id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Admin not found.");
}

$admin = $result->fetch_assoc();

// Handle form submission for updating admin details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    // Check if a new password is entered
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, password_hash = ?, role = ? WHERE user_id = ?");
        $update_stmt->bind_param("ssssi", $username, $email, $password, $role, $admin_id);
    } else {
        $update_stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE user_id = ?");
        $update_stmt->bind_param("sssi", $username, $email, $role, $admin_id);
    }

    if ($update_stmt->execute()) {
        echo "<div class='alert alert-success'>Admin updated successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating admin.</div>";
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Admin</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="admin-management.php">Admin Management</a></li>
        <li class="breadcrumb-item active">Edit Admin</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Admin Details</h5>

        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" value="<?= htmlspecialchars($admin['username']) ?>" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required />
          </div>
          <div class="mb-3">
            <label class="form-label">New Password (Leave blank to keep current)</label>
            <input type="password" class="form-control" name="password" />
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role">
              <option value="admin" <?= ($admin['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
              <option value="manager" <?= ($admin['role'] === 'manager') ? 'selected' : '' ?>>Manager</option>
              <option value="editor" <?= ($admin['role'] === 'editor') ? 'selected' : '' ?>>Editor</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Update Admin</button>
          <a href="admin-management.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
