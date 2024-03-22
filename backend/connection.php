<?php
function connect(){  
    $connection=mysqli_connect("127.0.0.1:3306", "root", "","balloons") or die("Erro ao conectar");
    
    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET character_set_connection=utf8");
    mysqli_query($connection, "SET character_set_client=utf8");
    mysqli_query($connection, "SET character_set_results=utf8");
    
    return $connection;
}
?>