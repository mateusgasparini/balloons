//starting the selects
$(document).ready(function(){
    $('select').formSelect();
});

//auto grown for textarea
function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}

/** -------------------------------EVENT CRUD TRIGGERS------------------------------- */
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
//event date on change
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


//showing the addons of a especific event
function show_addons_area(IDe){
    $('#addons_buttons_area_'+IDe).slideDown("fast");
    $('#addons_trigger_'+IDe).removeClass('fa-solid fa-caret-up');
    $('#addons_trigger_'+IDe).addClass('fa-solid fa-caret-down');

    $('#addons_trigger_'+IDe).attr("onclick","hide_addons_area("+IDe+")")
}
//hiding the addons of a especific event
function hide_addons_area(IDe){
    $('#addons_buttons_area_'+IDe).slideUp("fast");
    $('#addons_trigger_'+IDe).removeClass('fa-solid fa-caret-down');
    $('#addons_trigger_'+IDe).addClass('fa-solid fa-caret-up');

    $('#addons_trigger_'+IDe).attr("onclick","show_addons_area("+IDe+")")
}

/** -------------------------------ADDONS CRUD TRIGGERS------------------------------- */
//inserting addons
function add_addon(IDe, addon){
    //sending AJAX to add location
    var formData = {
        'addon': addon,
        'IDe': IDe
    };
    
    $.ajax({
        url: "../backend/holidays.php",
        type: "post",
        data: formData,
        success: function(d) {
            if(d == "success"){
                location.reload()
            }else{
                console.log(d);
            }
        }
    });
}
/** ------------- GUEST LIST ------------- */
//showing the guest lits of especific event
function show_guest_list(IDe){
    $('#guest_list_'+IDe).animate({left: '0%'},"fast");

    $('#guests_button_'+IDe).attr("onclick","hide_guest_list("+IDe+")")
}
//showing the guest lits of especific event
function hide_guest_list(IDe){
    $('#guest_list_'+IDe).animate({left: '-100%'},"fast");

    $('#guests_button_'+IDe).attr("onclick","show_guest_list("+IDe+")")
}
//guests on change
$('.guests').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("guests_").pop()
    
    //sending AJAX to change the event name
    var formData = {
        'change_guests': $(this).val(),
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
//deleting the guest list
function delete_guest_list(IDe){
    var formData = {
        'delete_guests': true,
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
}
/** -------------TIME------------- */
//event time on change
$('.event_time').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("event_time_").pop()
    
    //sending AJAX to change the event name
    var formData = {
        'change_event_time': $(this).val(),
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
//deleting the time
function delete_time(IDe){
    var formData = {
        'delete_time': true,
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
}
/** -------------LOCATION------------- */
//event location on change
$('.event_location').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("event_location_").pop()
    
    //sending AJAX to change the event location
    var formData = {
        'change_event_location': $(this).val(),
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
//deleting the location
function delete_location(IDe){
    var formData = {
        'delete_location': true,
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
}
/** -------------DESCRIPTION------------- */
//event description on change
$('.event_description').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("event_description_").pop()
    
    //sending AJAX to change the event description
    var formData = {
        'change_event_description': $(this).val(),
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
//deleting the description
function delete_description(IDe){
    var formData = {
        'delete_description': true,
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
}
/** -------------TRANSPORT------------- */
//transport vehicle on change
$('.transport_vehicle').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("transport_vehicle_").pop()
    
    //sending AJAX to change the event description
    var formData = {
        'change_transport_vehicle': $(this).val(),
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
//transport time on change
$('.transport_time').on('change', function(){
    var id = $(this).attr("id");
    var IDe = id.split("transport_time_").pop()
    
    //sending AJAX to change the event description
    var formData = {
        'change_transport_time': $(this).val(),
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
//deleting the transport
function delete_transport(IDe){
    var formData = {
        'delete_transport': true,
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
}