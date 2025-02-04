<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Check if `id` is present
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid blog post ID.</div>";
    exit();
}

$post_id = intval($_GET['id']);

// Fetch existing post details
$stmt = $conn->prepare("SELECT * FROM blog_posts WHERE post_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "<div class='alert alert-danger'>Post not found.</div>";
    exit();
}

// Handle Form Submission (Updating the Blog Post)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['slug'])));
    $content = trim($_POST['content']);
    $status = $_POST['status'];

    // Update the record
    $update_stmt = $conn->prepare("UPDATE blog_posts SET title = ?, slug = ?, content = ?, status = ?, updated_at = NOW() WHERE post_id = ?");
    $update_stmt->bind_param("ssssi", $title, $slug, $content, $status, $post_id);

    if ($update_stmt->execute()) {
        echo "<div class='alert alert-success'>Post updated successfully! <a href='blog-management.php'>Go back</a></div>";
        // Refresh post details
        $stmt->execute();
        $post = $stmt->get_result()->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Error updating post. Please try again.</div>";
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Blog Post</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item"><a href="blog-management.php">Blog Management</a></li>
        <li class="breadcrumb-item active">Edit Post</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Blog Post</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" value="<?= htmlspecialchars($post['slug']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5"><?= htmlspecialchars($post['content']) ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="Draft" <?= $post['status'] == 'Draft' ? 'selected' : '' ?>>Draft</option>
              <option value="Published" <?= $post['status'] == 'Published' ? 'selected' : '' ?>>Published</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Update Post</button>
          <a href="blog-management.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
