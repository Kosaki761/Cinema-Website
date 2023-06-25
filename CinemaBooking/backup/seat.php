<?php
    include "config.php";

    if(isset($_POST["occupied_seat"]))
    {
        $seat_name = "";

        $query = "SELECT * FROM seat WHERE hallid = " . $_POST["hall_id"];
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
                echo json_encode(array("status"=>200, "seat"=>$array));
            }
            //echo json_encode($json_string);
            //echo $json_string;    
        }
    }
    else if(isset($_POST["book_seat"]))
    {
        // echo "Seat Count: " . count($_POST["seatSelected"]) . "<br />";

        for($i = 0; $i < count($_POST["seat_name"]); $i++)
        {
            // echo "Seat " . $i . ": " . $_POST["seatSelected"][$i] . "<br />"; 
            // echo "Seat Price: " . $_POST["seat_price"] . "<br />";
            // echo "Hall ID: " . $_POST["hall_id"] . "<br />";
            $query = "INSERT INTO seat(seatname, seatprice, hallid) VALUES ('" . $_POST["seat_name"][$i] . "', " . $_POST["seat_price"] . ", " . $_POST["hall_id"] . ")";
            $result = mysqli_query($conn, $query);
        }
        
        if($result) { echo json_encode(array("status"=>200)); }
        else { echo json_encode(array("status"=>406)); }
    }
?>