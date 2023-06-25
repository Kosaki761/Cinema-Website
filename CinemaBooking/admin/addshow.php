<?php
include '../config.php';

if (!empty($_SESSION["admlogin"])) {
} else {
    header("Location: ../login.php");
}

$result = mysqli_query($conn, "SELECT * FROM movie");
$selecthall = mysqli_query($conn, "SELECT * FROM location");

if (isset($_POST["submit"])) {

    $name = $_POST['option'];
    $start_date = date_create($_POST['start_date']);
    $end_date = date_create($_POST['end_date']);
    $time = $_POST['time'];
    $hallname = $_POST['hall'];

    // Calculates the difference between DateTime objects
    $diff = date_diff($start_date, $end_date);
    $interval = $diff->format("%a"); //same as date_format($diff,"%a");
    $tarikh = $start_date;

    for($i = 0; $i <= $interval; $i++){
        $date =  date_format($tarikh,"Y-m-d");
        $insert = mysqli_query($conn, "INSERT INTO movie_show (showdate,showtime,movieid,hallid)
                                    VALUES('$date','$time','$name','$hallname')");
        date_add($tarikh,date_interval_create_from_date_string("1 day"));
        if (!$insert) {
            echo "<script>alert('Error')</script>";
        } 
    }

    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a6b5dc18f4.js" crossorigin="anonymous"></script>
    <link href="navbar.css" rel="stylesheet">
    <title>Add Show</title>
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
            <form action="" method="post">
                <h1>Add Show</h1><br><br>
                <label for="moviename">Movie Name : </label><br>
                <select class="custom-select" name="option" id="">
                    <?php

                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                        <option value="<?php echo $row['movieid'] ?>"><?php echo $row['moviename']; ?></option>

                    <?php
                    } ?>
                </select><br><br>

                <label for="date">start Date : </label><br>
                <input type="date" name="start_date" ><br>
                <label for="date">end Date : </label><br>
                <input type="date" name="end_date" ><br>
                <label for="time">Show Time : </label><br>
                <input type="time" name="time"><br>
                <label for="hall">Hall : </label><br>
                <select class="custom-select" name="hall" id="">

                    <?php
                    while ($hall = mysqli_fetch_assoc($selecthall)) {
                    ?>
                        <option value="<?php echo $hall['hallid'] ?>"><?php echo $hall['hallname']; ?></option>

                    <?php
                    } ?>
                </select><br><br>
                <div class="submit-btn"><button type="submit" name="submit" id="submit">Submit</button></div>
            </form>
        </div>
    </div>
</body>

</html>