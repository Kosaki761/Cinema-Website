<?php
require 'config.php';
$result = mysqli_query($conn, "SELECT DISTINCT movie_show.movieid,movie.*, location.* 
                FROM movie_show JOIN movie ON movie_show.movieid = movie.movieid 
                JOIN location ON movie_show.hallid = location.hallid");
?>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="css/style.css" rel="stylesheet" /> -->
    <script src="https://kit.fontawesome.com/67120f1b6a.js" crossorigin="anonymous"></script>
    <title>INF Cinema</title>
</head>

<body>
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
            <li><a class="active" href="movies.php">movies</a></li>

            <?php if(!isset($_SESSION['login'])) { echo '<li><a href="login.php">Log in</a></li>'; }
                else { echo '<li><a href="logout.php">Logout</a></li>'; }
            ?>
        </ul>
    </nav>
    <div class="section">

        <div class="movie-content">
            <div class="movie-list">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="movie-list-item">
                        <img class="movie-list-item-img-view" src=".\admin\images\<?php echo $row['image'] ?>" alt="movie-image">
                        <a class="movie-list-item-button" href="book.php?id=<?php echo $row['movieid']; ?>&hall_id=<?php echo $row['hallid']; ?>" >WATCH</a>
                        <span class="movie-list-item-title"><?php echo $row['moviename'] ?></span>
                    </div>
                <?php
                } ?>
            </div>
        </div>
    </div>
</body>
<script src="js/app.js"></script>
<footer>
    <div class="copyright">
        <p>
            &copy; 2022, Null Cinema. All Right Reserved
        </p>
    </div>
</footer>

</html>

<style>
    * {
        padding: 0;
        margin: 0;
        text-decoration: none;
        list-style: none;
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    body {
        background-color: rgb(12, 12, 26);
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        opacity: .9;
    }

    /* Navigation bar */
    nav {
        z-index: 10000;
        position: fixed;
        top: 0;
        height: 90px;
        width: 100%;
        background-image: linear-gradient(black, rgba(0, 0, 0, 0.521), rgba(0, 0, 0, 0));
    }

    nav ul {
        float: right;
        margin-right: 20px;
    }

    nav ul li {
        display: inline-block;
        line-height: 80px;
        margin: 0 5px;
    }

    nav ul li a {
        color: white;
        font-size: 17px;
        padding: 7px 13px;
        border-radius: 3px;
        text-transform: uppercase;
    }

    nav a.active,
    nav a:hover {
        color: black;
        background: rgb(255, 255, 255);
        padding: 10px 20px;
        transition: .5s;
        border-radius: 100px;
    }

    .logo {
        margin-top: 15px;
        text-align: center;
        float: left;
        color: white;
        font-size: 30px;
        font-weight: bold;
        line-height: 12px;
        padding: 0 100px;
    }

    .logo p {
        font-size: 15px;
    }

    .checkbtn {
        font-size: 30px;
        color: white;
        float: right;
        line-height: 80px;
        margin-right: 40px;
        cursor: pointer;
        display: none;
    }

    #check {
        display: none;
    }

    @media(max-width: 952px) {
        label.logo {
            font-size: 30px;
            padding-left: 50px;
        }

        nav ul li a {
            font-size: 16px;
        }
    }

    @media(max-width: 858px) {
        .checkbtn {
            display: block;
        }

        ul {
            position: fixed;
            margin-right: 0;
            width: 100%;
            height: 100vh;
            background: rgba(12, 12, 26, 0.973);
            top: 80px;
            right: -130%;
            text-align: center;
            transition: all .5s;
        }

        nav ul li {
            display: block;
            margin: 50px 0;
            line-height: 30px;
        }

        nav ul li a {
            font-size: 20px;
        }

        a:hover,
        a.active {
            background: none;
            color: #0091ff
        }

        #check:checked~ul {
            right: 0;
            margin-right: 0;
        }
    }

    /* end navigation bar */

    /* .section{
    margin: 0;
    align-items: center;
    text-align: center;
    width: 100%;
    min-height: calc(100vh-50px);
    background-image:radial-gradient(rgba(0, 174, 255, 0.068),rgb(12, 12, 26));
    color:rgb(255, 255, 255);
} */
    .movie-list {
        display: grid;
        grid-template-columns: auto auto auto auto;
        /* background-color: red; */
        margin: 0 10%;
        margin-top: 100px;
    }

    /* .movie-content .movie-list{
        margin-top: 200px;
    } */
    .movie-list-item {
        /* padding: 5px 5px; */
        /* background-color: rgba(255, 255, 255, 0.8); */
        /* border: 1px solid rgba(0, 0, 0, 0.8); */
        /* padding: 15px; */
        position: relative;
        padding-bottom: 20px;
        margin: 20% 0.4em;
        text-align: center;
    }

    .movie-list-item-img-view {
        height: 100%;
        width: 100%;
        /* padding: 3% px; */
    }

    .movie-list-item-button {
        padding: 7px;
        outline: none;
        border: none;
        cursor: pointer;
        position: absolute;
        padding: 15px;
        bottom: 40%;
        left: 35%;
        opacity: 0;
        /* transition: all 1s ease-in-out; */
    }

    .movie-list-item:hover{
        opacity: 0.7;
    }
    .movie-list-item:hover .movie-list-item-button {
        opacity: 1;
        background-color: rgb(255, 251, 0);

    }
    .movie-list-item-button:hover{
        background-color: rgb(247, 244, 75);
    }

    .movie-list-item-title{
        color: white;
        
    }
    .movie-list-item-title{
        font-weight: bolder;
    }
    
</style>