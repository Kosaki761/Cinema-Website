<?php

include '../config.php';

if (!empty($_SESSION["admlogin"])) {
} else {
    header("Location: ../login.php");
}

$limit = 3;

if (isset($_GET["page"])) {
    $page_number  = $_GET["page"];
} else {
    $page_number = 1;
}

// get the initial page number
$initial_page = ($page_number - 1) * $limit;
// get data of selected rows per page 
//echo "initial: $initial_page  limit: $limit ";
$getQuery = "SELECT * FROM movie LIMIT $initial_page, $limit";
$result = mysqli_query($conn, $getQuery);

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    if ($name == '%')
        $cond = "";
    else
        $cond = "where moviename = '" . $name . "' ";
        
    $sql = "select * from movie " . $cond . " order by moviename";
    $result = mysqli_query($conn, $sql);
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
    <title>Movie list</title>
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
        <h1>Movie List</h1>
        <div class="head-container">
            <a id="addmoviebtn" href="addmovie.php"><i class="fa-solid fa-plus plus"></i>Add Movie</a>
            <form class="form-inline" method="post" action="">
                <input type="text" name="name" class="form-control" placeholder="Search">
                <input type="submit" name="submit" class="btn btn-primary" />
            </form>  
        </div>
            <table  class="movie-list">
                <form action="movielist.php" method="post">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $rows['movieid']; ?></td>
                            <td><img src="images/<?php echo $rows['image']; ?>"></td>
                            <td><?php echo $rows['moviename']; ?></td>
                            <td><?php echo $rows['genre']; ?></td>
                            <td><?php echo $rows['description']; ?></td>
                            <td>
                                <a id="editdata"  href=edit.php?edit=<?php echo $rows['movieid']; ?>>Edit</a>
                                <a id="deletedata" href=delete.php?delete=<?php echo $rows['movieid']; ?> onclick="return  confirm('do you want to delete Y/N')">Delete</a>
                            </td>
                        </tr>
                <?php }
                
                ?>

                </form>
            </table>
            <div class="items">
                <?php
                $getQuery = "SELECT COUNT(*) FROM movie";
                $result = mysqli_query($conn, $getQuery);
                $row = mysqli_fetch_row($result);
                $total_rows = $row[0];
                echo "</br>";
                // get the required number of pages
                $total_pages = ceil($total_rows / $limit);
                $pageURL = "";
                if ($page_number >= 2) {
                    echo "<a href='movielist.php?page=" . ($page_number - 1) . "'>  Prev </a>";
                }
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page_number) {
                        $pageURL .= "<a class = 'active' href='movielist.php?page=" . $i . "'>" . $i . " </a>";
                    } else {
                        $pageURL .= "<a href='movielist.php?page=" . $i . "'> " . $i . " </a>";
                    }
                }
                echo $pageURL;
                if ($page_number < $total_pages) {
                    echo "<a href='movielist.php?page=" . ($page_number + 1) . "'>  Next </a>";
                }
                ?>
            </div>
            <div class="inline">
                <input id="page" type="number" min="1" max="<?php echo $total_pages ?>" placeholder="<?php echo $page_number . " /" . $total_pages; ?>" required>
                <button onClick="go2Page();">Go</button>
            </div>
    </div>
    <script>
        function go2Page() {
            var page = document.getElementById("page").value;
            page = ((page > <?php echo $total_pages; ?>) ? <?php echo $total_pages; ?> : ((page < 1) ? 1 : page));
            window.location.href = 'movielist.php?page=' + page;
        }
    </script>

</body>

</html>