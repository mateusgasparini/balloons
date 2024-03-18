$(document).ready(function(){
    $('.sidenav').sidenav();
    $('.modal').modal();
});

$(window).on("scroll", function() {
    if ($(window).scrollTop()) {
        $('nav').addClass('change');
    } else {
        $('nav').removeClass('change');
    }
});