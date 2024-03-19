<!-- 

this is the only holidays page, here the user will se only his planned holidays, to make it easier to access.
In this page, the user will be able to create and alter holidays planning

--><!--  -->

<!-- Redirecting the user in case it's not logged -->
<?php 
    session_start();
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        header("Location:../index.php");
    }
?>

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
        <link rel='stylesheet' href='../styles/holidays.css?v="; include '../backend/version.php'; echo"'>";
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
                <li class="tab"><a href="callendar.php">callendar</a></li>
                <li class="tab"><a class="active" href="holidays.php">my holidays</a></li>
            </ul>
        </div>
    </nav>
    <ul class="sidenav" id="mobile-demo">
        <li><a href="../backend/logout.php">exit</a></li>
    </ul>
    <!-- Page Content -->
    <main>
        <!-- add planning and see past plannings buttons -->
        <section id="main_action_area">
            <button class="main_action_button z-depth-1" onclick="past_plannings()">past plannings</button>
            <button class="main_action_button z-depth-1 modal-trigger" href="#new_planning_modal">new planning</button>
        </section>
        <!-- active events area -->
        <section id="active_events_area">
            <?php 
            
                include_once "../backend/connection.php";
                $connection = connect();
                //getting todays
                $today = date("Y-m-d");

                $sql_active_events = "SELECT * FROM event WHERE (`IDu` = '$IDu') AND (`date` >= '$today')"
                . "AND (`situation` = '1') ORDER BY date";
                $query_active_events = mysqli_query($connection,$sql_active_events);
                while($event = mysqli_fetch_assoc($query_active_events)){
                    $IDe = $event["IDe"];
                    $event_name = $event["name"];
                    $event_date = $event["date"];
                    $event_color = $event["color"];
                    //getting current year
                    $current_year = date("Y");
                    //discovering the specific day, month, and year
                    $string_to_time = strtotime($event_date);
                    $year = date("Y", $string_to_time);
                    $month = date("m", $string_to_time);
                    $day = date("d", $string_to_time);
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

                    //printing the event
                    echo "
                        <div class='active_event z-depth-1 center'>
                            <!-- event color input -->
                            <input id='event_color_$IDe' class='z-depth-1 event_color' type='color' value='$event_color'>

                            <!-- event name textarea -->
                            <section id='event_name_section_$IDe' class='event_name_section $luminosity' style='background-color: $event_color'>
                                <textarea id='event_name_$IDe' type='text' maxlength='100'>$event_name</textarea>
                            </section>

                            <!-- event date input -->
                            <input id='event_date_$IDe' class='event_date' type='date' value='$event_date'>
                            
                            <!-- event add-ons buttons -->
                            <section id='add_ons_area_$IDe' class='add_ons_area $luminosity' style='background-color: $event_color'>

                                <!-- add-ons area trigger -->
                                <button id='add_ons_trigger_$IDe' onclick='show_addons_area($IDe)' class='add_ons_trigger' style='background-color: $event_color'><i class='fa-solid fa-caret-up'></i></button>
                                
                                <button class='add_on_button' href='#'><i class='fa-solid fa-location-dot'></i></button>

                                <button class='add_on_button' href='#'><i class='fa-solid fa-clock'></i></button>

                                <button class='add_on_button' href='#'><i class='fa-solid fa-comment'></i></button>
                                
                                <button class='add_on_button' href='#'><i class='fa-solid fa-signs-post'></i></button>

                                <button class='add_on_button' href='#'><i class='fa-solid fa-users'></i></button>

                                <button class='add_on_button modal-trigger' href='#delete_event_$IDe'><i class='fa-solid fa-trash'></i></button>
                            </section>
                        </div>
                    ";

                    //printing the delete event modal
                    echo "
                        <!-- new planning modal -->
                        <div id='delete_event_$IDe' class='modal'>
                            <div class='modal-content'>
                                <img class='modal_capital' src='../assets/logos/white_capital.png' alt=''>
                                <h3>deleting a event</h3>

                                <p class='modal_alert'>your'e about to delete the event \"$event_name\", this action can't be undone, are you sure?</p>
                
                                <!-- delete event button -->
                                <div class='row center'>
                                    <button class='btn waves-effect waves-light' id='delete_event_button' onclick='delete_event($IDe)'>
                                        yes
                                    </button>
                                </div>
                            </div>
                        </div>
                    ";
                }
            
                /*
                    location (via maps)
                    time
                    transportation (car, train, plane, bus, walking, with location via maps)
                    description
                    download png
                */
            ?>
        </section>
    </main>
    <!-- Modals -->

        <!-- new planning modal -->
        <div id="new_planning_modal" class="modal">
            <div class="modal-content">
                <img class="modal_capital" src="../assets/logos/white_capital.png" alt="">
                <h3>new planning</h3>

                <!-- new planning form -->
                <form id="new_planning">
                    <!-- event name -->
                    <div class="input-field row">
                        <input id="new_event_name" name="new_event_name" type="text" maxlength="100">
                        <label for="new_event_name">Event Name</label>
                    </div>
                    <!-- event date and color-->
                    <section class="row">
                        <div class="input-field col s9">
                            <input id="new_event_date" name="new_event_date" type="date">
                            <label for="new_event_date">Date</label>
                        </div>
                        <div class="input-field col s3">
                            <input id="new_event_color" class="new_event_color z-depth-1" name="new_event_color" type="color" value="#9EFFBB">
                        </div>
                    </section>
                    <!-- error message -->
                    <div class="row">
                        <p id="new_planning_error"></p>
                    </div>

                    <div class="row center">
                        <button class="btn waves-effect waves-light" id="sign_up_button" type="submit" name="action">
                            add
                        </button>
                    </div>
                </form>
            </div>
        </div>
</body>

<!-- getting the scripts links -->
<?php 

    include_once "../backend/js_puller.php";

    echo"
    <!-- This Page JS -->
    <script src='../scripts/holidays.js?v="; include '../backend/version.php'; echo"'></script>";

?>
</html>