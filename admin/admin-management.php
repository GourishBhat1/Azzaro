<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Handle Admin Deletion
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $admin_id = intval($_GET['delete']);
    $delete_stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $delete_stmt->bind_param("i", $admin_id);
    
    if ($delete_stmt->execute()) {
        echo "<div class='alert alert-success'>Admin deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting admin.</div>";
    }
}

// Handle Admin Addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Insert the new admin user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Admin added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding admin.</div>";
    }
}

// Fetch all admin users (excluding customers)
$result = $conn->query("SELECT user_id, username, email, role FROM users WHERE role != 'customer'");
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Admin Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Admin Management</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Admin Users</h5>

        <!-- Table listing all admins -->
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($admin = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $admin['user_id'] ?></td>
                <td><?= htmlspecialchars($admin['username']) ?></td>
                <td><?= htmlspecialchars($admin['email']) ?></td>
                <td><?= ucfirst($admin['role']) ?></td>
                <td>
                  <a href="edit-admin.php?id=<?= $admin['user_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                  <a href="admin-management.php?delete=<?= $admin['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

        <!-- Form to add new admin -->
        <h5 class="mt-4">Add New Admin</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role">
              <option value="admin">Admin</option>
              <option value="manager">Manager</option>
              <option value="editor">Editor</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Add Admin</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
