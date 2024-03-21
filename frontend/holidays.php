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
                    //this section is created to wrap the guest list toggle button
                    echo " <section class='active_event_section'>";

                    //if the event has guests
                    $sql_search_guests = "SELECT * FROM event_has_guests WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                    $query_search_guests = mysqli_query($connection,$sql_search_guests);
                    if(mysqli_num_rows($query_search_guests) != 0){
                        $has_guests = true;

                        //getting the guests list
                        $guest_list = mysqli_fetch_assoc($query_search_guests);
                        $guests = $guest_list["guests"];
                        echo "
                            <button id='guests_button_$IDe' class='guests_button z-depth-1' onclick='show_guest_list($IDe)'><i class='fa-solid fa-users'></i></button>

                            <div class='active_event z-depth-1 center'>

                                <div id='guest_list_$IDe' class='guest_list z-depth-1'>
                                    <button class='delete_guest_list_button modal-trigger z-depth-1' href='#delete_guest_list_$IDe'><i class='fa-solid fa-xmark'></i></button>

                                    <h4 style='background-color: $event_color' class='$luminosity'>guest list</h4>
                                    <textarea id='guests_$IDe' class='guests' maxlenght='500'>$guests</textarea>
                                </div>
                        ";
                    }else{
                        $has_guests = false;
                        echo "<div class='active_event z-depth-1 center'>";
                    }

                                echo "
                                <!-- event color input -->

                                <input id='event_color_$IDe' class='z-depth-1 event_color' type='color' value='$event_color'>

                                <!-- event name textarea -->

                                <section id='event_name_section_$IDe' class='event_name_section $luminosity' style='background-color: $event_color'>
                                    <textarea id='event_name_$IDe' type='text' maxlength='100'>$event_name</textarea>
                                </section>

                                <!-- event date input -->

                                <input id='event_date_$IDe' class='event_date' type='date' value='$event_date'>
                                
                                <section class='active_addons_area'>";

                                //if the event has time
                                $sql_search_time = "SELECT * FROM event_has_time WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                                $query_search_time = mysqli_query($connection,$sql_search_time);
                                if(mysqli_num_rows($query_search_time) != 0){
                                    $has_time = true;

                                    //getting the time
                                    $event_has_time = mysqli_fetch_assoc($query_search_time);
                                    $time = $event_has_time["time"];
                                    echo "
                                        <section class='addon_section'>
                                            <button class='delete_addon_button z-depth-1' onclick='delete_time($IDe)'><i class='fa-solid fa-xmark'></i></button>

                                            <h5 class='addon_title $luminosity' style='background-color: $event_color'><i class='fa-solid fa-clock'></i> time</h5>

                                            <input id='event_time_$IDe' class='event_time' type='time' value='$time'>
                                        </section>
                                    ";
                                }else{
                                    $has_time = false;
                                }

                                //if the event has location
                                $sql_search_location = "SELECT * FROM event_has_location WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                                $query_search_location = mysqli_query($connection,$sql_search_location);
                                if(mysqli_num_rows($query_search_location) != 0){
                                    $has_location = true;

                                    //getting the location
                                    $event_has_location = mysqli_fetch_assoc($query_search_location);
                                    $location = $event_has_location["location"];
                                    echo "
                                        <section class='addon_section'>
                                            <button class='delete_addon_button z-depth-1' onclick='delete_location($IDe)'><i class='fa-solid fa-xmark'></i></button>

                                            <h5 class='addon_title $luminosity' style='background-color: $event_color'><i class='fa-solid fa-location-dot'></i> address</h5>

                                            <textarea id='event_location_$IDe' class='event_location' oninput='auto_grow(this)' maxlenght='300'> $location </textarea>
                                        </section>
                                    ";
                                }else{
                                    $has_location = false;
                                }

                                //if the event has description
                                $sql_search_description = "SELECT * FROM event_has_description WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                                $query_search_description = mysqli_query($connection,$sql_search_description);
                                if(mysqli_num_rows($query_search_description) != 0){
                                    $has_description = true;

                                    //getting the description
                                    $event_has_description = mysqli_fetch_assoc($query_search_description);
                                    $description = $event_has_description["description"];
                                    echo "
                                        <section class='addon_section'>
                                            <button class='delete_addon_button z-depth-1' onclick='delete_description($IDe)'><i class='fa-solid fa-xmark'></i></button>
                                            
                                            <h5 class='addon_title $luminosity' style='background-color: $event_color'><i class='fa-solid fa-comment'></i> description</h5>

                                            <textarea id='event_description_$IDe' class='event_description' oninput='auto_grow(this)' maxlenght='300'> $description </textarea>
                                        </section>    
                                    ";
                                }else{
                                    $has_description = false;
                                }

                                //if the event has transport
                                $sql_search_transport = "SELECT * FROM event_has_transport WHERE (`IDu` = '$IDu') AND (`IDe` = '$IDe')";
                                $query_search_transport = mysqli_query($connection,$sql_search_transport);
                                if(mysqli_num_rows($query_search_transport) != 0){
                                    $has_transport = true;

                                    //getting the transport
                                    $event_has_transport = mysqli_fetch_assoc($query_search_transport);
                                    $vehicle = $event_has_transport["vehicle"];
                                    $time = $event_has_transport["time"];
                                    echo "
                                        <section class='addon_section'>
                                            <button class='delete_addon_button z-depth-1' onclick='delete_transport($IDe)'><i class='fa-solid fa-xmark'></i></button>

                                            <h5 class='addon_title $luminosity' style='background-color: $event_color'><i class='fa-solid fa-signs-post'></i> locomotion</h5>

                                            <section class='transport_area'>
                                                <select id='transport_vehicle_$IDe' class='transport_vehicle'>";
                                                    if($vehicle == 1){
                                                        echo "<option value='1' selected>&#xf1b9;</option>";
                                                    }else{
                                                        echo "<option value='1'>&#xf1b9;</option>";
                                                    }
                                                    if($vehicle == 2){
                                                        echo "<option value='2' selected>&#xf072;</option>";
                                                    }else{
                                                        echo "<option value='2'>&#xf072;</option>";
                                                    }
                                                    if($vehicle == 3){
                                                        echo "<option value='3' selected>&#xf207;</option>";
                                                    }else{
                                                        echo "<option value='3'>&#xf207;</option>";
                                                    }
                                                    if($vehicle == 4){
                                                        echo "<option value='4' selected>&#xf554;</option>";
                                                    }else{
                                                        echo "<option value='4'>&#xf554;</option>";
                                                    }
                                                    if($vehicle == 5){
                                                        echo "<option value='5' selected>&#xf238;</option>";
                                                    }else{
                                                        echo "<option value='5'>&#xf238;</option>";
                                                    }
                                                    if($vehicle == 6){
                                                        echo "<option value='6' selected>&#xf21a;</option>";
                                                    }else{
                                                        echo "<option value='6'>&#xf21a;</option>";
                                                    }
                                                echo"
                                                </select>

                                                <input id='transport_time_$IDe' class='transport_time' type='time' value='$time'>
                                            </section>
                                        </section>
                                    ";
                                }else{
                                    $has_transport = false;
                                }

                                echo"
                                </section>
                                <!-- inactive addons buttons -->

                                <section id='inactive_addons_area_$IDe' class='inactive_addons_area $luminosity' style='background-color: $event_color'>

                                    <!-- addons area trigger -->
                                    
                                    <i id='addons_trigger_$IDe' onclick='show_addons_area($IDe)' class='addons_trigger fa-solid fa-caret-up'></i>

                                    <section id='addons_buttons_area_$IDe' class='addons_buttons_area'>
                                    ";
                                        //if the event doesn't have a location
                                        if($has_location == false){
                                            echo "
                                                <button class='addon_button' href='#' onclick='add_addon($IDe, \"location\")'><i class='fa-solid fa-location-dot'></i></button>
                                            ";
                                        }
                                        //if the event doesn't have a time
                                        if($has_time == false){
                                            echo "
                                                <button class='addon_button' href='#' onclick='add_addon($IDe, \"time\")'><i class='fa-solid fa-clock'></i></button>
                                            ";
                                        }
                                        //if the event doesn't have a description
                                        if($has_description == false){
                                            echo "
                                                <button class='addon_button' href='#' onclick='add_addon($IDe, \"description\")'><i class='fa-solid fa-comment'></i></button>
                                            ";
                                        }
                                        //if the event doesn't have a transportation
                                        if($has_transport == false){
                                            echo "
                                                <button class='addon_button' href='#' onclick='add_addon($IDe, \"transportation\")'><i class='fa-solid fa-signs-post'></i></button>
                                            ";
                                        }
                                        //if the event doesn't have a guest list
                                        if($has_guests == false){
                                            echo "
                                                <button class='addon_button' href='#' onclick='add_addon($IDe, \"guests\")'><i class='fa-solid fa-users'></i></button>
                                            ";
                                        }
                                        echo "
                                        <button class='addon_button modal-trigger' href='#download_pdf_$IDe'><i class='fa-solid fa-file-pdf'></i></button>

                                        <button class='addon_button modal-trigger' href='#delete_event_$IDe'><i class='fa-solid fa-trash'></i></button>
                                    </section>
                                </section>
                            </div>
                        </section>
                    ";

                    //printing the delete event modal
                    echo "
                        <!-- delete event modal -->
                        <div id='delete_event_$IDe' class='modal'>
                            <div class='modal-content'>
                                <img class='modal_capital' src='../assets/logos/white_capital.png' alt=''>
                                <h3>deleting a event</h3>

                                <p class='modal_alert'>your'e about to delete the event \"$event_name\", this action can't be undone, are you sure?</p>
                
                                <!-- delete event button -->
                                <div class='row center'>
                                    <button class='btn waves-effect waves-light' onclick='delete_event($IDe)'>
                                        yes
                                    </button>
                                </div>
                            </div>
                        </div>
                    ";
                    //printing the delete guest list modal
                    echo "
                        <!-- delete guest list modal -->
                        <div id='delete_guest_list_$IDe' class='modal'>
                            <div class='modal-content'>
                                <img class='modal_capital' src='../assets/logos/white_capital.png' alt=''>
                                <h3>deleting a event</h3>

                                <p class='modal_alert'>your'e about to delete the <strong>GUEST LIST</strong> from the event \"$event_name\", this action can't be undone, are you sure?</p>
                
                                <!-- delete event button -->
                                <div class='row center'>
                                    <button class='btn waves-effect waves-light' onclick='delete_guest_list($IDe)'>
                                        yes
                                    </button>
                                </div>
                            </div>
                        </div>
                    ";
                }
            
                /*
                    location (via maps)
                    transportation (car, train, plane, bus, walking, with location via maps)
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