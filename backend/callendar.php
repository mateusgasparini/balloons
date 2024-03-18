<?php 

if(isset($_POST["change_days_minimized"])){
    //getting the next month and current year
    $month = $_POST["month"];
    $year = $_POST["year"];

    //getting the 1º date of the month of the current month 
    $dayofweek = date('w', strtotime($year."-".$month."-01"));
    //getting the number of days of the month
    $number_of_days = date('t', strtotime($year."-".$month."-01"));
    //printing the current month calendar minimized
    //this for will add the necessary quantity of blank spaces before the first day, so that the week subtitle work
    for($i = 0; $i<$dayofweek; $i++){
        echo "<div class='day_minimized filler'></div>";
    }
    //this for will add the days of this month
    for($i = 1; $i <= $number_of_days; $i++){
        echo "<a onclick='maximize($i)' class='day_minimized' id='day_$i'>" .sprintf("%02d", $i) ."</a>";
    }
}else if(isset($_POST["change_days_maximized"])){
    //getting the month and year
    $month = $_POST["month"];
    $year = $_POST["year"];
    //getting the number of days of the month
    $number_of_days = date('t');
    //printing the current month calendar minimized
    //this for will add the days of this month into the carousel
    for($i = 1; $i <= $number_of_days; $i++){
        //getting the day of the week of the current day
        $dayofweek_number = date('w', strtotime($year."-".$month."-". $i));
        if($dayofweek_number == 0){
            $dayofweek_name = "sun";
        }else if($dayofweek_number == 1){
            $dayofweek_name = "mon";
        }else if($dayofweek_number == 2){
            $dayofweek_name = "tue";
        }else if($dayofweek_number == 3){
            $dayofweek_name = "wed";
        }else if($dayofweek_number == 4){
            $dayofweek_name = "thu";
        }else if($dayofweek_number == 5){
            $dayofweek_name = "fri";
        }else if($dayofweek_number == 6){
            $dayofweek_name = "sat";
        }
        //printing the day on the carousel
        echo"
        <div class='carousel-item day_maximized_$i' id='day_maximized'>
            <a onclick='minimize()' class='minimize_button'><i class='fa-solid fa-down-left-and-up-right-to-center'></i></a>
            <h1>$dayofweek_name</h1>
            <h2>" .sprintf("%02d", $i) ."</h2>
        </div>";
    }
}

?>