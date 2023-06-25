<?php
require 'config.php';
$result = mysqli_query($conn, "SELECT * FROM movie");

?>
<html lang="en" dir="ltr">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css/style.css" rel="stylesheet" />
      <script src="https://kit.fontawesome.com/67120f1b6a.js" crossorigin="anonymous"></script>
      <title>INF Cinema</title>
  </head>
    <body>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <div class="logo">
                <i class="fa-solid fa-infinity"></i><br>
                <p>INF CINEMA</p>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="#contact-us">Contact Us</a></li>
                <li><a class="active" href="movies.php">movies</a></li>
                <li><a href="login.php">Log in</a></li>
            </ul>
        </nav>
        <div class="section">
            <div class="movies-container">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    

                <?php
                } ?>
            </div>
        </div>
    </body>
  <script src="js/app.js"></script>
  <footer>
      <div class="copyright">
          <p>
              &copy; 2022, Null Cinema. All Right Reserved
          </p>
      </div>
  </footer>
</html>
