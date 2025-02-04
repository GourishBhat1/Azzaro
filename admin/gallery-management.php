<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php require_once 'connection.php'; ?>

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

        <?php
        // Handle Image Upload
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['gallery_images'])) {
            $uploadDir = 'uploads/gallery/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $category = $_POST['category'] ?? 'bedroom'; // Default category

            foreach ($_FILES['gallery_images']['tmp_name'] as $key => $tmpName) {
                $fileName = basename($_FILES['gallery_images']['name'][$key]);
                $targetPath = $uploadDir . time() . '-' . $fileName;

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $stmt = $conn->prepare("INSERT INTO gallery (image_path, category) VALUES (?, ?)");
                    $stmt->bind_param("ss", $targetPath, $category);
                    $stmt->execute();
                }
            }
            echo "<div class='alert alert-success'>Images uploaded successfully!</div>";
        }

        // Handle Image Deletion
        if (isset($_GET['delete'])) {
            $imageId = intval($_GET['delete']);
            $imageQuery = $conn->query("SELECT image_path FROM gallery WHERE id = $imageId");
            $image = $imageQuery->fetch_assoc();

            if ($image) {
                unlink($image['image_path']); // Delete file
                $conn->query("DELETE FROM gallery WHERE id = $imageId");
                echo "<div class='alert alert-danger'>Image deleted successfully!</div>";
            }
        }

        // Fetch Existing Images
        $result = $conn->query("SELECT * FROM gallery ORDER BY id DESC");
        ?>

        <!-- Image Categories Filter -->
        <h5>Filter by Category</h5>
        <select class="form-select mb-3" id="filter-category">
          <option value="all">All</option>
          <option value="bedroom">Bedroom</option>
          <option value="outdoor">Outdoor</option>
          <option value="pool">Pool</option>
          <option value="banquet">Banquet</option>
          <option value="restaurant">Restaurant</option>
          <option value="reception">Reception</option>
          <option value="play_area">Play Area</option>
          <option value="washroom">Washroom</option>
        </select>

        <div class="row" id="gallery-container">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-3 mb-3 gallery-item" data-category="<?= htmlspecialchars($row['category']) ?>">
              <img src="<?= htmlspecialchars($row['image_path']) ?>" class="img-thumbnail" alt="Gallery Image">
              <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger mt-2">Delete</a>
            </div>
          <?php endwhile; ?>
        </div>

        <!-- Form to upload new images -->
        <h5 class="mt-4">Upload New Images</h5>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Select Category</label>
            <select name="category" class="form-select">
              <option value="bedroom">Bedroom</option>
              <option value="outdoor">Outdoor</option>
              <option value="pool">Pool</option>
              <option value="banquet">Banquet</option>
              <option value="restaurant">Restaurant</option>
              <option value="reception">Reception</option>
              <option value="play_area">Play Area</option>
              <option value="washroom">Washroom</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Select Images</label>
            <input type="file" class="form-control" name="gallery_images[]" multiple required>
          </div>
          <button type="submit" class="btn btn-success">Upload</button>
        </form>

      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>

<script>
document.getElementById('filter-category').addEventListener('change', function() {
  let selectedCategory = this.value;
  document.querySelectorAll('.gallery-item').forEach(item => {
    item.style.display = (selectedCategory === 'all' || item.dataset.category === selectedCategory) ? 'block' : 'none';
  });
});
</script>
