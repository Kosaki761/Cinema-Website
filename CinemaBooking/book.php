<?php
require 'config.php';
if($_SESSION['id'] != true){
    // echo "<script>alert('done');</script>"; 
    header("Location: login.php");   
    // echo "<script>alert('donesadfas');</script>";
    exit();
}

if(isset($_GET['id'],$_GET['hall_id'])){
    $id = $_GET['id'];
    $hallid = $_GET['hall_id'];
    // $result = mysqli_query($conn,"SELECT * FROM movie WHERE movieid=$id");
    $result = mysqli_query($conn, "SELECT movie.*, movie_show.*, location.* 
                FROM movie_show JOIN movie ON movie_show.movieid = movie.movieid 
                JOIN location ON movie_show.hallid = location.hallid WHERE movie_show.movieid=$id AND movie_show.hallid=$hallid ");
    $result3 = mysqli_query($conn, "SELECT DISTINCT movie_show.showdate, movie.*,  location.* 
                FROM movie_show JOIN movie ON movie_show.movieid = movie.movieid 
                JOIN location ON movie_show.hallid = location.hallid WHERE movie_show.movieid=$id AND movie_show.hallid=$hallid ");
    $result2 = mysqli_query($conn, "SELECT DISTINCT movie_show.showtime, movie.*, location.* 
                FROM movie_show JOIN movie ON movie_show.movieid = movie.movieid 
                JOIN location ON movie_show.hallid = location.hallid WHERE movie_show.movieid=$id AND movie_show.hallid=$hallid ");
    $row = mysqli_fetch_assoc($result);

}

?>
<html lang="en" dir="ltr">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css/style.css" rel="stylesheet" />
      <script src="https://kit.fontawesome.com/67120f1b6a.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
                <li><a href="index.php#about-us">About Us</a></li>
                <li><a href="index.php#contact-us">Contact Us</a></li>
                <li><a class="active" href="movies.php">movies</a></li>

                <?php if(!isset($_SESSION['login'])) { echo '<li><a href="login.php">Log in</a></li>'; }
                    else { echo '<li><a href="logout.php">Logout</a></li>'; }
                ?>
            </ul>
        </nav>
        <div class="section">
            <div class="book-container">
                <form class="book-form" action="seat_selection.php" method="POST">
                    <div class="detail-container">
                        <img src=".\admin\images\<?php echo $row['image']?>" alt="movie-image">
                        <div class="details">
                            <h3><strong>Title : </strong><?php echo $row['moviename'] ?></h3>
                            <p><strong>Genre : </strong><?php echo $row['genre'] ?></p> 
                            <p><strong>Description </strong>:<br> <?php echo $row['description'] ?></p> 
                        </div>
                    </div>
                    <div class="row-container">
                        <div class="date-container">
                            <div class="bookdate">
                                <?php while($row=mysqli_fetch_assoc($result3)){ 
                                    $date = date_create($row['showdate'])?>
                                    <div class="movie-date">
                                        <div class="movie-date-group">
                                            <input type="hidden" id="movie_date" value="<?= $row['showdate'] ?>" />
                                            <p class="date-M"><?php echo date_format($date,"M") ?></p>
                                            <p class="date-dn"><?php echo date_format($date,"d") ?></p>
                                            <p class="date-D"><?php echo date_format($date,"D") ?></p>
                                        </div>
                                    </div>
                                <?php
                                }?>
                            </div>
                        </div>
                    </div>
                    <div class="row-container">
                        <div class="movie-time-container">
                            <ul class="movie-time">
                                <?php while($row=mysqli_fetch_array($result2)){ 
                                    $movietime = date_create($row['showtime'])?>
                                    <li class="movietime-Ag">
                                        <input type="hidden" id="movie_time" value="<?= $row['showtime'] ?>" />
                                        <?php echo date_format($movietime,'g:i:A') ?>
                                    </li>
                                <?php
                                }?>
                            </ul>
                        </div>
                    </div>
                    <input type="hidden" name="movie_id" id="movie_id" value="<?= $_GET['id'] ?>" />
                    <input type="hidden" name="hall_id" id="hall_id" value="<?= $_GET['hall_id'] ?>" />
                    <input type="hidden" name="selected_movie_date" id="selected_movie_date" />
                    <input type="hidden" name="selected_movie_time" id="selected_movie_time" />
                    <!-- <button id="proceed">Proceed</button> -->
                    <input type="submit" class="proceed" name="submit" value="Proceed" />
                </form>
            </div>
        </div>
    </body>
  <script>

                
    
  </script>
  <footer>
      <div class="copyright">
          <p>
              &copy; 2022, Null Cinema. All Right Reserved
          </p>
      </div>
  </footer>
</html>
<script>
    var 
        movie_id = $("#movie_id").val(),
        hall_id = $("#hall_id").val(),
        movie_date_value,
        movie_time_value;

    $(function() 
    {
        var $datebox = $('.movie-date-group').click(function() 
        {
            $datebox.not(this).removeClass('current');
            // removing `active` class from item except clicked
            $(this).toggleClass('current');
            //set value back into form input hidden
            movie_date_value = $(this).find('input[type=hidden]').val();
            $("#selected_movie_date").val(movie_date_value);
            //alert('date: ' + movie_date_value);
            // toggling class `active` of clicked item
        });
    });
    $(function() 
    {
        var $timebox = $('.movietime-Ag').click(function() 
        {
            $timebox.not(this).removeClass('current');
            // removing `active` class from item except clicked
            $(this).toggleClass('current');
            //set value back into form input hidden
            movie_time_value = $(this).find('input[type=hidden]').val();
            $("#selected_movie_time").val(movie_time_value);
            //alert('time: ' + movie_time_value);
            // toggling class `active` of clicked item
        });
    });

    $('#proceed').click(function()
    {
        // alert('movie_id: ' + movie_id + '\n' + 'hall_id: ' + hall_id + '\n' + 'date: ' + movie_date_value + "\n" + "time: " + movie_time_value);
        //alert('movie_id: ' + movie_id + '\n' + 'hall_id: ' + hall_id + '\n' + 'date: ' + $("#selected_movie_date").val() + "\n" + "time: " + $("#selected_movie_time").val());
    });

</script>
