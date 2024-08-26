<?php

    include 'connect.php';
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.php');
        exit();
    }

    $userId = $_SESSION['userID'];
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT reservationID, tables, dishes, time, date, confirmation FROM reservations WHERE userId = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $reservations = [];
    while ($row = $result->fetch_assoc()) {
        $reservations[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+HR:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
    <div id="changePWDiv">
        <form id="passwordForm" action="changePass.php" method="post">
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" required><br>
            <label for="confirmPass">Confirm Password: </label>
            <input type="password" id="confirmPass" name="confirmPass" required><br>
            <input type="submit" value="Change" id="changePass">
        </form>
    </div>
    
    <div id="delAccConfirmation">
        <div class="content">
            <p>Are you sure?</p>
            <div class="buttons">
                <button onclick="window.location.href='deleteAcc.php'">Yes</button>
                <button id="noButton">No</button>
            </div>
        </div>
    </div>
    
    <a href="index.php"><div class="logo">
        <img src="assets/logo-white.png" alt="logo">
        <p>The<br>gallery<br>Cafe</p>
    </div></a>
    <div class="container">
        <div class="info">
            <h1>Profile</h1>
            <section class="userImage">
                <img src="assets/user.svg" alt="">
            </section>
            <section class="username">
                <p>Username:</p>
                <span><?php echo htmlspecialchars($username); ?></span>
            </section> 
            <section class="options">
                <button class="optionButton" id="changePW">Change password</button>
                <button class="optionButton" id="logOut" onclick="window.location.href='logout.php'">Logout</button>
                <button class="optionButton" id="deleteAcc">Delete Account</button>
                <?php
                if($_SESSION['userType'] == 'admin'){
                    echo '<a href="adminPanel.php"><button class="optionButton" id="adminPanel">Admin Panel</button></a>';
                }
                else if($_SESSION['userType'] == 'staff'){
                    echo `<a href="staff.php"><button class="optionButton" id="adminPanel">Staff Panel</button></a>`;
                }
                ?>
            </section>
        </div>
        <?php if($_SESSION['userType'] == 'customer'): ?>
            <div class="history">
                <h1>History</h1>
                <table>
                    <tr class="header">
                        <th>Reservation ID</th>
                        <th>Tables</th>
                        <th>Dishes</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Confirmation</th>
                    </tr>
                        <?php if (count($reservations) > 0): ?>
                            <?php foreach ($reservations as $reservation): ?>
                                <tr class="data">
                                    <td><?php echo htmlspecialchars($reservation['reservationID']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['tables']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['dishes']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['time']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['date']); ?></td>
                                    <td><?php echo htmlspecialchars($reservation['confirmation']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="data">
                                <td colspan="6">No reservations found.</td>
                            </tr>
                        <?php endif; ?>
                </table>
            </div>
        <?php endif; ?>
    
    <script src="profile.js"></script>
</body>
</html>
