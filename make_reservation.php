<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableId = $_POST['tableId'];
    $dishes = $_POST['dishes'];  
    $total = $_POST['total'];
    $userId = $_POST['userId'];
    $time = $_POST['time'];
    $date = $_POST['date'];

    if (empty($tableId) || empty($dishes)) {
        echo "Table and dishes are required!";
        exit;
    }

    $query = "INSERT INTO reservations (userId, tables, dishes, time, date, confirmation) VALUES (?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issss", $userId, $tableId, $dishes, $time, $date);

    if ($stmt->execute()) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}