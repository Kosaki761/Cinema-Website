<?php
require '../config.php';
if (!empty($_SESSION["admlogin"])) {

} else {
  header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/a6b5dc18f4.js" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Major+Mono+Display&display=swap" rel="stylesheet">
  <link href="navbar.css" rel="stylesheet">
  <title>Home Page</title>
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
    <div class="logo-container">
      <img class="inf-logo" src="https://i.pinimg.com/originals/2c/f9/71/2cf971c4c37c55ec9920bec677a06d17.gif" width="100%" height=990vh></img>
      <h1 class="compname">INFINITE CINEMA</h1>
    </div>
  
  
  </div>
</body>

</html>