<!-- 



--><!--  -->

<!-- Redirecting the user in case it's not logged -->
<?php 
    session_start();
    if(!isset($_SESSION["IDu"])){
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
        <link rel='stylesheet' href='../styles/menu.css?v="; include '../backend/version.php'; echo"'>";
    ?>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar-fixed">
        <nav class="nav-extended">
            <div class="nav-wrapper" id="defined_heigth">
                <a href="#" class="brand-logo"><img src="../assets/logos/white_capital.png" alt="navbar logo"></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="../backend/logout.php">exit</a></li>
                </ul>
            </div>
            <div class="nav-content">
                <ul class="tabs tabs-transparent">
                    <li class="tab"><a href="callendar.php">callendar</a></li>
                    <li class="tab"><a class="active" href="holidays.php">my holidays</a></li>
                </ul>
            </div>
        </nav>
    </div>

    <ul class="sidenav" id="mobile-demo">
        <li><a href="../backend/logout.php">exit</a></li>
    </ul>
    <!-- Page Content -->

    <!-- Modals -->
</body>

<!-- getting the scripts links -->
<?php 

    include_once "../backend/js_puller.php";

    echo"
    <!-- This Page JS -->
    <script src='../script/menu.js?v="; include '../backend/version.php'; echo"'></script>";

?>
</html>