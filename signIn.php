<?php

    include 'connect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['userType'] = $row['userType'];
        $_SESSION['userID'] = $row['userID'];
        
        header('Location: index.php');
        exit();
    } else {
        echo "<script>alert('Not Found, Incorrect Email or Password')</script>";
        //header('Location: signInPage.php');
    }