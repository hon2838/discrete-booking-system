<?php
include 'db.php';

$vehicleId = $_POST['vehicleId'];
$customerName = $_POST['customerName'];
$bookingDate = $_POST['bookingDate'];
$returnDate = $_POST['returnDate'];

// Check if the vehicle is already booked for the selected dates
$query = "SELECT * FROM bookings WHERE vehicleId = ? AND (bookingDate <= ? AND returnDate >= ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $vehicleId, $returnDate, $bookingDate);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "The vehicle is not available for the selected dates.";
} else {
    // Insert the booking into the database
    $insertQuery = "INSERT INTO bookings (vehicleId, customerName, bookingDate, returnDate) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("isss", $vehicleId, $customerName, $bookingDate, $returnDate);
    if ($stmt->execute()) {
        echo "Booking confirmed.";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
