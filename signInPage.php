<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>The Gallery Cafe</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="loginStyles.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+HR:wght@100..400&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
            session_start();
            if (isset($_SESSION['userId'])) {
                if($_SESSION['userType'] == 'customer'){
                    header("Location: userProfile.php");
                    exit();
                }
                else if($_SESSION['userType'] == 'admin'){
                    header("Location: adminPanel.php.php");
                    exit();
                }
                else if($_SESSION['userType'] == 'staff'){
                    header("Location: staffProfile.php");
                    exit();
                }
            }
        ?>
        <div class="loginLogo"><a href="index.php"><div class="logo">
            <img src="assets/logo-white.png" alt="logo">
            <p>The<br>gallery<br>Cafe</p>
        </div></a></div>
        <div class="container">
            <div class="loginForm">
                <h2>Login</h2>
                <form class="login" action="signIn.php" method="post">
                    <div class="usernametf">
                        <label for="username">Username</label><br>
                        <input type="text" id="name" name="username" required>
                    </div>
                    <div class="passwordtf">
                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" required><br>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="showPass"> Show Password
                    </div>
                    <div class="loginbtn">
                        <button type="submit" id="loginbtn" name="signIn">Login</button>
                    </div>
                </form>
                <a href="signUp.html" id="signUp">Create a new account</a>
            </div>
        </div>
        <script src="loginScript.js"></script>
    </body>
    </html>