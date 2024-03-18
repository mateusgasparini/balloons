<?php
echo"
<!-- Jquery -->
<script src='https://code.jquery.com/jquery-3.7.1.js' integrity='sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=' crossorigin='anonymous'></script>";

echo"
<!-- Materialize JS -->
<script src='../scripts/materialize.js?v="; include '../backend/version.php'; echo"'></script>";

echo"
<!-- Root JS -->
<script src='../scripts/root.js?v="; include '../backend/version.php'; echo"'></script>";
?>