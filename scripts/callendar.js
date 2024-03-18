$(document).ready(function(){
    $('#carousel_wrapper').hide();
})

function next_month(){
    //getting the variables
    var month = parseInt($('#current_month').val()) + 1;
    //in case the year change
    if(month == 13){
        month = 1;
        var year = parseInt($('#current_year').val()) + 1;
        document.querySelector('#year_view').innerHTML = "<h1>" + year + "</h1>" +
        "<input type='hidden' id='current_year' value='" + year + "'>";
    }
    //getting the new month name
    if(month == 1){
        var month_name = "<h1>january</h1>";
    }else if(month == 2){
        var month_name = "<h1>february</h1>";
    }else if(month == 3){
        var month_name = "<h1>march</h1>";
    }else if(month == 4){
        var month_name = "<h1>april</h1>";
    }else if(month == 5){
        var month_name = "<h1>may</h1>";
    }else if(month == 6){
        var month_name = "<h1>july</h1>";
    }else if(month == 7){
        var month_name = "<h1>june</h1>";
    }else if(month == 8){
        var month_name = "<h1>august</h1>";
    }else if(month == 9){
        var month_name = "<h1>september</h1>";
    }else if(month == 10){
        var month_name = "<h1>october</h1>";
    }else if(month == 11){
        var month_name = "<h1>november</h1>";
    }else if(month == 12){
        var month_name = "<h1>december</h1>";
    }
    //printing the new month name
    document.querySelector('#month_h1').innerHTML = month_name +
        "<input type='hidden' id='current_month' value='" + month + "'>";
    //changing the days
    change_days_mimimized();
    change_days_maximized();
}
function previous_month(){
    //getting the variables
    var month = parseInt($('#current_month').val()) - 1;
    //in case the year change
    if(month == 0){
        month = 12;
        var year = parseInt($('#current_year').val()) - 1;
        document.querySelector('#year_view').innerHTML = "<h1>" + year + "</h1>" +
        "<input type='hidden' id='current_year' value='" + year + "'>";
    }
    //getting the new month name
    if(month == 1){
        var month_name = "<h1>january</h1>";
    }else if(month == 2){
        var month_name = "<h1>february</h1>";
    }else if(month == 3){
        var month_name = "<h1>march</h1>";
    }else if(month == 4){
        var month_name = "<h1>april</h1>";
    }else if(month == 5){
        var month_name = "<h1>may</h1>";
    }else if(month == 6){
        var month_name = "<h1>july</h1>";
    }else if(month == 7){
        var month_name = "<h1>june</h1>";
    }else if(month == 8){
        var month_name = "<h1>august</h1>";
    }else if(month == 9){
        var month_name = "<h1>september</h1>";
    }else if(month == 10){
        var month_name = "<h1>october</h1>";
    }else if(month == 11){
        var month_name = "<h1>november</h1>";
    }else if(month == 12){
        var month_name = "<h1>december</h1>";
    }
    //printing the new month name
    document.querySelector('#month_h1').innerHTML = month_name +
        "<input type='hidden' id='current_month' value='" + month + "'>";
    
    //changing the days
    change_days_mimimized();
    change_days_maximized();
    $('.carousel.carousel-slider').carousel();
}

function change_days_mimimized(){
    var formData = {
        'month': parseInt($('#current_month').val()),
        'year': parseInt($('#current_year').val()),
        'change_days_minimized': true
    };
    console.log(formData);
    
    $.ajax({
        url: "../backend/callendar.php",
        type: "post",
        data: formData,
        success: function(d) {
            document.querySelector('#days_minimized_area').innerHTML = d;
        }
    });
}
function change_days_maximized(){
    var formData = {
        'month': parseInt($('#current_month').val()),
        'year': parseInt($('#current_year').val()),
        'change_days_maximized': true
    };
    console.log(formData);
    
    $.ajax({
        url: "../backend/callendar.php",
        type: "post",
        data: formData,
        success: function(d) {
            document.querySelector('#days_maximized_area').innerHTML = d;
            $('.carousel.carousel-slider').carousel({
                numVisible: 5,
            });
        }
    });
}

function minimize(){
    $('#carousel_wrapper').slideUp("slow");
    $('#callendar_wrapper').slideDown("slow");
}
function maximize(focus){
    $('#callendar_wrapper').slideUp("slow");
    $('#carousel_wrapper').slideDown("slow");
    $('.carousel.carousel-slider').carousel({
        numVisible: 5,
    });

    var instance = M.Carousel.getInstance($('.carousel.carousel-slider'));
    instance.set(focus-1);
}