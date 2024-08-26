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
  <?php
      session_start();
      
      if (!isset($_SESSION['userID']) || $_SESSION['userType'] != 'customer') {
          header("Location: signInPage.php");
          exit();
      }
      include 'connect.php';

      $userID = $_SESSION['userID'];

      $bookedTables = [];
      $query = "SELECT tables FROM reservations WHERE confirmation != 'cancelled'";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
          $bookedTables[] = $row['tables'];
      }
  ?>
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
    <h1>Table Reservation</h1>
    
    <div id="dateSelection">
      <label for="reservationDate">Select Date:</label>
      <input type="date" id="reservationDate" name="reservationDate" required>
    </div>
    
    <div id="reservationContent" style="display:none">
      <div id="tableLayout">
              <?php
                  $tables = [
                      1 => ['chairs' => 4],
                      2 => ['chairs' => 6],
                      3 => ['chairs' => 2],
                      4 => ['chairs' => 8],
                      5 => ['chairs' => 3],
                      6 => ['chairs' => 5],
                  ];

                  foreach ($tables as $tableId => $tableInfo) {
                      echo '<div class="table" id="table' . $tableId . '">';
                      echo '<p>Table ' . $tableId . '<br>(' . $tableInfo['chairs'] . ' chairs)</p>';
                      echo '</div>';
                  }
              ?>
      </div>
      <div id="selectedTable"></div>
      <div id="selectedDishes"></div>
      <p id="total"></p>
      <div id="menuSelection">
          <h3>Select Dishes</h3>
          <div id="menuItems" class="cuisine">
              <?php
                  $query = "SELECT * FROM menu";
                  $result = mysqli_query($conn, $query);
                  while($row = mysqli_fetch_assoc($result)) {
                      echo '<div class="menuItem menuItem2">';
                      echo '<img src="' . $row['imgsrc'] . '" alt="' . $row['name'] . '">';
                      echo '<h4>' . $row['name'] . '</h4>';
                      echo '<p>' . $row['description'] . '</p>';
                      echo '<p>Price: ' . $row['price'] . '</p>';
                      echo '<button class="select" onclick="selectDish(\'' . $row['name'] . '\', ' . $row['price'] . ')">Select</button>';
                      echo '</div>';
                  }
              ?>
          </div>
      </div>
      <button id="reserveBtn">Reserve Now</button>
    </div>
    
  </main>
  <script src="reservations.js" data-user-id="<?php echo $_SESSION['userID']; ?>"></script>
</body>
</html>