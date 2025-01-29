<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Website Pages</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">CMS Pages</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Pages</h5>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Title</th><th>Slug</th><th>Status</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- SELECT * FROM cms_pages -->
            <tr>
              <td>1</td>
              <td>About Us</td>
              <td>about-us</td>
              <td>Published</td>
              <td><button class="btn btn-sm btn-primary">Edit</button></td>
            </tr>
          </tbody>
        </table>

        <h5 class="mt-4">Add New Page</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Page Title</label>
            <input type="text" class="form-control" name="page_title" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Slug</label>
            <input type="text" class="form-control" name="page_slug" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Create Page</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
