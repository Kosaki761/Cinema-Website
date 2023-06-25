<?php
    include "config.php";
    if($_SESSION['id'] != true){
        // echo "<script>alert('done');</script>"; 
        header("Location: login.php");   
        // echo "<script>alert('donesadfas');</script>";
        exit();
    }

    $movieid = $_GET['id'];
    $hallid = $_GET['hall_id'];
    $userid = $_SESSION['id'];
    $totalprice = 0;
    $result = mysqli_query($conn, "SELECT ticket.*, movie_show.*, name,moviename, seatname,seatprice, hallname
                                    FROM ticket JOIN movie_show ON movie_show.msid = ticket.msid 
                                    JOIN users ON ticket.id = users.id
                                    JOIN movie ON movie_show.movieid = movie.movieid
                                    JOIN location ON movie_show.hallid = location.hallid
                                    JOIN seat ON ticket.ticketid = seat.ticketid
                                    WHERE ticket.ticketid = (SELECT MAX(ticketid) FROM ticket) ");

?>
<html>
    <head>
        <title>Ticket Receipt</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/67120f1b6a.js" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    <body>
   
        <div class="container">
            <div class="container-row">
                <div class="col-md-12">
                    <!-- <table class="table-receipt">
                        <thead>
                            <tr>
                               <th>User Name</th>
                               <th>Movie Name</th>
                               <th>Date</th>
                               <th>Time</th> 
                               <th>Hall</th>
                               <th>Seat no</th>
                               <th>Price</th>
                            </tr>
                        </thead>
                        <?php // while($rows = mysqli_fetch_assoc($result)){ ?>
                            
                        <tbody>
                            <td><?php echo $rows['name']; ?></td>
                            <td><?php echo $rows['moviename']; ?></td>
                            <td><?php echo $rows['showdate']; ?></td>
                            <td><?php echo $rows['showtime']; ?></td>
                            <td><?php echo $rows['hallname']; ?></td>
                            <td><?php echo $rows['seatname']; ?></td>
                            <td><?php echo $rows['seatprice']; ?></td>
                        </tbody> 
                             
                        <?php //$totalprice = $totalprice + $rows['seatprice']; }?>   
                    </table> -->
                    <?php //echo $totalprice ?>
                </div>
            </div>
        </div>
        
        <div class="receipt">
            <div class="logo">
                <i class="fa-solid fa-infinity" style="font-size: 50px; margin-left:10px; position:relative; "><span style="font-size: 20px; position:absolute; width:200px; top:15px;left:80px;"> INF CINEMA</span></i>
            </div>
            <?php 
            
            $select_1 = mysqli_query($conn, "SELECT ticket.*, movie_show.*, name,moviename, seatname,seatprice, hallname
            FROM ticket JOIN movie_show ON movie_show.msid = ticket.msid 
            JOIN users ON ticket.id = users.id
            JOIN movie ON movie_show.movieid = movie.movieid
            JOIN location ON movie_show.hallid = location.hallid
            JOIN seat ON ticket.ticketid = seat.ticketid
            WHERE ticket.ticketid = (SELECT MAX(ticketid) FROM ticket) LIMIT 1");
            
            $row = mysqli_fetch_array($select_1); 
            $movietime = date_create($row['showtime']);
            ?>     
            <h2>Ticket Receipt</h2><br>
                 Movie Name : <?php echo $row['moviename']; ?> <br><br>
                 Date : <?php echo $row['showdate']; ?> <br><br>
                 Time: <?php echo date_format($movietime,'g:i:A'); ?> <br><br>
                 Hall : <?php echo $row['hallname']; ?> <br><br>
                 Seat : <?php while($rows = mysqli_fetch_assoc($result)){  echo $rows['seatname'];  echo " " ?>
                
                 <?php $totalprice = $totalprice + $rows['seatprice']; }?> <br><br>
                 Total price : RM <?php echo $totalprice ?>
                 <br><br><hr>
                 <button onclick="window.print();">Print</button>
                 
                
        </div>

        <style>
            *{
                font-size: xx-large;
            }
            .receipt{
                font-family: 'Inconsolata', monospace;
                margin-left: 100px;
                margin-right: 100px;
                padding: 20px;
                
                border-color: black;
            
            }
            @page { size: letter landscape }
</style>
        </style>
    </body>
</html>