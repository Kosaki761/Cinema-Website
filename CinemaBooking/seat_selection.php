<?php
require 'config.php';
if ($_SESSION['id'] != true) {
    // echo "<script>alert('done');</script>"; 
    header("Location: login.php");
    // echo "<script>alert('donesadfas');</script>";
    exit();
}
// $result = mysqli_query($conn, "SELECT DISTINCT movie_show.movieid,movie.*, location.* 
//                 FROM movie_show JOIN movie ON movie_show.movieid = movie.movieid 
//                 JOIN location ON movie_show.hallid = location.hallid");
?>
<!DOCTYPE html>
<html lang="en">

<input type="hidden" name="movie_id" id="movie_id" value="<?= $_POST['movie_id'] ?>" />
<input type="hidden" name="hall_id" id="hall_id" value="<?= $_POST['hall_id'] ?>" />
<input type="hidden" name="selected_movie_date" id="selected_movie_date" value="<?= $_POST['selected_movie_date'] ?>" />
<input type="hidden" name="selected_movie_time" id="selected_movie_time" value="<?= $_POST['selected_movie_time'] ?>" />

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var
            movie_id = document.getElementById("movie_id").value,
            hall_id = document.getElementById("hall_id").value,
            selected_movie_date = document.getElementById("selected_movie_date").value,
            selected_movie_time = document.getElementById("selected_movie_time").value;

        $.ajax({
            url: "seat.php",
            type: "POST",
            data: {
                occupied_seat: true,
                movie_id: movie_id,
                hall_id: hall_id,
                selected_movie_date: selected_movie_date,
                selected_movie_time: selected_movie_time
            },
            //datatype : "json",
            //contentType: "text/plain",
            cache: false,
            success: function(res) {
                //var res = JSON.parse(res);
                var res = jQuery.parseJSON(res);
                //var res = JSON.stringify(res);

                console.log(res);
                // console.log("Status: " + res.status);

                if (res.status == 200) {
                    for (var i = 0; i < res.seat.length; i++) {
                        console.log("Seat: " + res.seat[i]);

                        for (var j = 1; j < 9; j++) {
                            if (res.seat[i] == ("seatA" + j)) {
                                $("#seatA" + j).addClass("seat occupied");
                            }
                        }
                        for (var j = 1; j < 9; j++) {
                            if (res.seat[i] == ("seatB" + j)) {
                                $("#seatB" + j).addClass("seat occupied");
                            }
                        }
                        for (var j = 1; j < 9; j++) {
                            if (res.seat[i] == ("seatC" + j)) {
                                $("#seatC" + j).addClass("seat occupied");
                            }
                        }
                        for (var j = 1; j < 9; j++) {
                            if (res.seat[i] == ("seatD" + j)) {
                                $("#seatD" + j).addClass("seat occupied");
                            }
                        }
                        for (var j = 1; j < 9; j++) {
                            if (res.seat[i] == ("seatE" + j)) {
                                $("#seatE" + j).addClass("seat occupied");
                            }
                        }
                        for (var j = 1; j < 9; j++) {
                            if (res.seat[i] == ("seatF" + j)) {
                                $("#seatF" + j).addClass("seat occupied");
                            }
                        }

                    }
                }
            }
        });
    </script>
    <title>Seat reserve</title>
</head>


<body>
    <!-- div1 -->
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

            <?php if (!isset($_SESSION['login'])) {
                echo '<li><a href="login.php">Log in</a></li>';
            } else {
                echo '<li><a href="logout.php">Logout</a></li>';
            }
            ?>
        </ul>
    </nav>
    <div class="container">
        <div class="seat-container">
            <ul class="showcase">
                <li>
                    <div class="seat"></div>
                    <small>N/A</small>
                </li>
                <li>
                    <div class="seat selected"></div>
                    <small>Selected</small>
                </li>
                <li>
                    <div class="seat occupied"></div>
                    <small>Occupied</small>
                </li>
            </ul>

            <div class="screen">SCREEN</div>

            <div class="seat-group">
                <div class="row">
                    <div class="seat-alpha">A</div>
                    <div class="seat" id="seatA1" onclick="seatA1()"></div>
                    <div class="seat" id="seatA2" onclick="seatA2()"></div>
                    <div class="seat" id="seatA3" onclick="seatA3()"></div>
                    <div class="seat" id="seatA4" onclick="seatA4()"></div>
                    <div class="seat" id="seatA5" onclick="seatA5()"></div>
                    <div class="seat" id="seatA6" onclick="seatA6()"></div>
                    <div class="seat" id="seatA7" onclick="seatA7()"></div>
                    <div class="seat" id="seatA8" onclick="seatA8()"></div>
                    <div class="seat-alpha">A</div>
                </div>
                <div class="row">
                    <div class="seat-alpha">B</div>
                    <div class="seat" id="seatB1" onclick="seatB1()"></div>
                    <div class="seat" id="seatB2" onclick="seatB2()"></div>
                    <div class="seat" id="seatB3" onclick="seatB3()"></div>
                    <div class="seat" id="seatB4" onclick="seatB4()"></div>
                    <div class="seat" id="seatB5" onclick="seatB5()"></div>
                    <div class="seat" id="seatB6" onclick="seatB6()"></div>
                    <div class="seat" id="seatB7" onclick="seatB7()"></div>
                    <div class="seat" id="seatB8" onclick="seatB8()"></div>
                    <div class="seat-alpha">B</div>
                </div>
                <div class="row">
                    <div class="seat-alpha">C</div>
                    <div class="seat" id="seatC1" onclick="seatC1()"></div>
                    <div class="seat" id="seatC2" onclick="seatC2()"></div>
                    <div class="seat" id="seatC3" onclick="seatC3()"></div>
                    <div class="seat" id="seatC4" onclick="seatC4()"></div>
                    <div class="seat" id="seatC5" onclick="seatC5()"></div>
                    <div class="seat" id="seatC6" onclick="seatC6()"></div>
                    <div class="seat" id="seatC7" onclick="seatC7()"></div>
                    <div class="seat" id="seatC8" onclick="seatC8()"></div>
                    <div class="seat-alpha">C</div>
                </div>
                <div class="row">
                    <div class="seat-alpha">D</div>
                    <div class="seat" id="seatD1" onclick="seatD1()"></div>
                    <div class="seat" id="seatD2" onclick="seatD2()"></div>
                    <div class="seat" id="seatD3" onclick="seatD3()"></div>
                    <div class="seat" id="seatD4" onclick="seatD4()"></div>
                    <div class="seat" id="seatD5" onclick="seatD5()"></div>
                    <div class="seat" id="seatD6" onclick="seatD6()"></div>
                    <div class="seat" id="seatD7" onclick="seatD7()"></div>
                    <div class="seat" id="seatD8" onclick="seatD8()"></div>
                    <div class="seat-alpha">D</div>
                </div>
                <div class="row">
                    <div class="seat-alpha">E</div>
                    <div class="seat" id="seatE1" onclick="seatE1()"></div>
                    <div class="seat" id="seatE2" onclick="seatE2()"></div>
                    <div class="seat" id="seatE3" onclick="seatE3()"></div>
                    <div class="seat" id="seatE4" onclick="seatE4()"></div>
                    <div class="seat" id="seatE5" onclick="seatE5()"></div>
                    <div class="seat" id="seatE6" onclick="seatE6()"></div>
                    <div class="seat" id="seatE7" onclick="seatE7()"></div>
                    <div class="seat" id="seatE8" onclick="seatE8()"></div>
                    <div class="seat-alpha">E</div>
                </div>
                <div class="row">
                    <div class="seat-alpha">F</div>
                    <div class="seat" id="seatF1" onclick="seatF1()"></div>
                    <div class="seat" id="seatF2" onclick="seatF2()"></div>
                    <div class="seat" id="seatF3" onclick="seatF3()"></div>
                    <div class="seat" id="seatF4" onclick="seatF4()"></div>
                    <div class="seat" id="seatF5" onclick="seatF5()"></div>
                    <div class="seat" id="seatF6" onclick="seatF6()"></div>
                    <div class="seat" id="seatF7" onclick="seatF7()"></div>
                    <div class="seat" id="seatF8" onclick="seatF8()"></div>
                    <div class="seat-alpha">F</div>
                </div>
                <div class="row">
                    <div class="seat-num">1</div>
                    <div class="seat-num">2</div>
                    <div class="seat-num">3</div>
                    <div class="seat-num">4</div>
                    <div class="seat-num">5</div>
                    <div class="seat-num">6</div>
                    <div class="seat-num">7</div>
                    <div class="seat-num">8</div>
                </div>
            </div>
        </div>
        <p class="text">
            Total Seat : <span id="count">0</span> Price : RM <span id="total">0</span>
        </p>
        <div id="something"></div>
        <button class="buy-seat" id="submit" name="submit" onclick="window.open('receipt.php?id=<?php echo $_POST['movie_id']; ?>&hall_id=<?php echo $_POST['hall_id'] ?>')//return  confirm('confirm booking')">Submit</button>
    </div>

</body>
<footer>
    <div class="copyright">
        <p>
            &copy; 2022, Null Cinema. All Right Reserved
        </p>
    </div>
</footer>

</html>
<!-- load database>loop seat>setcolor>disable select -->

<script>
    var selection;
    var count = 0;
    var total = 0;
    const seat_price = 15;
    var seatSelected = [];

    function changeSeatClass(seatName) {
        if (selection.className == "seat") {
            count++;
            total += seat_price;

            selection.className = "seat selected";
            document.getElementById("count").innerHTML = count;
            document.getElementById("total").innerHTML = total;
            seatSelected.push(seatName);

            console.log(seatSelected);
        } else if (selection.className == "seat selected") {
            count--;
            total -= seat_price;

            selection.className = "seat";
            document.getElementById("count").innerHTML = count;
            document.getElementById("total").innerHTML = total;

            //to remove from array by value not by the last item (array.pop)
            for (var i in seatSelected) {
                if (seatSelected[i] == seatName) {
                    seatSelected.splice(i, 1);
                    break;
                }
            }

            console.log(seatSelected);
        }

    }

    function seatA1() {
        selection = document.getElementById("seatA1");
        changeSeatClass("A1");
    }

    function seatA2() {
        selection = document.getElementById("seatA2");
        changeSeatClass("A2");
    }

    function seatA3() {
        selection = document.getElementById("seatA3");
        changeSeatClass("A3");
    }

    function seatA4() {
        selection = document.getElementById("seatA4");
        changeSeatClass("A4");
    }

    function seatA5() {
        selection = document.getElementById("seatA5");
        changeSeatClass("A5");
    }

    function seatA6() {
        selection = document.getElementById("seatA6");
        changeSeatClass("A6");
    }

    function seatA7() {
        selection = document.getElementById("seatA7");
        changeSeatClass("A7");
    }

    function seatA8() {
        selection = document.getElementById("seatA8");
        changeSeatClass("A8");
    }

    function seatB1() {
        selection = document.getElementById("seatB1");
        changeSeatClass("B1");
    }

    function seatB2() {
        selection = document.getElementById("seatB2");
        changeSeatClass("B2");
    }

    function seatB3() {
        selection = document.getElementById("seatB3");
        changeSeatClass("B3");
    }

    function seatB4() {
        selection = document.getElementById("seatB4");
        changeSeatClass("B4");
    }

    function seatB5() {
        selection = document.getElementById("seatB5");
        changeSeatClass("B5");
    }

    function seatB6() {
        selection = document.getElementById("seatB6");
        changeSeatClass("B6");
    }

    function seatB7() {
        selection = document.getElementById("seatB7");
        changeSeatClass("B7");
    }

    function seatB8() {
        selection = document.getElementById("seatB8");
        changeSeatClass("B8");
    }

    function seatC1() {
        selection = document.getElementById("seatC1");
        changeSeatClass("C1");
    }

    function seatC2() {
        selection = document.getElementById("seatC2");
        changeSeatClass("C2");
    }

    function seatC3() {
        selection = document.getElementById("seatC3");
        changeSeatClass("C3");
    }

    function seatC4() {
        selection = document.getElementById("seatC4");
        changeSeatClass("C4");
    }

    function seatC5() {
        selection = document.getElementById("seatC5");
        changeSeatClass("C5");
    }

    function seatC6() {
        selection = document.getElementById("seatC6");
        changeSeatClass("C6");
    }

    function seatC7() {
        selection = document.getElementById("seatC7");
        changeSeatClass("C7");
    }

    function seatC8() {
        selection = document.getElementById("seatC8");
        changeSeatClass("C8");
    }

    function seatD1() {
        selection = document.getElementById("seatD1");
        changeSeatClass("D1");
    }

    function seatD2() {
        selection = document.getElementById("seatD2");
        changeSeatClass("D2");
    }

    function seatD3() {
        selection = document.getElementById("seatD3");
        changeSeatClass("D3");
    }

    function seatD4() {
        selection = document.getElementById("seatD4");
        changeSeatClass("D4");
    }

    function seatD5() {
        selection = document.getElementById("seatD5");
        changeSeatClass("D5");
    }

    function seatD6() {
        selection = document.getElementById("seatD6");
        changeSeatClass("D6");
    }

    function seatD7() {
        selection = document.getElementById("seatD7");
        changeSeatClass("D7");
    }

    function seatD8() {
        selection = document.getElementById("seatD8");
        changeSeatClass("D8");
    }

    function seatE1() {
        selection = document.getElementById("seatE1");
        changeSeatClass("E1");
    }

    function seatE2() {
        selection = document.getElementById("seatE2");
        changeSeatClass("E2");
    }

    function seatE3() {
        selection = document.getElementById("seatE3");
        changeSeatClass("E3");
    }

    function seatE4() {
        selection = document.getElementById("seatE4");
        changeSeatClass("E4");
    }

    function seatE5() {
        selection = document.getElementById("seatE5");
        changeSeatClass("E5");
    }

    function seatE6() {
        selection = document.getElementById("seatE6");
        changeSeatClass("E6");
    }

    function seatE7() {
        selection = document.getElementById("seatE7");
        changeSeatClass("E7");
    }

    function seatE8() {
        selection = document.getElementById("seatE8");
        changeSeatClass("E8");
    }

    function seatF1() {
        selection = document.getElementById("seatF1");
        changeSeatClass("F1");
    }

    function seatF2() {
        selection = document.getElementById("seatF2");
        changeSeatClass("F2");
    }

    function seatF3() {
        selection = document.getElementById("seatF3");
        changeSeatClass("F3");
    }

    function seatF4() {
        selection = document.getElementById("seatF4");
        changeSeatClass("F4");
    }

    function seatF5() {
        selection = document.getElementById("seatF5");
        changeSeatClass("F5");
    }

    function seatF6() {
        selection = document.getElementById("seatF6");
        changeSeatClass("F6");
    }

    function seatF7() {
        selection = document.getElementById("seatF7");
        changeSeatClass("F7");
    }

    function seatF8() {
        selection = document.getElementById("seatF8");
        changeSeatClass("F8");
    }


    var
        movie_id = document.getElementById("movie_id").value,
        hall_id = document.getElementById("hall_id").value,
        selected_movie_date = document.getElementById("selected_movie_date").value,
        selected_movie_time = document.getElementById("selected_movie_time").value;


    $("#submit").click(function() {
        $.ajax({
            url: "seat.php",
            type: "POST",
            data: {
                book_seat: true,
                selected_movie_date: selected_movie_date,
                selected_movie_time: selected_movie_time,
                seat_name: seatSelected,
                seat_price: seat_price,
                hall_id: hall_id
            },
            //datatype : "json",
            //contentType: "text/plain",
            cache: false,
            success: function(res) {
                console.log(res);
                var res = JSON.parse(res);
                //var res = jQuery.parseJSON(res);
                //var res = JSON.stringify(res);


                console.log("Status: " + res.status);

                if (res.status == 200) {
                    // $("#something").innerHTML = "F5: " + res.seatF5;
                    // if(res.seat.seatF5) { $("#seatF5").addClass = "seat occupied"; }
                    //window.location.replace("http://stackoverflow.com");
                    location.href = "index.php";
                }
            }
        });

    });
</script>