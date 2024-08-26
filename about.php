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
                    echo '<a href="signIn.php"><p>Sign In</p></a>';
                    }
                ?>
                <img src="assets/user.svg" alt="userIcon">
            </div>
        </div>
    </header>
    <main>
        <section id="about-us">
            <h2>About Us</h2>
            <div class="content">
                <p id="story"><span id="mainText">Our Story:</span> The Gallery Cafe was established in 2018 with a mission to provide a unique dining experience...</p>
                <h3 id="team">Meet the Team</h3>
                <div class="teamMembers">
                    <div class="team-member">
                        <img src="assets/team-member-1.png" alt="Team Member 1">
                        <p>John&nbsp;Doe</p><span>Chef</span>
                    </div>
                    <div class="team-member">
                        <img src="assets/team-member-2.png" alt="Team Member 2">
                        <p>Jane&nbsp;Smith</p><span>Manager</span>
                    </div>
                    <div class="team-member">
                        <img src="assets/team-member-3.png" alt="Team Member 3">
                        <p>John&nbsp;Brown</p><span>Pastry&nbsp;Chef</span>
                    </div>
                    <div class="team-member">
                        <img src="assets/team-member-4.png" alt="Team Member 4">
                        <p>Michael&nbsp;Green</p><span>Barista</span>
                    </div>
                    <div class="team-member">
                        <img src="assets/team-member-5.png" alt="Team Member 5">
                        <p>Alexander&nbsp;White</p><span>Event&nbsp;coordinator</span>
                    </div>
                </div>
                <div class="gallery">
                    <h3 id="gallery">Gallery</h3>
                    <div class="galleryPics">
                        <img src="assets/gallery-1.jpg" alt="Gallery Image 1" class="gallery-image">
                        <img src="assets/gallery-2.jpg" alt="Gallery Image 2" class="gallery-image">
                        <img src="assets/gallery-3.jpg" alt="Gallery Image 3" class="gallery-image">
                        <img src="assets/gallery-4.jpg" alt="Gallery Image 4" class="gallery-image">
                        <img src="assets/gallery-5.jpg" alt="Gallery Image 5" class="gallery-image">
                        <img src="assets/gallery-6.jpg" alt="Gallery Image 6" class="gallery-image">
                        <img src="assets/gallery-7.jpg" alt="Gallery Image 7" class="gallery-image">
                    </div>

                    <div id="imageModal" class="modal">
                        <span class="close">&times;</span>
                        <img class="modal-content" id="modalImage">
                    </div>
                </div>
            </div>
            
        </section>
    </main>

  <footer>
    <p>&copy; 2024 The Gallery Cafe. All rights reserved.</p>
  </footer>

  <script>
    var modal = document.getElementById("imageModal");

    var modalImg = document.getElementById("modalImage");

    var images = document.getElementsByClassName("gallery-image");
    for (var i = 0; i < images.length; i++) {
        images[i].onclick = function() {
            debugger;
            modal.style.display = "block";
            modalImg.src = this.src;
        }
    }

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    modal.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</body>
</html>
