<?php include 'header.php'; ?>
<?php include 'sidebar.php'; ?>
<?php require_once 'connection.php'; ?>

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
        
        <!-- FullCalendar Integration -->
        <div id="bookingCalendar"></div>
      </div>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>

<!-- FullCalendar CDN -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/locales-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

<!-- Fetch Bookings & Load Calendar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('bookingCalendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'fetch-bookings.php', // Fetch bookings from PHP script
        eventClick: function(info) {
            window.location.href = 'view-booking.php?id=' + info.event.id;
        }
    });
    calendar.render();
});
</script>
