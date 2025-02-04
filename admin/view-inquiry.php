<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Get inquiry ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: inquiries.php");
    exit();
}

$inquiry_id = $_GET['id'];

// Fetch inquiry details
$stmt = $conn->prepare("SELECT * FROM inquiries WHERE inquiry_id = ?");
$stmt->bind_param("i", $inquiry_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Inquiry not found!'); window.location.href='inquiries.php';</script>";
    exit();
}

$inquiry = $result->fetch_assoc();

// Handle status update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_status = $_POST['status'];
    $update_stmt = $conn->prepare("UPDATE inquiries SET status = ? WHERE inquiry_id = ?");
    $update_stmt->bind_param("si", $new_status, $inquiry_id);
    $update_stmt->execute();
    echo "<script>alert('Status updated successfully!'); window.location.href='view-inquiry.php?id=$inquiry_id';</script>";
    exit();
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>View Inquiry</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="inquiries.php">Inquiries</a></li>
        <li class="breadcrumb-item active">View Inquiry</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Inquiry Details</h5>

        <p><strong>Name:</strong> <?= htmlspecialchars($inquiry['name']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($inquiry['email']); ?></p>
        <p><strong>Subject:</strong> <?= htmlspecialchars($inquiry['subject']); ?></p>
        <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($inquiry['message'])); ?></p>
        <p><strong>Current Status:</strong> <span class="badge bg-primary"><?= htmlspecialchars($inquiry['status']); ?></span></p>

        <form method="POST">
          <label class="form-label">Update Status:</label>
          <select name="status" class="form-select">
            <option value="New" <?= ($inquiry['status'] == "New") ? "selected" : ""; ?>>New</option>
            <option value="In Progress" <?= ($inquiry['status'] == "In Progress") ? "selected" : ""; ?>>In Progress</option>
            <option value="Closed" <?= ($inquiry['status'] == "Closed") ? "selected" : ""; ?>>Closed</option>
          </select>
          <button type="submit" class="btn btn-success mt-3">Update Status</button>
        </form>

      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
