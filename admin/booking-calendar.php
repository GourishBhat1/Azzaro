<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Booking Calendar</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
        <li class="breadcrumb-item active">Calendar View</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Calendar</h5>
        <!-- Integrate FullCalendar or any calendar library to display bookings by date/room -->
        <div id="calendarPlaceholder">Calendar goes here.</div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>
