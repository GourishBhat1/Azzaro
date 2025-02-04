<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php require_once 'connection.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Customer Inquiries</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Inquiries</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">All Inquiries</h5>

        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Status</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $stmt = $conn->prepare("SELECT * FROM inquiries ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['inquiry_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['subject']}</td>
                        <td>{$row['status']}</td>
                        <td>
                          <a href='view-inquiry.php?id={$row['inquiry_id']}' class='btn btn-sm btn-primary'>View</a>
                          <a href='delete-inquiry.php?id={$row['inquiry_id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                        </td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='6' class='text-center'>No inquiries found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
