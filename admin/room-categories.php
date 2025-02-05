<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Handle form submission for adding a new category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $category_name = trim($_POST['category_name']);
    $description = trim($_POST['description']);

    if (!empty($category_name)) {
        $stmt = $conn->prepare("INSERT INTO room_categories (category_name, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $category_name, $description);
        if ($stmt->execute()) {
            echo "<script>alert('Category added successfully'); window.location.href='room-categories.php';</script>";
        } else {
            echo "<script>alert('Error adding category');</script>";
        }
    }
}

// Handle category deletion
if (isset($_GET['delete'])) {
    $category_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM room_categories WHERE category_id = ?");
    $stmt->bind_param("i", $category_id);
    if ($stmt->execute()) {
        echo "<script>alert('Category deleted successfully'); window.location.href='room-categories.php';</script>";
    } else {
        echo "<script>alert('Error deleting category');</script>";
    }
}

// Fetch all room categories
$result = $conn->query("SELECT * FROM room_categories ORDER BY category_id ASC");
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Room Categories</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Room Categories</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Categories</h5>
        
        <!-- Room Categories Table -->
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
              <td><?= $row['category_id'] ?></td>
              <td><?= htmlspecialchars($row['category_name']) ?></td>
              <td><?= htmlspecialchars($row['description']) ?></td>
              <td>
                <a href="edit-category.php?id=<?= $row['category_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="?delete=<?= $row['category_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

        <!-- Add New Category Form -->
        <h5 class="mt-4">Add New Category</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" name="category_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>
          </div>
          <button type="submit" name="add_category" class="btn btn-success">Add Category</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
