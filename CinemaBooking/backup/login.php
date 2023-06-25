<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
  header("Location: admin.php");
}
if (isset($_POST["submit"])) {
  $usernameemail = $_POST["usernameemail"];
  $password = $_POST["password"];
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usernameemail' OR email = '$usernameemail'");
  $row = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) > 0) {
    if ($password == $row['password']) {
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      header("Location: admin.php");
    } else {
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  } else {
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/a6b5dc18f4.js" crossorigin="anonymous"></script>
  <link href="navbar.css" rel="stylesheet">
  <title>Login</title>
</head>

<body>
  <div class="loginpage">

    <h2>Login</h2>
    <form class="" action="" method="post" autocomplete="off">
      <label for="usernameemail">Username or Email : </label><br>
      <input type="text" name="usernameemail" id="usernameemail" required value=""> <br>
      <label for="password">Password : </label><br>
      <input type="password" name="password" id="password" required value=""> <br>
      <button type="submit" name="submit">Login</button>
    </form>
    <br>
    <a href="registration.php">Registration</a>

  </div>
</body>

</html>