<?php
    $navstring =
    '<ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="#about-us">About Us</a></li>
        <li><a href="#contact-us">Contact Us</a></li>
        <li><a href="movies.php">movies</a></li>';
        if(!isset($_SESSION['login'])) { $navstring .= '<li><a href="login.php">Log in</a></li>'; }
        else { $navstring .= '<li><a href="logout.php">Logout</a></li>'; }
    $navstring .= '</ul>';

    echo $navstring;
?>