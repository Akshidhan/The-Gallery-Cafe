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
    <section id="contact-us">
      <h2>Contact Us</h2>
      <div class="first-section">
        <div class="contactForm">
          <form id="contact-form" action="contactForm.php" method="post">
            <div class="inputSection">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required>
            </div>
            
            <div class="inputSection">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>  
            </div>
            
            <div class="inputSection">
              <label for="phone">Phone:</label>
              <input type="tel" id="phone" name="phone" required>  
            </div>
            
            <div class="inputSection">
              <label for="message">Message:</label>
              <textarea id="message" name="message" required></textarea>  
            </div>
            
            <div class="inputSection">
              <button type="submit" class="submitButton">Send</button>
            </div>
            
          </form>
        </div>

        <div class="contactInfo">
          <h3>Contact Information</h3>
          <p>Phone: (123) 456-7890</p>
          <p>Email: contact@gallerycafe.com</p>
          <p>Follow us on social media:</p>
          <p>
            <a href="#">Facebook</a> |
            <a href="#">Twitter</a> |
            <a href="#">Instagram</a>
          </p>
          <h3>Opening Hours</h3>
          <p>Monday - Friday: 8:00 AM - 10:00 PM</p>
          <p>Saturday - Sunday: 9:00 AM - 11:00 PM</p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2024 The Gallery Cafe. All rights reserved.</p>
  </footer>

  <script>
    document.getElementById('contact-form').addEventListener('submit', function(event) {
      event.preventDefault();
      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const phone = document.getElementById('phone').value;
      const message = document.getElementById('message').value;

      if (!name || !email || !phone || !message) {
        alert('Please fill in all fields.');
        return;
      }

      // Process contact form submission (e.g., send to server, display confirmation)
      alert('Message sent successfully!');
    });
  </script>
</body>
</html>
