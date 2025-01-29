<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

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
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Name</th><th>Description</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- SELECT * FROM room_categories -->
            <tr>
              <td>1</td>
              <td>Deluxe</td>
              <td>High-end room with sea view</td>
              <td>
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>

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
          <button type="submit" class="btn btn-success">Add Category</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
