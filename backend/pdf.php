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
        <link rel='stylesheet' href='../styles/pdf.css?v="; include '../backend/version.php'; echo"'>";
    ?>
</head>

<body>
    <!-- Page Content -->
    <main>
        <?php
            include_once "../backend/connection.php";
            $connection = connect();
            session_start();
            $IDu = $_SESSION["IDu"];
            //getting the IDe
            $IDe = $_GET["IDe"];
            //getting the event
            $sql_event = "SELECT * FROM event WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
            $query_event = mysqli_query($connection,$sql_event);

            $event = mysqli_fetch_assoc($query_event);
            $event_name = $event["name"];
            $event_date = $event["date"];

            $date_array = explode("-",$event_date);
            $date = $date_array[1] . "/" . $date_array[2];

            //getting the day of the week of the event
            $dayofweek_number = date('w', strtotime($event_date));
            if($dayofweek_number == 0){
                $dayofweek_name = "sunday";
            }else if($dayofweek_number == 1){
                $dayofweek_name = "monday";
            }else if($dayofweek_number == 2){
                $dayofweek_name = "tuesday";
            }else if($dayofweek_number == 3){
                $dayofweek_name = "wednesday";
            }else if($dayofweek_number == 4){
                $dayofweek_name = "thursday";
            }else if($dayofweek_number == 5){
                $dayofweek_name = "friday";
            }else if($dayofweek_number == 6){
                $dayofweek_name = "saturday";
            }

            $event_color = $event["color"];

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
                <h1 class='$luminosity' style='background-color:$event_color'>$event_name</h1>
                
                <div class='event_addons' style='border: 5px solid $event_color'>
                    <section class='date_section'>
                        <h3 class='$luminosity' style='background-color:$event_color'>$dayofweek_name</h3>
                        <h3 class='$luminosity' style='background-color:$event_color'>$date</h3>
                    </section>

                    <section class='addons_section'>
            ";

            //if it have guest list
            $sql_search_guests = "SELECT * FROM event_has_guests WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
            $query_search_guests = mysqli_query($connection,$sql_search_guests);
            if(mysqli_num_rows($query_search_guests) != 0){
                //getting the guest list
                $event_has_guests = mysqli_fetch_assoc($query_search_guests);
                $guests = $event_has_guests["guests"];
                echo "
                    <section class='guests_section'>
                        <h2 class='guests_title'>guest list</h2>
                        <h2 class='event_guests'>$guests</h2>
                    </section>    
                ";
            }

            //other addons
            echo "<section class='other_addons_section'>
                    <section class='time_transport'>";

                    //if the event has time
                    $sql_search_time = "SELECT * FROM event_has_time WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                    $query_search_time = mysqli_query($connection,$sql_search_time);
                    if(mysqli_num_rows($query_search_time) != 0){
                        //getting the time
                        $event_has_time = mysqli_fetch_assoc($query_search_time);
                        $time_array = explode(':',$event_has_time["time"]);
                        $time = $time_array[0] . ":" . $time_array[1];
                        echo "
                            <section class='time_transport_section'>
                                <h2><i class='fa-solid fa-clock'></i> $time</h2>
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

                        if($vehicle == 1){
                            $class = "fa-solid fa-car";
                        }else if($vehicle == 2){
                            $class = "fa-solid fa-plane";
                        }else if($vehicle == 3){
                            $class = "fa-solid fa-bus";
                        }else if($vehicle == 4){
                            $class = "transport_vehicle";
                        }else if($vehicle == 5){
                            $class = "fa-solid fa-train";
                        }else if($vehicle == 6){
                            $class = "fa-solid fa-ship";
                        }
                        echo "
                            <section class='time_transport_section'>
                                <h2><i class='$class'></i> $time</h2>
                            </section>
                        ";
                    }
            
            echo "</section>";
            //if the event has location
            $sql_search_location = "SELECT * FROM event_has_location WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
            $query_search_location = mysqli_query($connection,$sql_search_location);
            if(mysqli_num_rows($query_search_location) != 0){
                //getting the location
                $event_has_location = mysqli_fetch_assoc($query_search_location);
                $location = $event_has_location["location"];
                echo "
                    <section class='location_section'>
                        <h2 class='event_location'> $location </h2>
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
                    <section class='description_section'>
                        <h2 class='event_description'>$description</h2>
                    </section>    
                ";
            }

            echo "</section></section></div>";
        ?>
    </main>
</body>
<script>
    window.onload = function() {
        print();
        close();
    };
</script>

</html>