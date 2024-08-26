<?php
    include 'connect.php';

    header('Content-Type: application/json');

    $query = "SELECT dishID, name, description, price, imgsrc FROM menu";
    $result = mysqli_query($conn, $query);

    $menuItems = array();
    while($row = mysqli_fetch_assoc($result)) {
        $menuItems[] = $row;
    }

    echo json_encode($menuItems);