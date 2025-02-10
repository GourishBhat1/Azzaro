<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// ✅ Validate Room ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: room-management.php");
    exit();
}
$room_id = intval($_GET['id']);

// ✅ Fetch room details
$stmt = $conn->prepare("SELECT * FROM rooms WHERE room_id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();

// ✅ Fetch all categories for dropdown
$categories = $conn->query("SELECT * FROM room_categories ORDER BY category_id ASC");

// ✅ Handle room update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_room'])) {
    $room_name = trim($_POST['room_name']);
    $category_id = intval($_POST['category_id']);
    $price = floatval($_POST['price']);
    $gst_rate = floatval($_POST['gst_rate']);
    $inventory = intval($_POST['inventory']);
    $description = trim($_POST['description']);

    // ✅ Delete old images if new ones are uploaded
    if (!empty($_FILES['room_images']['name'][0])) {
        // Remove old images from the server
        $old_images = json_decode($room['images'], true);
        if (!empty($old_images)) {
            foreach ($old_images as $old_image) {
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
        }

        // Upload new images
        $image_paths = [];
        $upload_dir = 'uploads/rooms/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        foreach ($_FILES['room_images']['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($_FILES['room_images']['name'][$key]);
            $file_path = $upload_dir . time() . "_" . $file_name;
            if (move_uploaded_file($tmp_name, $file_path)) {
                $image_paths[] = $file_path;
            }
        }
        $images_json = !empty($image_paths) ? json_encode($image_paths) : '';
    } else {
        $images_json = $room['images']; // Keep old images if no new ones are uploaded
    }

    // ✅ Update room details
    $update_stmt = $conn->prepare("UPDATE rooms SET room_name = ?, category_id = ?, price = ?, gst_rate = ?, inventory = ?, description = ?, images = ? WHERE room_id = ?");
    $update_stmt->bind_param("siddissi", $room_name, $category_id, $price, $gst_rate, $inventory, $description, $images_json, $room_id);
    
    if ($update_stmt->execute()) {
        echo "<script>alert('Room updated successfully'); window.location.href='room-management.php';</script>";
    } else {
        echo "<script>alert('Error updating room: " . $update_stmt->error . "');</script>";
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Room</h1>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Update Room Details</h5>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Room Name</label>
            <input type="text" class="form-control" name="room_name" value="<?= htmlspecialchars($room['room_name']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
              <?php while ($category = $categories->fetch_assoc()) : ?>
                <option value="<?= $category['category_id'] ?>" <?= ($category['category_id'] == $room['category_id']) ? 'selected' : '' ?>>
                  <?= htmlspecialchars($category['category_name']) ?>
                </option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" value="<?= number_format($room['price'], 2, '.', '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">GST Rate (%)</label>
            <input type="number" step="0.01" class="form-control" name="gst_rate" value="<?= number_format($room['gst_rate'], 2, '.', '') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Available Rooms (Inventory)</label>
            <input type="number" class="form-control" name="inventory" value="<?= intval($room['inventory']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($room['description']) ?></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Current Images</label><br>
            <?php
            $image_list = json_decode($room['images'], true);
            if (!empty($image_list)) {
                foreach ($image_list as $image) {
                    echo '<img src="' . $image . '" width="100" height="100" class="rounded me-2">';
                }
            } else {
                echo "<p>No images uploaded.</p>";
            }
            ?>
          </div>
          <div class="mb-3">
            <label class="form-label">Upload New Images (Replaces Old Ones)</label>
            <input type="file" name="room_images[]" multiple class="form-control">
          </div>
          <button type="submit" name="update_room" class="btn btn-primary">Update Room</button>
          <a href="room-management.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
