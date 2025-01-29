<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Testimonials</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Testimonials</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Guest Testimonials</h5>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Author</th><th>Rating</th><th>Content</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- SELECT * FROM testimonials -->
            <tr>
              <td>1</td>
              <td>Jane Smith</td>
              <td>5</td>
              <td>"Awesome experience!"</td>
              <td>
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>

        <h5 class="mt-4">Add Testimonial</h5>
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text" class="form-control" name="author_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Rating (1-5)</label>
            <input type="number" class="form-control" name="rating" min="1" max="5" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Testimonial</label>
            <textarea name="content" class="form-control" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-success">Add Testimonial</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
