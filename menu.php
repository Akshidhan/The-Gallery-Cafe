<?php
    include 'connect.php';
    session_start();

    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);

    $menuItems = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $menuItems[$row['cuisine']][] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Gallery Cafe</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playwrite+HR:wght@100..400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+HR:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div>
        <a href="index.php">
            <div class="logo">
                <img src="assets/logo-white.png" alt="logo">
                <p>The<br>gallery<br>Cafe</p>
            </div>
        </a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reservations.php">Reservations</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>  
            </ul>
        </nav>
        <div class="user">
            <?php
            if(isset($_SESSION['username'])) {
                echo '<a href="userProfile.php"><p>'.$_SESSION['username'].'</p></a>';
            } else {
                echo '<a href="signIn.php"><p>Sign In</p></a>';
            }
            ?>
            <img src="assets/user.svg" alt="userIcon">
        </div>
    </div>
</header>

<main>
    <section id="menu">
        <div class="head">
            <p>Our Menu</p>
            <div class="search">
                <input type="text" id="search-bar" placeholder="Search by cuisine type">
                <button id="search-button">search</button>
            </div>
        </div>
        <div id="categories">
            <button class="categoriesButton" id="breakfast">Breakfast</button>
            <button class="categoriesButton" id="lunch">Lunch</button>
            <button class="categoriesButton" id="dinner">Dinner</button>
            <button class="categoriesButton" id="beverages">Beverages</button>
        </div>
        <div id="searchResult"></div>
        <div id="selection"></div>
        <div id="menu-items">
            <?php 
            foreach ($menuItems as $cuisine => $items) {
                echo "<div>";
                echo "<h4>" . htmlspecialchars($cuisine) . "</h4>";
                echo "<div id='" . strtolower(str_replace(' ', '', $cuisine)) . "' class='cuisine'>";
                foreach ($items as $item) {
                    echo "<div class='menuItem'>";
                    echo "<img src='" . htmlspecialchars($item['imgsrc']) . "' alt='" . htmlspecialchars($item['name']) . "'>";
                    echo "<div class='title'>" . htmlspecialchars($item['name']) . "</div>";
                    echo "<div class='price'> Rs. " . htmlspecialchars($item['price']) . "</div>";
                    echo "<div class='description'>" . htmlspecialchars($item['description']) . "</div>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </section>
</main>

<footer id="menuFooter">
    <p>&copy; 2024 The Gallery Cafe. All rights reserved.</p>
</footer>
<script src="script.js"></script>
</body>
</html>
