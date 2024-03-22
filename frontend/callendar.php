<?php 
    session_start();
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        header("Location:../index.php");
        //Redirecting the user in case it's not logged
    }
?>
<!-- 
this is the main page after login, it's a callendar with the days of the month displayed, here you can zoom in and zoom out, add and edit holidays, add and edit notifications.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- page name and icon -->
    <title>Ballons - your planning tool</title>
    <link rel="icon" type="image/x-icon" href="../assets/logos/mint_capital.png">

    <!-- getting the styles links -->
    <?php
        include_once "../backend/css_puller.php";

        echo"
        <!-- This Page CSS -->
        <link rel='stylesheet' href='../styles/callendar.css?v="; include '../backend/version.php'; echo"'>";
    ?>
</head>

<body>
    <!-- Navbar -->
    <nav class="nav-extended">
        <div class="nav-wrapper" id="defined_heigth">
            <a href="#" class="brand-logo"><img src="../assets/logos/white_capital.png" alt="navbar logo"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="../backend/logout.php">log out</a></li>
            </ul>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a class="active" href="callendar.php">callendar</a></li>
                <li class="tab"><a href="holidays.php">my holidays</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="../backend/logout.php">exit</a></li>
    </ul>
    <!-- Page Content -->
    <main>
        <!-- Year and Month View -->
        <div id="month_name" class="z-depth-1">
            <!-- Year View -->
            <section id="year_view">
                <?php 
                    echo "<h1>" . date("Y") . "</h1>";
                    echo "<input type='hidden' id='current_year' value='" . date("Y") . "'>";
                ?>
            </section>
            <!-- Month View -->
            <section id="month_view">
                <a onclick="previous_month()"><i class="fa-solid fa-arrow-left-long"></i></a>
                <section id="month_h1">
                    <?php 
                
                        $month = date("m");
                        echo "<input type='hidden' id='current_month' value='$month'>";
                        if($month == 1){
                            echo "<h1>january</h1>";
                        }else if($month == 2){
                            echo "<h1>february</h1>";
                        }else if($month == 3){
                            echo "<h1>march</h1>";
                        }else if($month == 4){
                            echo "<h1>april</h1>";
                        }else if($month == 5){
                            echo "<h1>may</h1>";
                        }else if($month == 6){
                            echo "<h1>july</h1>";
                        }else if($month == 7){
                            echo "<h1>june</h1>";
                        }else if($month == 8){
                            echo "<h1>august</h1>";
                        }else if($month == 9){
                            echo "<h1>september</h1>";
                        }else if($month == 10){
                            echo "<h1>october</h1>";
                        }else if($month == 11){
                            echo "<h1>november</h1>";
                        }else if($month == 12){
                            echo "<h1>december</h1>";
                        }
                
                    ?>
                </section>
                <a onclick="next_month()"><i class="fa-solid fa-arrow-right-long"></i></a>
            </section>
        </div>
        <!-- Minimized callendar area -->
        <section id="callendar_wrapper"  class="z-depth-1">
            <!-- Week Subtitle -->
            <div id="week_subtitle_area">
                <div class="week_subtitle_name" id="sun">Sun</div>
                <div class="week_subtitle_name">Mon</div>
                <div class="week_subtitle_name">Tue</div>
                <div class="week_subtitle_name">Wed</div>
                <div class="week_subtitle_name">Thu</div>
                <div class="week_subtitle_name">Fri</div>
                <div class="week_subtitle_name" id="sat">Sat</div>
            </div>
            <!-- days minimized -->
            <div id='days_minimized_area'>
                <?php
                    include_once "../backend/connection.php";
                    $connection = connect();
                    //getting the 1º date of the month of the current month 
                    $year = date("Y");
                    $dayofweek = date('w', strtotime($year."-".$month."-01"));
                    //getting the number of days of the month
                    $number_of_days = date('t');
                    //printing the current month calendar minimized
                    //this for will add the necessary quantity of blank spaces before the first day, so that the week subtitle work
                    for($i = 0; $i<$dayofweek; $i++){
                        echo "<div class='day_minimized filler'></div>";
                    }
                    //this for will add the days of this month
                    for($i = 1; $i <= $number_of_days; $i++){
                        //searching if this day has a holiday
                        $this_day_date = ($year."-".$month."-".$i);
                        $sql_search_holiday = "SELECT * FROM event WHERE (`IDu` = '$IDu') AND (`date` = '$this_day_date') AND (`situation` = '1')";
                        
                        $query_search_holiday = mysqli_query($connection,$sql_search_holiday);
                        //in case the day has holidays
                        if(mysqli_num_rows($query_search_holiday) > 0){
                            echo "  <a class='day_minimized' onclick='maximize($i)' id='day_$i'>
                                        <div>
                                            <h3 class='day_minimized_number'>" .sprintf("%02d", $i) ."</h3>";
                            $holiday_counter = 0;
                            while($holiday = mysqli_fetch_assoc($query_search_holiday)){
                                if($holiday_counter < 2){
                                    $holiday_name = $holiday["name"];
                                    $holiday_color = $holiday["color"];

                                    //seeing if the color chosen by the user is light or dark
                                    $r = hexdec(substr($holiday_color,1,2)); // Se for sem o #, mude para 0, 2
                                    $g = hexdec(substr($holiday_color,3,2)); // Se for sem o #, mude para 3, 2
                                    $b = hexdec(substr($holiday_color,5,2)); // Se for sem o #, mude para 5, 2
                                    $luminosity = ( $r * 299 + $g * 587 + $b * 114) / 1000;

                                    if( $luminosity > 128 ) {
                                        $luminosity = "light";
                                    }else{
                                        $luminosity = "dark";
                                    }

                                    echo "<h4 class='day_minimized_holiday_name $luminosity' style='background-color:$holiday_color'>$holiday_name</h4>";
                                }
                                $holiday_counter++;
                            }
                            if($holiday_counter > 2){
                                $holiday_counter -= 2;
                                echo "<p class='holidays_exceded'>+$holiday_counter</p>";
                            }
                            echo"       </div>
                                    </a>";
                        }
                        //in case the day doesn't have any holidays
                        else{
                            echo "  <a class='day_minimized' onclick='maximize($i)' id='day_$i'>
                                        <div>
                                            <h3 class='day_minimized_number'>" .sprintf("%02d", $i) ."</h3>
                                        </div>
                                    </a>";
                        }
                    }
                ?>
            </div>
        </section>
        <!-- Maximized callendar area (carousel) -->
        <section id="carousel_wrapper">
            <!-- days maximized -->
            <div class="carousel carousel-slider center" id="days_maximized_area">
                <?php
                    //printing the current month calendar minimized
                    //this for will add the days of this month into the carousel
                    for($i = 1; $i <= $number_of_days; $i++){
                        //getting the day of the week of the current day
                        $dayofweek_number = date('w', strtotime($year."-".$month."-". $i));
                        if($dayofweek_number == 0){
                            $dayofweek_name = "sun";
                        }else if($dayofweek_number == 1){
                            $dayofweek_name = "mon";
                        }else if($dayofweek_number == 2){
                            $dayofweek_name = "tue";
                        }else if($dayofweek_number == 3){
                            $dayofweek_name = "wed";
                        }else if($dayofweek_number == 4){
                            $dayofweek_name = "thu";
                        }else if($dayofweek_number == 5){
                            $dayofweek_name = "fri";
                        }else if($dayofweek_number == 6){
                            $dayofweek_name = "sat";
                        }
                        //printing the day on the carousel
                        echo"
                        <div class='carousel-item day_maximized_$i' id='day_maximized'>
                            <a onclick='minimize()' class='minimize_button'><i class='fa-solid fa-down-left-and-up-right-to-center'></i></a>
                            <h1>$dayofweek_name</h1>
                            <h2>" .sprintf("%02d", $i) ."</h2>";

                        //searching if this day has a holiday
                        $this_day_date = ($year."-".$month."-".$i);
                        $sql_search_holiday = "SELECT * FROM event WHERE (`IDu` = '$IDu') AND (`date` = '$this_day_date') AND (`situation` = '1')";
                        
                        $query_search_holiday = mysqli_query($connection,$sql_search_holiday);
                        //in case the day has holidays
                        while($holiday = mysqli_fetch_assoc($query_search_holiday)){
                            $IDe = $holiday["IDe"];
                            $holiday_name = $holiday["name"];
                            $event_color = $holiday["color"];

                            //seeing if the color chosen by the user is light or dark
                            $r = hexdec(substr($event_color,1,2)); // Se for sem o #, mude para 0, 2
                            $g = hexdec(substr($event_color,3,2)); // Se for sem o #, mude para 3, 2
                            $b = hexdec(substr($event_color,5,2)); // Se for sem o #, mude para 5, 2
                            $luminosity = ( $r * 299 + $g * 587 + $b * 114) / 1000;

                            if( $luminosity > 128 ) {
                                $luminosity = "light";
                            }else{
                                $luminosity = "dark";
                            }

                            echo "
                                <h4 class='day_maximized_holiday_name $luminosity' style='background-color:$event_color'>$holiday_name</h4>
                                
                                <div class='event_maximized_area' style='border: 5px solid $event_color'>
                            ";
                            //showing the addons

                            //if the event has time
                            $sql_search_time = "SELECT * FROM event_has_time WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                            $query_search_time = mysqli_query($connection,$sql_search_time);
                            if(mysqli_num_rows($query_search_time) != 0){
                                //getting the time
                                $event_has_time = mysqli_fetch_assoc($query_search_time);
                                $time_array = explode(':',$event_has_time["time"]);
                                $time = $time_array[0] . ":" . $time_array[1];
                                echo "
                                    <section class='addon_section'>
                                        <h5 class='event_time'><i class='fa-solid fa-clock'></i> $time</h5>
                                    </section>
                                ";
                            }

                            //if the event has description
                            $sql_search_description = "SELECT * FROM event_has_description WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                            $query_search_description = mysqli_query($connection,$sql_search_description);
                            if(mysqli_num_rows($query_search_description) != 0){
                                //getting the description
                                $event_has_description = mysqli_fetch_assoc($query_search_description);
                                $description = $event_has_description["description"];
                                echo "
                                    <section class='addon_section'>
                                        <h5 class='event_description'>$description</h5>
                                    </section>    
                                ";
                            }

                            //if the event has location
                            $sql_search_location = "SELECT * FROM event_has_location WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                            $query_search_location = mysqli_query($connection,$sql_search_location);
                            if(mysqli_num_rows($query_search_location) != 0){
                                //getting the location
                                $event_has_location = mysqli_fetch_assoc($query_search_location);
                                $location = $event_has_location["location"];
                                echo "
                                    <section class='addon_section'>
                                        <h5 class='event_location'> $location </h5>
                                    </section>
                                ";
                            }

                            //if the event has transport
                            $sql_search_transport = "SELECT * FROM event_has_transport WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                            $query_search_transport = mysqli_query($connection,$sql_search_transport);
                            if(mysqli_num_rows($query_search_transport) != 0){
                                //getting the transport
                                $event_has_transport = mysqli_fetch_assoc($query_search_transport);
                                $vehicle = $event_has_transport["vehicle"];
                                $time_array = explode(':',$event_has_transport["time"]);
                                $time = $time_array[0] . ":" . $time_array[1];
                                echo "
                                    <section class='transport_area'>";
                                            if($vehicle == 1){
                                                echo "<p class='transport_vehicle'><i class='fa-solid fa-car'></i></p>";
                                            }else if($vehicle == 2){
                                                echo "<p class='transport_vehicle'><i class='fa-solid fa-plane'></i></p>";
                                            }else if($vehicle == 3){
                                                echo "<p class='transport_vehicle'><i class='fa-solid fa-bus'></i></p>";
                                            }else if($vehicle == 4){
                                                echo "<p class='transport_vehicle'><i class='fa-solid fa-person-walking'></i>;</p>";
                                            }else if($vehicle == 5){
                                                echo "<p class='transport_vehicle'><i class='fa-solid fa-train'></i></p>";
                                            }else if($vehicle == 6){
                                                echo "<p class='transport_vehicle'><i class='fa-solid fa-ship'></i></p>";
                                            }
                                        echo"
                                        </select>

                                        <h5 class='transport_time'>$time</h5>
                                    </section>
                                ";
                            }

                            echo "</div>";
                        }
                        echo"
                        </div>";
                    }
                ?>
            </div>
        </section>
    </main>
    <!-- Modals -->
</body>

<!-- getting the scripts links -->
<?php 

    include_once "../backend/js_puller.php";

    echo"
    <!-- This Page JS -->
    <script src='../scripts/callendar.js?v="; include '../backend/version.php'; echo"'></script>";

?>
</html>