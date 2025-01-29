<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Gallery Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Gallery</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Images</h5>
        <!-- Example: Show existing images in a grid/list -->
        <div class="row">
          <div class="col-md-3 mb-3">
            <img src="uploads/gallery1.jpg" class="img-thumbnail" alt="Gallery Image">
            <button class="btn btn-sm btn-danger mt-2">Delete</button>
          </div>
          <!-- More images... -->
        </div>

        <!-- Form to upload new images -->
        <h5 class="mt-4">Upload New Images</h5>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Select Images</label>
            <input type="file" class="form-control" name="gallery_images[]" multiple>
          </div>
          <button type="submit" class="btn btn-success">Upload</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
