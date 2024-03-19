<?php 
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
?>