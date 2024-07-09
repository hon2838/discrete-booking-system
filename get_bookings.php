<?php
include 'db.php';

$query = "SELECT * FROM bookings";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['vehicleId']}</td>
                <td>{$row['customerName']}</td>
                <td>{$row['bookingDate']}</td>
                <td>{$row['returnDate']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No bookings found</td></tr>";
}

$conn->close();
?>
