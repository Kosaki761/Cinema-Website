<?php

include '../config.php';

if (!empty($_SESSION["admlogin"])) {
} else {
    header("Location: ../login.php");
}
    
        $id = $_GET['edit'];
        $sql = "SELECT * FROM movie WHERE movieid=$id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
    
    
    // // output data of each row
    // echo "id: " . $row["movieid"]. " - Name: " . $row["moviename"]. "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a6b5dc18f4.js" crossorigin="anonymous"></script>
    <link href="navbar.css" rel="stylesheet">
    <title>Update</title>
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
            <form action="update.php?update=<?php echo $id ?>" method="post" enctype="multipart/form-data">
                <h1>Edit Movie</h1><br><br>
                <img src="images/<?php echo $row['image'] ?>" ><br>
                <label for="moviename"> Movie ID :</label>
                <input type="text" name="movieid" value="<?php echo $row['movieid'] ?>" readonly="true"><br>
                <label for="moviename"> Movie Name :</label>
                <input type="text" name="moviename" value="<?php echo $row['moviename'] ?>"><br>
                <label for="moviename"> Genre :</label>
                <input type="text" name="genre" value="<?php echo $row['genre'] ?>"><br>
                <label for="moviename"> Description :</label>
                <input type="text" name="description" value="<?php echo $row['description'] ?>"><br>
                <label for="moviename">Image :</label>
                <input type="file" name="picture" id="picture" accept="image/*" ><br>
                <div class="submit-btn"><button type="submit" name="submit" id="submit">Submit</button></div>
            </form>
        </div>
    </div>
</body>
</html>


