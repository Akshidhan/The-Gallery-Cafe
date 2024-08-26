<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Gallery Cafe</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+HR:wght@100..400&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div>
                <a href="index.php"><div class="logo">
                    <img src="assets/logo-white.png" alt="logo">
                    <p>The<br>gallery<br>Cafe</p>
                </div></a>
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
                        session_start();
                        if(isset($_SESSION['username'])) {
                            echo '<a href="userProfile.php"><p>'.$_SESSION['username'].'</p></a>';
                        } else {
                            echo '<a href="signInPage.php"><p>Sign In</p></a>';
                        }
                    ?>
                    <img src="assets/user.svg" alt="userIcon">
                </div>
            </div>
        </header>
        <main class="index">
            <div class="hero">
                <div class="hero-text">
                    <h1>Welcome to The Gallery Cafe</h1>
                    <p>Experience the best dining in town</p>
                    <div class="call-to-actions">
                        <a href="reservation.php" class="cta">Reserve a Table</a>
                        <a href="menu.php" class="cta">View Menu</a>
                    </div>
                </div>
            </div>

            <section id="types-of-meals">
                <h2>Types of Meals</h2>
                <div class="meal-category">
                    <img src="assets/breakfast.webp" alt="Breakfast">
                    <div class="text-content">
                        <h3>Breakfast</h3>
                        <p>Start your day with our delicious breakfast options. From classic pancakes and waffles to healthy smoothies and oatmeal bowls, we have something for everyone.</p>
                    </div>
                </div>
                <div class="meal-category">
                    <img src="assets/lunch.jpg" alt="Lunch">
                    <div class="text-content">
                        <h3>Lunch</h3>
                        <p>Enjoy a variety of lunch dishes, including hearty sandwiches, fresh salads, and savory soups. Perfect for a midday break or a casual lunch with friends.</p>
                    </div>
                </div>
                <div class="meal-category">
                    <img src="assets/dinner.webp" alt="Dinner">
                    <div class="text-content">
                        <h3>Dinner</h3>
                        <p>Experience our exquisite dinner menu featuring gourmet entrees, delightful appetizers, and decadent desserts. Ideal for a romantic evening or a family gathering.</p>
                    </div>
                </div>
                <div class="meal-category">
                    <img src="assets/dessert.jpg" alt="Desserts">
                    <div class="text-content">
                        <h3>Desserts</h3>
                        <p>Indulge in our sweet treats, including cakes, pastries, and ice creams. Our desserts are the perfect way to end your meal on a high note.</p>
                    </div>
                </div>
                <div class="meal-category">
                    <img src="assets/beverages.jpg" alt="Beverages">
                    <div class="text-content">
                        <h3>Beverages</h3>
                        <p>Quench your thirst with our wide selection of beverages. From freshly brewed coffee and tea to refreshing juices and cocktails, we have it all.</p>
                    </div>
                </div>
            </section>
            <section id="promotions">
                <h2>Promotions</h2>
            </section>
    </main>

    <footer>
        <p>&copy; 2024 The Gallery Cafe. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
