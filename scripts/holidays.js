//new planning on submit (creating a new event)
$(function() {
    $("#new_planning").on("submit", function(event) {
        event.preventDefault();
        
        //sending the informations via AJAX to check the informations
        var formData = {
            'new_event_name': $('#new_event_name').val(),
            'new_event_date': $('#new_event_date').val(),
            'new_event_color': $('#new_event_color').val(),
            'new_event': true
        };
        console.log(formData);
        
        $.ajax({
            url: "../backend/holidays.php",
            type: "post",
            data: formData,
            success: function(d) {
                if(d == "success"){
                    location.reload()
                }else{
                    document.querySelector("#new_planning_error").innerHTML = d;
                }
            }
        });

    });
});

//delete event
function delete_event(IDe){
    //sending the informations via AJAX to check the informations
    var formData = {
        'IDe': IDe,
        'delete_event': true
    };
    console.log(formData);
    
    $.ajax({
        url: "../backend/holidays.php",
        type: "post",
        data: formData,
        success: function(d) {
            if(d == "success"){
                location.reload();
            }else{
                console.log(d);
            }
        }
    });
}

//event name on change
$('.event_name_section textarea').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("event_name_").pop()
    
    //sending AJAX to change the event name
    var formData = {
        'change_event_name': $(this).val(),
        'IDe': IDe
    };
    console.log(formData);
    
    $.ajax({
        url: "../backend/holidays.php",
        type: "post",
        data: formData,
        success: function(d) {
            if(d != "success"){
                console.log(d);
            }
        }
    });
});

//event color on change
$('.event_color').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("event_color_").pop()
    
    //sending AJAX to change the event name
    var formData = {
        'change_event_color': $(this).val(),
        'IDe': IDe
    };
    console.log(formData);
    
    $.ajax({
        url: "../backend/holidays.php",
        type: "post",
        data: formData,
        success: function(d) {
            if(d == "success"){
                location.reload();
            }else{
                console.log(d);
            }
        }
    });
});

//event color on change
$('.event_date').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("event_date_").pop()
    
    //sending AJAX to change the event name
    var formData = {
        'change_event_date': $(this).val(),
        'IDe': IDe
    };
    console.log(formData);
    
    $.ajax({
        url: "../backend/holidays.php",
        type: "post",
        data: formData,
        success: function(d) {
            if(d != "success"){
                console.log(d);
            }
        }
    });
});


//showing the add=ons of a especific event
function show_addons_area(IDe){
    $('#add_ons_area_'+IDe).animate({bottom: '0px'},"fast");
    $('#add_ons_trigger_'+IDe+' i').removeClass('fa-solid fa-caret-up');
    $('#add_ons_trigger_'+IDe+' i').addClass('fa-solid fa-caret-down');

    $('#add_ons_trigger_'+IDe).attr("onclick","hide_addons_area("+IDe+")")
}
//hiding the add=ons of a especific event
function hide_addons_area(IDe){
    $('#add_ons_area_'+IDe).animate({bottom: '-40px'},"fast");
    $('#add_ons_trigger_'+IDe+' i').removeClass('fa-solid fa-caret-down');
    $('#add_ons_trigger_'+IDe+' i').addClass('fa-solid fa-caret-up');

    $('#add_ons_trigger_'+IDe).attr("onclick","show_addons_area("+IDe+")")
}