<?php
    include 'connect.php';
    session_start();

    $username = $_SESSION["username"];

    if ($username) {
        $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);

        if ($stmt->execute()) {
            session_unset();
            session_destroy();
            header("Location: index.php?message=Account deleted successfully");
            exit();
        } else {
            header("Location: profile.php?error=Could not delete account");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
