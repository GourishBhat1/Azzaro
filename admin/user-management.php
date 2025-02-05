<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Fetch all customers (only role = 'customer')
$query = "SELECT user_id, username, email, role, created_at FROM users WHERE role = 'customer'";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Customer Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Customer Management</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Customers</h5>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Registered On</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['user_id'] ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td>
                <span class="badge bg-info"><?= ucfirst($row['role']) ?></span>
              </td>
              <td><?= date("d M Y", strtotime($row['created_at'])) ?></td>
              <td>
                <a href="view-user-bookings.php?id=<?= $row['user_id'] ?>" class="btn btn-sm btn-primary">View Bookings</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
