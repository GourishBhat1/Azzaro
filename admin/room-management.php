<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Room Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Rooms</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Rooms</h5>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Room Name</th><th>Category</th><th>Price</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop: SELECT * FROM rooms -->
            <tr>
              <td>1</td>
              <td>Deluxe Sea View</td>
              <td>Deluxe</td>
              <td>$200</td>
              <td>
                <button class="btn btn-sm btn-primary">Edit</button>
                <button class="btn btn-sm btn-danger">Delete</button>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Form to add new room -->
        <h5 class="mt-4">Add New Room</h5>
        <form method="POST" action="" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Room Name</label>
            <input type="text" class="form-control" name="room_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
              <!-- Loop categories -->
              <option value="1">Deluxe</option>
              <option value="2">Suite</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload Images</label>
            <input type="file" name="room_images[]" multiple class="form-control">
          </div>
          <button type="submit" class="btn btn-success">Add Room</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
