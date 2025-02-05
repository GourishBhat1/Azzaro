<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php require_once 'connection.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Blog Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Blog Management</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Blog Posts</h5>

        <?php
        // Handle Post Creation
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
            $title = trim($_POST['title']);
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['title'])));
            $content = trim($_POST['content']);
            $status = $_POST['status'] ?? 'Draft';
            $author = "Admin"; // Defaulting to admin (can be changed later)

            // Insert into DB
            $stmt = $conn->prepare("INSERT INTO blog_posts (title, slug, content, author, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $title, $slug, $content, $author, $status);
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Blog post added successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error adding post.</div>";
            }
        }

        // Handle Deletion
        if (isset($_GET['delete'])) {
            $postId = intval($_GET['delete']);
            $conn->query("DELETE FROM blog_posts WHERE post_id = $postId");
            echo "<div class='alert alert-danger'>Post deleted successfully!</div>";
        }

        // Fetch All Blog Posts
        $result = $conn->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
        ?>

        <!-- Blog Post Table -->
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Title</th><th>Slug</th><th>Author</th><th>Status</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['post_id']) ?></td>
              <td><?= htmlspecialchars($row['title']) ?></td>
              <td><?= htmlspecialchars($row['slug']) ?></td>
              <td><?= htmlspecialchars($row['author']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <a href="edit-blog.php?id=<?= $row['post_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="?delete=<?= $row['post_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

        <!-- Form: Add New Blog Post -->
        <h5 class="mt-4">Add New Post</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="Draft">Draft</option>
              <option value="Published">Published</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Create Post</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
