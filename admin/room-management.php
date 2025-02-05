<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

// Handle form submission for adding a new room
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_room'])) {
    $room_name = trim($_POST['room_name']);
    $category_id = intval($_POST['category_id']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);

    // Handle file upload
    $image_paths = [];
    if (!empty($_FILES['room_images']['name'][0])) {
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
    }
    $images_json = !empty($image_paths) ? json_encode($image_paths) : '';

    if (!empty($room_name) && $category_id > 0) {
        $stmt = $conn->prepare("INSERT INTO rooms (room_name, category_id, price, description, images) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("sidss", $room_name, $category_id, $price, $description, $images_json);

        if ($stmt->execute()) {
            echo "<script>alert('Room added successfully'); window.location.href='room-management.php';</script>";
        } else {
            echo "<script>alert('Error adding room: " . $stmt->error . "');</script>";
        }
    }
}

// Handle room deletion
if (isset($_GET['delete'])) {
    $room_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM rooms WHERE room_id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("i", $room_id);
    if ($stmt->execute()) {
        echo "<script>alert('Room deleted successfully'); window.location.href='room-management.php';</script>";
    } else {
        echo "<script>alert('Error deleting room: " . $stmt->error . "');</script>";
    }
}

// Fetch all rooms
$rooms = $conn->query("SELECT r.room_id, r.room_name, c.category_name, r.price, r.images FROM rooms r JOIN room_categories c ON r.category_id = c.category_id ORDER BY r.room_id ASC");

// Fetch all room categories for dropdown
$categories = $conn->query("SELECT * FROM room_categories ORDER BY category_id ASC");
?>

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

        <!-- Room Table -->
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Room Name</th>
              <th>Category</th>
              <th>Price</th>
              <th>Images</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($room = $rooms->fetch_assoc()) : ?>
            <tr>
              <td><?= $room['room_id'] ?></td>
              <td><?= htmlspecialchars($room['room_name']) ?></td>
              <td><?= htmlspecialchars($room['category_name']) ?></td>
              <td>Rs. <?= number_format($room['price'], 2) ?></td>
              <td>
                <?php
                $image_list = json_decode($room['images'], true);
                if (!empty($image_list)) {
                    echo '<img src="' . $image_list[0] . '" width="50" height="50" class="rounded">';
                }
                ?>
              </td>
              <td>
                <a href="edit-room.php?id=<?= $room['room_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="?delete=<?= $room['room_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>

        <!-- Add New Room Form -->
        <h5 class="mt-4">Add New Room</h5>
        <form method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Room Name</label>
            <input type="text" class="form-control" name="room_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
              <?php while ($category = $categories->fetch_assoc()) : ?>
                <option value="<?= $category['category_id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
              <?php endwhile; ?>
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
          <button type="submit" name="add_room" class="btn btn-success">Add Room</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
