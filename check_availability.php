<?php
    include 'connect.php';

    $date = $_GET['date'];

    $query = "SELECT tables FROM reservations WHERE date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookedTables = [];
    while ($row = $result->fetch_assoc()) {
        $bookedTables[] = $row['tables'];
    }

    echo json_encode(['bookedTables' => $bookedTables]);