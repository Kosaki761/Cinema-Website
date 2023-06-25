<?php 
include '../config.php';

if(isset($_POST['submit'])){

    $id = $_POST['showid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $mvid = $_POST['option'];
    $hallid = $_POST['hall'];

    echo $date . "<br>";
    echo $time . "<br>";
    echo $mvid ."<br>";   
    echo $hallid . "<br>";
    echo $id . "<br>";

    $update = mysqli_query($conn,"UPDATE movie_show SET showdate='$date' showtime='$time' movieid=$mvid hallid=$hallid
        WHERE msid=$id");

    if($update){
        echo "Yay";
        header("location: movieshow.php");
    }else{
        echo "error";
    }
}
    

?>