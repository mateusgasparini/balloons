<?php
    session_start();
//when submiting the form to add a new user
    if(isset($_POST["signup"])){
        $password = hash("sha3-224",$_POST['password']);
        $email = $_POST["email"];

        include_once "connection.php";
        $connection = connect();

        $sql = "INSERT INTO user (email, password) VALUES ('$email','$password')";

        if ($connection->query($sql) === TRUE) {
            $IDu = $connection->insert_id;
            
            $_SESSION["IDu"] = $IDu;

            echo "success";
        }else{
            return "Error: " . $sql . "<br>" . $connection->error;
        }
    }
//whe using ajax to check if the email already exists in the database
    else if(isset($_POST["verify_email"])){
        $email = $_POST["email"];

        include_once "connection.php";
        $connection = connect();

        $sql = "SELECT * FROM user WHERE (`email` = '$email')";
        $query = mysqli_query($connection,$sql);
        if(mysqli_num_rows($query) > 0){
            echo "in use";
        }else{
            echo "free";
        }
    }
?>