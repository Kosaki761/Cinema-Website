<?php 

include '../config.php';


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $delete = mysqli_query($conn,"DELETE FROM movie WHERE movieid=$id");

    if($delete){
        header("location: movielist.php");

    }else{
        echo "Error delete" . $delete;
    }
}

if(isset($_GET['deleteshow'])){
    $id = $_GET['deleteshow'];
    $delete = mysqli_query($conn,"DELETE FROM movie_show WHERE msid=$id");

    if($delete){
        header("location: movieshow.php");

    }else{
        echo "Error delete" . $delete;
    }
}

if(isset($_GET['deleteticket'])){
    $id = $_GET['deleteticket'];
    $delete = mysqli_query($conn,"DELETE FROM ticket WHERE ticketid=$id");

    if($delete){
        header("location: ticket.php");

    }else{
        echo "Error delete" . $delete;
    }
}


?>
