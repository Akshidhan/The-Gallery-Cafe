<?php
    include 'connect.php';

    $sql = "SELECT table_name FROM reservations WHERE status = 'booked'";
    $result = $conn->query($sql);

    $reservedTables = [];
    while ($row = $result->fetch_assoc()) {
        $reservedTables[] = $row['table_name'];
    }

    echo json_encode($reservedTables);