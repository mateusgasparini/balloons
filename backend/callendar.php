<?php 
session_start();
if(isset($_POST["change_days_minimized"])){
    include_once "../backend/connection.php";
    $connection = connect();
    $IDu = $_SESSION["IDu"];
    //getting the next month and current year
    $month = $_POST["month"];
    $year = $_POST["year"];

    //getting the 1º date of the month of the current month
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
}else if(isset($_POST["change_days_maximized"])){
    include_once "../backend/connection.php";
    $connection = connect();
    $IDu = $_SESSION["IDu"];
    //getting the month and year
    $month = $_POST["month"];
    $year = $_POST["year"];
    //getting the number of days of the month
    $number_of_days = date('t');
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
}

?>