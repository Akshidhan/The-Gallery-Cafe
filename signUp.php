<?php

    include 'connect.php';
     
    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = 'customer';

    if (empty($username) || empty($password)) {
        echo "Username and password are required!";
        exit;
    }

    $checkUsername = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($checkUsername);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username already exists!";
    } else {
        $insertQuery = "INSERT INTO users (username, password, userType) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param('sss', $username, $password, $usertype);

        if ($stmt->execute()) {
            header("Location: signInPage.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }