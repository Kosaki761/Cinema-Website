<?php
require 'config.php';
$result = mysqli_query($conn, "SELECT DISTINCT movie_show.movieid,movie.*, location.* 
                FROM movie_show JOIN movie ON movie_show.movieid = movie.movieid 
                JOIN location ON movie_show.hallid = location.hallid");
// $result = mysqli_query($conn, "SELECT * From movie_show, movie, location WHERE movie_show.movieid = movie.movieid and movie_show.hallid = location.hallid");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css/style.css" rel="stylesheet" />
      <script src="https://kit.fontawesome.com/67120f1b6a.js" crossorigin="anonymous"></script>
      <title>INF Cinema</title>
  </head>
  <body id="div1">
    <!-- <h1>Welcome <?php echo $row["name"]; ?></h1> -->
    <!-- <a href="logout.php">Logout</a> -->
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-bars"></i>
        </label>
        <div class="logo">
            <i class="fa-solid fa-infinity"></i><br>
            <p>INF CINEMA</p>
        </div>
        
        <?php require 'navigation.php'; ?>
    </nav>
    <div class="content-container">
        <div class="slider">
        </div>
        <div class="section">
            <div class="movie-list-container">
                <h1 class="movie-list-title">NOW SHOWING</h1>
                <div class="movie-list-wrapper">
                    <div class="movie-list">
                        <!-- LOAD IMAGE FROM DATABASE -->
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="movie-list-item">
                            <img class="movie-list-item-img" src=".\admin\images\<?php echo $row['image']?>" alt="movie-image">
                            <span class="movie-list-item-title"><?php echo $row['moviename'] ?></span>
                            <a class="movie-list-item-button" href="book.php?id=<?php echo $row['movieid']; ?>&hall_id=<?php echo $row['hallid']; ?>" >WATCH</a>
                            </div>
                        <?php
                        } ?>
                        
                    </div>
                    <i class="fa-solid fa-angle-right arrow"></i>
                </div>
                <a class="show-more" href="movies.php">Show more ></a>
            </div>
        </div>
        <div class="section" id="about-us">
            <div class="about-us-container">
                <h2>ABOUT US</h2>
                <p>INF CINEMA Sdn Bhd - In less than a decade, we,ve entertained countless movigoers with memories of a
                    special day out.
                    From the latest blockbusters to intimate dramas, with a dash of documentaries, sports and culture
                    also in the mix,
                    INF's diverse range of entertainment means there's something for everyone. All cinemas are fully
                    equipped with Dolby
                    Surround 7.1, ensuring that the audience is provided with a fantastic and enjoyable movie
                    experience.
                    INF is also dedicated to screening multi-lingual movies of different genres to satisfy the interests
                    of its wide range of customers.
                </p>
            </div>
        </div>
        <div class="section" id="contact-us">
            <div class="contact-us-container">
                <div class="contact-us-content">
                    <div class="left-side">
                        <div class="address details">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="topic">Address</div>
                            <div class="text-one">KERAWANG KUALA TERENGGANU</div>
                            <div class="text-two">21080 KUALA TERENGGANU, TERENGGANU</div>
                        </div>
                        <div class="phone details">
                            <i class="fas fa-phone-alt"></i>
                            <div class="topic">Phone</div>
                            <div class="text-one">+6011 2606 2216</div>
                            <div class="text-two">+6011 3919 7571</div>
                        </div>
                        <div class="email details">
                            <i class="fas fa-envelope"></i>
                            <div class="topic">Email</div>
                            <div class="text-one">infcinema@gmail.com</div>
                            <div class="text-two">info.infcinema@gmail.com</div>
                        </div>
                    </div>
                    <div class="right-side">
                        <div class="topic-text">Send us your enquiry</div>

                        <form action="#">
                            <div class="input-box">
                                <input type="text" placeholder="Enter your name" required>
                            </div>
                            <div class="input-box">
                                <input type="text" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box message-box">
                                <textarea placeholder="Enter your message" required></textarea>
                            </div>
                            <div class="button">
                                <input type="button" value="Send Now">
                            </div>
                        </form>
                    </div>
                </div>
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
