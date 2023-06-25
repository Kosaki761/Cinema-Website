<?php
require '../config.php';

if (!empty($_SESSION["admlogin"])) {
} else {
    header("Location: ../login.php");
}

if (isset($_POST["submit"])) {
    $moviename = $_POST["moviename"];
    $genre = $_POST["genre"];
    $description = $_POST["description"];

    $file_name = $_FILES['picture']['name'];
    $file_tmp_name = $_FILES['picture']['tmp_name'];

    $file_extension = explode('.', $file_name);
    $file_extension = strtolower(end($file_extension));
    $new_file_name = uniqid() . '.' . $file_extension;

    move_uploaded_file($file_tmp_name, 'images/' . $new_file_name);

    $query = "INSERT INTO movie (moviename,genre,description,image) 
            VALUES('$moviename','$genre','$description','$new_file_name')";
    $result = mysqli_query($conn, $query);
    echo "<script> alert('Ashiapp!'); </script>";

    if (!$result) {
        echo ("Error description: " . mysqli_error($conn));
        unlink('images/' . $new_file_name);
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
    <title>Add movie</title>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar">
            <i class="fa-regular fa-user fa-4x"></i>
            <h2>MyAdmin</h2>
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="movielist.php"><i class="fa-solid fa-file-video"></i> Movie List</a></li>
                <li><a href="movieshow.php"><i class="fa-solid fa-film"></i> Movie Show</a></li>
                <li><a href="ticket.php"><i class="fa-solid fa-ticket"></i> Ticket</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Log out</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <div class="add-container">
            <h1>Add Movie</h1><br><br>
            <form class="form-group" action="" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="text" name="moviename" id="moviename" required value="" placeholder="Movie Name"> <br>
                <input type="text" name="genre" id="genre" required value="" placeholder="Genre"> <br>
                <textarea name="description" id="description" required value="" rows="4" cols="50" placeholder="Description"></textarea> <br>
                <input class="input-img" type="file" name="picture" id="picture" accept="image/*" required> <br>
                <!-- <input type="image" name="image" id = "image" required value=""> <br> -->
                <label for="picture" class="inp-img"><i class="fa-solid fa-arrow-up-from-square"></i>Choose Image</label>
                <div class="submit-btn"><button type="submit" name="submit">Submit</button></div>

            </form>
        </div>
    </div>
</body>

</html>