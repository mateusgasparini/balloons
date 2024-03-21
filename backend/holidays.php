<?php 
/* ------------------EVENT CRUD------------------- */
//adding a new event
if(isset($_POST["new_event"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }
    //checking the event name
    if($error == false){
        if(isset($_POST["new_event_name"])){
            if($_POST["new_event_name"] == "" || $_POST["new_event_name"] == null){
                echo "please, inform the name of the event";
                $error = true;
            }else{
                $name = mysqli_real_escape_string($connection, $_POST["new_event_name"]);
            }
        }else{
            echo "an error has ocurred with the event name, please contact suport";
            $error = true;
        }
    }
    //checking the event date
    if($error == false){
        if(isset($_POST["new_event_date"])){
            $date = $_POST["new_event_date"];
            if($date == "" || $date == null){
                echo "please, inform the date of the event";
                $error = true;
            }
        }else{
            echo "an error has ocurred with the event date, please contact suport";
            $error = true;
        }
    }
    //checking the event color
    if($error == false){
        if(isset($_POST["new_event_color"])){
            $color = $_POST["new_event_color"];
        }else{
            echo "an error has ocurred with the event color, please contact suport";
            $error = true;
        }
    }
    //inserting the event in the database
    if($error == false){
        $sql = "INSERT INTO event (IDu,name,date,color,situation)"
        . "VALUES ('$IDu','$name','$date','$color',true)";

        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//changing the event name
else if(isset($_POST["change_event_name"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }
    //checking the event name
    if($_POST["change_event_name"] == "" || $_POST["change_event_name"] == null){
        echo "name is blank or null";
        $error = true;
    }else{
        $name = mysqli_real_escape_string($connection, $_POST["change_event_name"]);
    }
    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event SET name = '$name' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//changing the event color
else if(isset($_POST["change_event_color"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //checking the event color
    if($_POST["change_event_color"] == "" || $_POST["change_event_color"] == null){
        echo "an error ocurred while getting the color";
        $error = true;
    }else{
        $color = $_POST["change_event_color"];
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event SET color = '$color' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//changing the event date
else if(isset($_POST["change_event_date"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //checking the event color
    if($_POST["change_event_date"] == "" || $_POST["change_event_date"] == null){
        echo "an error ocurred while getting the date";
        $error = true;
    }else{
        $date = $_POST["change_event_date"];
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event SET date = '$date' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//deleting an event
else if(isset($_POST["delete_event"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event SET situation = false WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}

/* ------------------------ADDONS CRUD------------------------ */
//implementing addons
else if(isset($_POST["addon"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //checking the addon type
    if($_POST["addon"] == "" || $_POST["addon"] == null){
        echo "an error ocurred while getting the addon";
        $error = true;
    }else{
        $addon = $_POST["addon"];
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        //adding location sql
        if($addon == "location"){
            $sql = "INSERT INTO event_has_location (IDu,IDe,location) "
            . "VALUES ('$IDu','$IDe','write here')";
        }
        //adding time sql
        else if($addon == "time"){
            $sql = "INSERT INTO event_has_time (IDu,IDe,time) "
            . "VALUES ('$IDu','$IDe','00:00:00')";
        }
        //adding description sql
        else if($addon == "description"){
            $sql = "INSERT INTO event_has_description (IDu,IDe,description) "
            . "VALUES ('$IDu','$IDe','write here')";
        }
        //adding transportation sql
        else if($addon == "transportation"){
            $sql = "INSERT INTO event_has_transport(IDu,IDe,vehicle,time) "
            . "VALUES ('$IDu','$IDe','1','00:00:00')";
        }
        //adding guests sql
        else if($addon == "guests"){
            $sql = "INSERT INTO event_has_guests (IDu,IDe,guests) "
            . "VALUES ('$IDu','$IDe','write here')";
        }

        //running the sql
        if ($connection->query($sql) === TRUE) {
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
/** ------------GUEST LIST------------ */
//changing the guest list
else if(isset($_POST["change_guests"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //getting the guest list
    //no need for verification since the guest list can be null
    $guests = $_POST["change_guests"];

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event_has_guests SET guests = '$guests' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//deleting the guest list
else if(isset($_POST["delete_guests"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "DELETE FROM event_has_guests WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
/** ------------TIME------------ */
//changing the event time
else if(isset($_POST["change_event_time"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //checking the event time
    if($_POST["change_event_time"] == "" || $_POST["change_event_time"] == null){
        echo "an error ocurred while getting the time";
        $error = true;
    }else{
        $time = $_POST["change_event_time"];
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event_has_time SET time = '$time' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//deleting the event time
else if(isset($_POST["delete_time"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "DELETE FROM event_has_time WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
/** ------------LOCATION------------ */
//changing the event location
else if(isset($_POST["change_event_location"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //the event location doesn't need checking since it can be blank
    $location = mysqli_real_escape_string($connection, $_POST["change_event_location"]);
    
    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event_has_location SET location = '$location' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//deleting the location
else if(isset($_POST["delete_location"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "DELETE FROM event_has_location WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
/** ------------DESCRIPTION------------ */
//changing the event description
else if(isset($_POST["change_event_description"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //the event description doesn't need checking since it can be blank
    $description = mysqli_real_escape_string($connection, $_POST["change_event_description"]);

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event_has_description SET description = '$description' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//deleting the description
else if(isset($_POST["delete_description"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "DELETE FROM event_has_description WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
/** ------------TRANSPORT------------ */
//changing the transport vehicle
else if(isset($_POST["change_transport_vehicle"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //checking the transport vehicle
    if($_POST["change_transport_vehicle"] == "" || $_POST["change_transport_vehicle"] == null){
        echo "an error ocurred while getting the transport vehicle";
        $error = true;
    }else{
        $vehicle = $_POST["change_transport_vehicle"];
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event_has_transport SET vehicle = '$vehicle' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//changing the transport time
else if(isset($_POST["change_transport_time"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //checking the transport time
    if($_POST["change_transport_time"] == "" || $_POST["change_transport_time"] == null){
        echo "an error ocurred while getting the transport time";
        $error = true;
    }else{
        $time = $_POST["change_transport_time"];
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "UPDATE event_has_transport SET time = '$time' WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
//deleting the transport
else if(isset($_POST["delete_transport"])){
    include_once "../backend/connection.php";
    $connection = connect();
    //getting the user ID
    session_start();
    $error = false;
    if(isset($_SESSION["IDu"])){
        $IDu = $_SESSION["IDu"];
    }else{
        //in case the program is unable to access the ID
        echo "an error has ocurred with the current section, please log out and try again, if the error persists, contact suport";
        $error = true;
    }

    //getting the IDe
    if($_POST["IDe"] == "" || $_POST["IDe"] == null){
        echo "IDe is blank or null";
        $error = true;
    }else{
        $IDe = $_POST["IDe"];
    }

    if($error == false){
        $sql = "DELETE FROM event_has_transport WHERE (`IDe` = '$IDe') AND (`IDu` = '$IDu')";
        
        if ($connection->query($sql) === TRUE) {
            //$IDe = $connection->insert_id;
            echo "success";
        }else{
            return "the following error has ocurred: Error: " . $sql . "<br>" . $conexao->error . "<br>Please contact suport";
        }
    }
}
?>