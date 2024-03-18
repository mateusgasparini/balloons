<?php 
    include_once "connection.php";
    $connection = connect();

    $email = $_POST["email"];
    $password = hash("sha3-224",$_POST['password']);

    $sql = "SELECT IDu FROM user WHERE (`email` = '$email') AND (`password` = '$password')";
    $query = mysqli_query($connection,$sql);
    if(mysqli_num_rows($query)>0){
        $user = mysqli_fetch_assoc($query);
        $IDu = $user["IDu"];
        
        session_start();
        $_SESSION["IDu"] = $IDu;
        echo "success";
    }else{
        echo "error";
    }

?>