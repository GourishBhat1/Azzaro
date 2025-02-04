<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

if (!isset($_GET['id'])) {
    header("Location: room-categories.php");
    exit();
}

$category_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM room_categories WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$category = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
    $category_name = trim($_POST['category_name']);
    $description = trim($_POST['description']);

    if (!empty($category_name)) {
        $update_stmt = $conn->prepare("UPDATE room_categories SET category_name = ?, description = ? WHERE category_id = ?");
        $update_stmt->bind_param("ssi", $category_name, $description, $category_id);
        if ($update_stmt->execute()) {
            echo "<script>alert('Category updated successfully'); window.location.href='room-categories.php';</script>";
        } else {
            echo "<script>alert('Error updating category');</script>";
        }
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Room Category</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="room-categories.php">Room Categories</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Category</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" name="category_name" value="<?= htmlspecialchars($category['category_name']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description"><?= htmlspecialchars($category['description']) ?></textarea>
          </div>
          <button type="submit" name="update_category" class="btn btn-primary">Update Category</button>
          <a href="room-categories.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
