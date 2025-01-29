<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

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
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Title</th><th>Slug</th><th>Status</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- SELECT * FROM blog_posts -->
            <tr>
              <td>1</td>
              <td>Amazing Azzaro</td>
              <td>amazing-azzaro</td>
              <td>Published</td>
              <td><button class="btn btn-sm btn-primary">Edit</button></td>
            </tr>
          </tbody>
        </table>

        <h5 class="mt-4">Add New Post</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" required>
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
