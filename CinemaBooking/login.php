<?php
  require 'config.php';
    if(!empty($_SESSION["id"])){
      header("Location: index.php");
    }
    // LOG IN SESSION
    if(isset($_POST["send"])){
      $usernameemail = $_POST["usernameemail"];
      $password = $_POST["password"];
      if($usernameemail == 'admin' && $password == 'admin')
      {
        $_SESSION['admlogin'] = true;
        header("Location: admin/admin.php");
      }
      else
      {
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$usernameemail' OR email = '$usernameemail'");
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0){
          if($password == $row['password']){
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: index.php");
          }
          else{
            echo
            "<script> alert('Wrong Password'); </script>";
          }
        }
        else{
          echo
          "<script> alert('User Not Registered'); </script>";
        }
      }
      
    }
    //SIGN UP SESSION
    if(isset($_POST["submit"])){
      $name = $_POST["name"];
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $confirmpassword = $_POST["confirmpassword"];
      $duplicate = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' OR email = '$email'");
      if(mysqli_num_rows($duplicate) > 0){
        echo
        "<script> alert('Username or Email Has Already Taken'); </script>";
      }
      else{
        if($password == $confirmpassword){
          $query = "INSERT INTO users (name,username,email,password ) VALUES('$name','$username','$email','$password')";
          mysqli_query($conn, $query);
          echo
          "<script> alert('Registration Successful'); </script>";
        }
        else{
          echo
          "<script> alert('Password Does Not Match'); </script>";
        }
      }
    }
    
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/67120f1b6a.js" crossorigin="anonymous"></script>
    <title>INF Cinema</title>
</head>

<body id="div2">
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
        <li><a href="movies.php">movies</a></li>
        <li><a class="active" href="login.php">Log in</a></li>
    </ul>
  </nav>
  <div class="container-section" id="container">
        <div class="form-container sign-up-container">
            <form method="post" action="" autocomplete="off">
                <h2 class="page-head">Create Account</h2>
                <span>Enter your details for registration</span>
                <input type="text" name="name" id = "name" required value="" placeholder="Name">
                <input type="text" name="username" id = "username" required value="" placeholder="Username">
                <input type="email" name="email" id = "email" required value="" placeholder="Email">
                <input type="password" name="password" id = "password" required value="" placeholder="Password" minlength="8">
                <input type="password" name="confirmpassword" id = "confirmpassword" required value="" placeholder="Confirm Password">
                <button type="submit" name="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="post" action="" autocomplete="off">
                <i class="key fa fa-key fa-4x" aria-hidden="true"></i>
                <span>Enter your existence account</span>
                <h2 class="page-head">Log In</h2>
                <input type="text" name="usernameemail" id = "usernameemail" required value="" placeholder="Username or Email">
                <input type="password" name="password" id = "password" required value="" placeholder="Password">
                <button type="submit" name="send">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h2>Welcome To Null Cinema</h2>
                    <p>We deliver the best experience when you enjoying your movies</p>
                    <button class="press" id="signIn">Sign in</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h2>Malice!</h2>
                    <p>The cinema is not an art about 
                        film and life: the cinema is something 
                        between art and life .</p>
                    <button class="press" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const signUpButton = document.getElementById("signUp");
        const signInButton = document.getElementById("signIn");
        const container = document.getElementById("container");

        signUpButton.addEventListener('click',()=>{
            container.classList.add("right-panel-active");
        })

        signInButton.addEventListener('click',()=>{
            container.classList.remove("right-panel-active");
        })
    </script>
  </body>
  <footer>
    <div class="copyright">
      <p>
        &copy; 2022, Null Cinema. All Right Reserved
      </p>
    </div>
  </footer>
</html>
