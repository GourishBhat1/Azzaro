<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Admin Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Admin Management</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Manage Admin Users</h5>
        <!-- Table listing all admins from the 'users' table where role != 'customer' -->
        <!-- Example Table -->
        <table class="table">
          <thead>
            <tr>
              <th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop through admins -->
            <tr>
              <td>1</td>
              <td>admin</td>
              <td>admin@example.com</td>
              <td>admin</td>
              <td><button class="btn btn-sm btn-primary">Edit</button> <button class="btn btn-sm btn-danger">Delete</button></td>
            </tr>
          </tbody>
        </table>
        
        <!-- Form to add new admin user -->
        <h5 class="mt-4">Add New Admin</h5>
        <form method="POST" action="">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" name="username" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required />
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-select" name="role">
              <option value="admin">Admin</option>
              <option value="manager">Manager</option>
              <option value="editor">Editor</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success">Add Admin</button>
        </form>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
