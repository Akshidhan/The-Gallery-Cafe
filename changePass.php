<?php
    include 'connect.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }
    $password = $_POST['password'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $password, $username);

    if ($stmt->execute()) {
        header('Location: userProfile.php');
        exit();
    } else {
        echo "Error updating password: " . $conn->error;
    }