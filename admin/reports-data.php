<?php
require_once 'connection.php';

// Fetch revenue report data
$revenueQuery = "SELECT DATE(payment_date) AS date, SUM(amount) AS total_revenue FROM payments GROUP BY DATE(payment_date) ORDER BY date ASC";
$revenueResult = $conn->query($revenueQuery);
$revenueData = [];
while ($row = $revenueResult->fetch_assoc()) {
    $revenueData['dates'][] = $row['date'];
    $revenueData['revenue'][] = (float) $row['total_revenue'];
}

// Fetch booking trends
$bookingQuery = "SELECT room_categories.category_name, COUNT(bookings.booking_id) AS total_bookings FROM bookings 
                 JOIN rooms ON bookings.room_id = rooms.room_id 
                 JOIN room_categories ON rooms.category_id = room_categories.category_id
                 GROUP BY room_categories.category_name";
$bookingResult = $conn->query($bookingQuery);
$bookingData = [];
while ($row = $bookingResult->fetch_assoc()) {
    $bookingData['room_types'][] = $row['category_name'];
    $bookingData['bookings'][] = (int) $row['total_bookings'];
}

// Fetch customer insights
$customerQuery = "SELECT COUNT(*) AS total, 
                  SUM(CASE WHEN created_at > NOW() - INTERVAL 6 MONTH THEN 1 ELSE 0 END) AS new_customers 
                  FROM users WHERE role = 'customer'";
$customerResult = $conn->query($customerQuery);
$customerRow = $customerResult->fetch_assoc();
$customerData = [
    'customers' => [(int) $customerRow['total'] - (int) $customerRow['new_customers'], (int) $customerRow['new_customers']]
];

// Return JSON response
echo json_encode(array_merge($revenueData, $bookingData, $customerData));
?>
