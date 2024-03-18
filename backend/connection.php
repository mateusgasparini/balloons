<?php
function connect(){  
    $conexao=mysqli_connect("127.0.0.1:3306", "root", "","balloons") or die("Erro ao conectar");
    
    mysqli_query($conexao, "SET NAMES 'utf8'");
    mysqli_query($conexao, "SET character_set_connection=utf8");
    mysqli_query($conexao, "SET character_set_client=utf8");
    mysqli_query($conexao, "SET character_set_results=utf8");
    
    return $conexao;
}
?>