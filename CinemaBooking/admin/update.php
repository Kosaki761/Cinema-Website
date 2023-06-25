<?php 
include '../config.php';

if(isset($_POST['submit'])){
   // movielist update
    $id = $_GET['update'];
    $name = $_POST['moviename'];
    $genre = $_POST['genre'];
    $desc = $_POST['description'];
    $picture = $_POST['picture'];
    
        $file_name = $_FILES[$picture]['name'];
        $file_tmp_name = $_FILES[$picture]['tmp_name'];

        $file_extension = explode('.', $file_name);
        $file_extension = strtolower(end($file_extension));
        $new_file_name = uniqid() . '.' . $file_extension;

        move_uploaded_file($file_tmp_name, 'images/' . $new_file_name);

    $update = "UPDATE movie SET moviename='$name',genre='$genre',description='$desc', image='$new_file_name'
         WHERE movieid=$id";
        $after_update = mysqli_query($conn,$update);


         if($after_update){
            header("location: movielist.php");
         }else{
            echo "Error";
         }
      
   //movie show update
}

?>


