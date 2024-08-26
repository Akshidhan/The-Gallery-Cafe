<?php

    include 'connect.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $insertQuery = "INSERT INTO contactUs (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param('ssss', $name, $email, $phone, $message);

    if ($stmt->execute()) {
        header("Location: contact.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

?>