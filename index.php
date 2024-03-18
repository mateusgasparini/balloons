<!-- 

WELCOME to Ballons!
The best planning tool on the internet

Due to the simple nature of this aplication, i decided to make the index both
the login and the register page, to login just press the button on the navbar 
and a modal will appear, and to register simply fill your data and press the 
button.

--><!--  -->

<!-- Redirecting the user in case it's already log in -->
<?php 
    session_start();
    if(isset($_SESSION["IDu"])){
        header("Location:frontend/callendar.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- page name and icon -->
    <title>Ballons - your planning tool</title>
    <link rel="icon" type="image/x-icon" href="assets/logos/mint_capital.png">

    <!-- Getting the styles links -->
    <?php
        echo "
        <!-- Font Awesome -->
        <script src='https://kit.fontawesome.com/56cf60eba9.js' crossorigin='anonymous'></script>";

        echo"
        <!-- Materialize CSS -->
        <link rel='stylesheet' href='styles/materialize.css?v="; include 'backend/version.php'; echo"'>";

        echo"
        <!-- Root CSS -->
        <link rel='stylesheet' href='styles/root.css?v="; include 'backend/version.php'; echo"'>";

        echo"
        <!-- This Page CSS -->
        <link rel='stylesheet' href='styles/index.css?v="; include 'backend/version.php'; echo"'>";
    ?>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar-fixed">
        <nav class="nav-extended">
            <div class="nav-wrapper" id="defined_heigth">
            <a href="index.php" class="brand-logo"><img src="assets/logos/white_capital.png" alt="navbar logo"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="fa-solid fa-bars"></i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a class="modal-trigger" href="#login_modal">log in</a></li>
            </ul>
            </div>
        </nav>
    </div>
    <ul class="sidenav" id="mobile-demo">
        <li><a class="modal-trigger" href="#login_modal">log in</a></li>
    </ul>
    <!-- Page Content -->
    <main>
        <div class="container z-depth-1 center" id="register_area">
            <!-- logo and catch phrase-->
            <img id="main_logo" src="assets/logos/mint_full_logo.png" alt="main logo">

            <h1>feel free to plan</h1>
            <h2>register for free</h2>

            <!-- Sign Up form -->
            <form id="signup" action="backend/signup.php" method="POST">
                <!-- email input -->
                <div class="input-field row">
                    <input id="new_email" name="new_email" type="email" maxlength="100">
                    <label for="new_email">Email</label>

                    <p id="email_error"></p>
                </div>
                <!-- password input -->
                <div class="input-field row">
                    <input id="new_password" name="new_password" type="password" autocomplete="new-password" 
                    maxlength="18"  minlength="6">
                    <label for="new_password">Password</label>

                    <p id="password_error"></p>
                </div>
                <!-- requirements area -->
                <div class="row" id="requirements_area">
                    <p class="not_met" id="total_of_characteres">
                        <i class="fa-solid fa-circle-xmark"></i> betwen 6 and 18 characteres</p>
                    
                    <p class="not_met" id="lowercase">
                        <i class="fa-solid fa-circle-xmark"></i> at least one lowercase letter</p>
                    
                    <p class="not_met" id="capital">
                        <i class="fa-solid fa-circle-xmark"></i> at least one capital letter</p>
                    
                    <p class="not_met" id="numbers">
                        <i class="fa-solid fa-circle-xmark"></i> at least one number</p>
                    
                    <p class="not_met" id="specials">
                        <i class="fa-solid fa-circle-xmark"></i> at least one especial character (!, @, #, -, _)</p>
                </div>

                <div class="row">
                    <button class="btn waves-effect waves-light" id="sign_up_button" type="submit" name="action">
                        sign up
                    </button>
                </div>
            </form> 
        </div>
    </main>
    <!-- Modals -->

        <!-- Log In Modal -->
        <div id="login_modal" class="modal">
            <div class="modal-content">
                <img id="modal_capital" src="assets/logos/white_capital.png" alt="">
                <h3>Log In</h3>

                <!-- Sign Up form -->
                <form id="login" action="backend/login.php" method="POST">
                    <!-- email input -->
                    <div class="input-field row">
                        <input id="email" name="email" type="email" maxlength="100">
                        <label for="email">Email</label>
                    </div>
                    <!-- password input -->
                    <div class="input-field row">
                        <input id="password" name="password" type="password" minlength="6" maxlength="18">
                        <label for="password">Password</label>
                    </div>
                    <!-- error message -->
                    <div class="row">
                        <p id="login_error"></p>
                    </div>

                    <div class="row center">
                        <button class="btn waves-effect waves-light" id="sign_up_button" type="submit" name="action">
                            log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>

<!-- Getting the scripts links -->
<?php 

    echo"
    <!-- Jquery -->
    <script src='https://code.jquery.com/jquery-3.7.1.js' integrity='sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=' crossorigin='anonymous'></script>";

    echo"
    <!-- Materialize JS -->
    <script src='scripts/materialize.js?v="; include 'backend/version.php'; echo"'></script>";

    echo"
    <!-- Root JS -->
    <script src='scripts/root.js?v="; include 'backend/version.php'; echo"'></script>";

    echo"
    <!-- This Page JS -->
    <script src='scripts/index.js?v="; include 'backend/version.php'; echo"'></script>";

?>
</html>