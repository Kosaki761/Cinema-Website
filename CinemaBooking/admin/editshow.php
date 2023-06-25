<?php
include '../config.php';

if (!empty($_SESSION["admlogin"])) {
} else {
    header("Location: ../login.php");
}

$selecthall = mysqli_query($conn, "SELECT * FROM location");
$selectmovie = mysqli_query($conn, "SELECT * FROM movie");
$id = $_GET['editshow'];
$record = mysqli_query($conn, "SELECT *
    FROM movie_show,location,movie
    WHERE movie_show.hallid = location.hallid
    AND movie_show.movieid = movie.movieid
    AND movie_show.msid = $id");


$n = mysqli_fetch_assoc($record);
$mvid = $n['movieid'];
$name = $n['moviename'];
$date = $n['showdate'];
$time = $n['showtime'];
$hallid = $n['hallid'];
$hallname = $n['hallname'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a6b5dc18f4.js" crossorigin="anonymous"></script>
    <link href="navbar.css" rel="stylesheet">
    <title>Edit Show</title>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <i class="fa-regular fa-user fa-4x"></i>
            <h2>MyAdmin</h2>
            <ul>
                <li><a href="admin.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="movielist.php"><i class="fa-solid fa-file-video"></i> Movie List</a></li>
                <li><a href="movieshow.php"><i class="fa-solid fa-film"></i> Movie Show</a></li>
                <li><a href="ticket.php"><i class="fa-solid fa-ticket"></i> Ticket</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="add-container">
            <form action="updateshow.php" method="post">
                <h1>Edit Show</h1><br><br>
                <label for="showid">Show id : </label>
                <input type="text" name="showid" value="<?php echo $n['msid'] ?>" readonly="true"><br><br>
                <label for="moviename">Movie Title : </label>
                <select name="option" id="">
                    <?php

                    while ($sm = mysqli_fetch_assoc($selectmovie)) {
                        if ($mvid == $sm['movieid']) {

                            $selected = "selected";
                        } else {
                            $selected = '';
                        }
                        echo ('<option value="' . $sm['movieid'] . '" ' . $selected . '>' . $sm['moviename'] . '</option>');
                    }

                    ?>

                </select><br><br>

                <label for="date">Show Date : </label>
                <input type="date" name="date" value="<?php echo $n['showdate'] ?>"><br><br>
                <label for="time">Show Time : </label>
                <input type="time" name="time" value="<?php echo $n['showtime'] ?>"><br><br>
                <label for="hall">Hall : </label>
                <select name="hall" id="">
                    <?php
                    while ($hall = mysqli_fetch_assoc($selecthall)) {
                        if ($hallid == $hall['hallid']) {
                            $selected = "selected";
                        } else {
                            $selected = '';
                        }
                        echo ('<option value="' . $hall['hallid'] . '" ' . $selected . '>' . $hall['hallname'] . '</option>');
                    }
                    ?>

                </select><br><br>
                <div class="submit-btn"><button type="submit" name="submit" id="submit">Submit</button></div>
            </form>
        </div>
    </div>
</body>

</html>