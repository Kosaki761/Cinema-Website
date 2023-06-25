<?php
    include "config.php";

    $userid = $_SESSION["id"]; 
    if(isset($_POST["occupied_seat"]))
    {
        $seat_name = "";
        $query = "SELECT seat.seatname
                    FROM movie_show
                    JOIN ticket
                        ON movie_show.msid = ticket.msid
                        AND movie_show.showdate = ticket.date
                        AND movie_show.showtime = '" . $_POST["selected_movie_time"] . "'
                    JOIN location
                        ON movie_show.hallid = location.hallid
                    JOIN seat
                        ON seat.hallid = location.hallid
                        AND seat.ticketid = ticket.ticketid
                    WHERE location.hallid = " . $_POST["hall_id"] . " AND movie_show.showdate = '" . $_POST["selected_movie_date"] . "'";
        $result = mysqli_query($conn, $query);

        if($result) 
        { 
            $array = array();
            $json_string = "";
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $seat_name = $row["seatname"];
                    array_push($array, "seat" . $seat_name);
                    //$json_string .= "seat" . $seat_name;
                    //$json_string["seat"][] = array("seat" . $seat_name=>true);
                }
                echo json_encode(array("status"=>200, "seat"=>$array));
                //echo json_encode($array);
            } 
            else
            {
                //$json_string[] = "No seats occupied.";
                echo json_encode(array("status"=>404));
            }
            //echo json_encode($json_string);
            //echo $json_string;    
        }
        else
        {
            echo "something is very wrong. " . mysqli_error($conn) ;
        }
    }
    else if(isset($_POST["book_seat"]))
    {
        // echo "Seat Count: " . count($_POST["seatSelected"]) . "<br />";
        //to find msid
        $query1 = "SELECT * FROM movie_show WHERE showdate = '" . $_POST["selected_movie_date"] . "' AND showtime = '" . $_POST["selected_movie_time"] . "' AND hallid = " . $_POST["hall_id"];
        $result1 = mysqli_query($conn, $query1);
        if($result1)
        {
            $row = mysqli_fetch_assoc($result1);

            // $query = "INSERT INTO ticket(date, price, msid, id) VALUES ('" . $_POST["selected_movie_date"] . "', " . $_POST["seat_price"]. ", " . $row["msid"]. ", " . $_SESSION["id"] . ")";
            $query2 = "INSERT INTO ticket(date, price, msid, id) VALUES ('" . $_POST["selected_movie_date"] . "', " . $_POST["seat_price"]. ", " . $row["msid"] . ", $userid)";
            $result2 = mysqli_query($conn, $query2);

            if($result2)
            {

                $last_id = mysqli_insert_id($conn);
                for($i = 0; $i < count($_POST["seat_name"]); $i++)
                {
                    // echo "Seat " . $i . ": " . $_POST["seatSelected"][$i] . "<br />"; 
                    // echo "Seat Price: " . $_POST["seat_price"] . "<br />";
                    // echo "Hall ID: " . $_POST["hall_id"] . "<br />";
                    
                    $query3 = "INSERT INTO seat(seatname, seatprice, hallid, ticketid) VALUES ('" . $_POST["seat_name"][$i] . "', " . $_POST["seat_price"] . ", " . $_POST["hall_id"] . ", " . $last_id . ")";
                    $result3 = mysqli_query($conn, $query3);
                }
        
                if($result3) { 
                    echo json_encode(array("status"=>200)); }
                else { echo json_encode(array("status"=>406)); echo "something is very wrong. " . mysqli_error($conn) ; }
            }
            else
            {
                
                echo  "something is very wrong. " . mysqli_error($conn);
            }
            
        }
        else
        {
            echo "something is very wrong. " . mysqli_error($conn) ;
        }
       
    }
?>