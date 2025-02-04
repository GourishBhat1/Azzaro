<?php
require_once 'connection.php';

$bookings = [];
$query = "SELECT b.booking_id, r.room_name, b.check_in, b.check_out, b.status 
          FROM bookings b
          JOIN rooms r ON b.room_id = r.room_id";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $color = ($row['status'] == 'Confirmed') ? '#28a745' : (($row['status'] == 'Cancelled') ? '#dc3545' : '#ffc107');

    $bookings[] = [
        'id'    => $row['booking_id'],
        'title' => $row['room_name'] . " (" . $row['status'] . ")",
        'start' => $row['check_in'],
        'end'   => date('Y-m-d', strtotime($row['check_out'] . ' +1 day')),
        'color' => $color
    ];
}

header('Content-Type: application/json');
echo json_encode($bookings);
?>
