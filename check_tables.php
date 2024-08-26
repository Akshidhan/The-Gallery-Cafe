<?php
include 'connect.php';
session_start();

if (isset($_GET['date'])) {
    $date = $_GET['date'];

    // Prepare and execute the query to get booked tables
    $query = "SELECT tables FROM reservations WHERE date = ? AND confirmation != 'cancelled'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookedTables = [];
    while ($row = $result->fetch_assoc()) {
        $bookedTables[] = $row['tables'];
    }

    $stmt->close();
    $conn->close();

    // Return the booked tables as JSON
    header('Content-Type: application/json');
    echo json_encode(['bookedTables' => $bookedTables]);
} else {
    echo json_encode(['error' => 'No date provided']);
}
?>
