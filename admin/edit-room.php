<?php
include 'header.php';
include 'sidebar.php';
require_once 'connection.php';

if (!isset($_GET['id'])) {
    header("Location: room-management.php");
    exit();
}

$room_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM rooms WHERE room_id = ?");
$stmt->bind_param("i", $room_id);
$stmt->execute();
$room = $stmt->get_result()->fetch_assoc();

// Handle room update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_room'])) {
    $room_name = trim($_POST['room_name']);
    $category_id = intval($_POST['category_id']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);

    if (!empty($room_name)) {
        $update_stmt = $conn->prepare("UPDATE rooms SET room_name = ?, category_id = ?, price = ?, description = ? WHERE room_id = ?");
        $update_stmt->bind_param("sidsi", $room_name, $category_id, $price, $description, $room_id);
        if ($update_stmt->execute()) {
            echo "<script>alert('Room updated successfully'); window.location.href='room-management.php';</script>";
        } else {
            echo "<script>alert('Error updating room');</script>";
        }
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
        <form method="POST">
          <div class="mb-3">
            <label class="form-label">Room Name</label>
            <input type="text" class="form-control" name="room_name" value="<?= htmlspecialchars($room['room_name']) ?>" required>
          </div>
          <button type="submit" name="update_room" class="btn btn-primary">Update Room</button>
          <a href="room-management.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
