// checking if the password requirements are met

// this function will be triggered every time a character is 
// add or remove from the paswsword input

$('#new_password').keyup(function(){
    //getting the password
    var password = $('#new_password').val();
    
    //checking if the password has the right amount of characteres
    if(password.trim().length <= 18 && password.trim().length >= 6){
        //case it does
        if($('#total_of_characteres').attr('class') == 'not_met'){
            $('#total_of_characteres').removeClass("not_met");
            $('#total_of_characteres').addClass("met");

            $('#total_of_characteres i').removeClass("fa-solid fa-circle-xmark");
            $('#total_of_characteres i').addClass("fa-solid fa-circle-check");
        }
    }else{
        //case it doesn't
        if($('#total_of_characteres').attr('class') == 'met'){
            $('#total_of_characteres').addClass("not_met");
            $('#total_of_characteres').removeClass("met");

            $('#total_of_characteres i').removeClass("fa-solid fa-circle-check");
            $('#total_of_characteres i').addClass("fa-solid fa-circle-xmark");
        }
    }

    //checking if the password contain lowercase letters
    if((/[a-z]/.test(password)) == true){
        //case it does
        if($('#lowercase').attr('class') == 'not_met'){
            $('#lowercase').removeClass("not_met");
            $('#lowercase').addClass("met");

            $('#lowercase i').removeClass("fa-solid fa-circle-xmark");
            $('#lowercase i').addClass("fa-solid fa-circle-check");
        }
    }else{
        //case it doesn't
        if($('#lowercase').attr('class') == 'met'){
            $('#lowercase').addClass("not_met");
            $('#lowercase').removeClass("met");

            $('#lowercase i').removeClass("fa-solid fa-circle-check");
            $('#lowercase i').addClass("fa-solid fa-circle-xmark");
        }
    }

    //checking if the password contain capital letters
    if((/[A-Z]/.test(password)) == true){
        //case it does
        if($('#capital').attr('class') == 'not_met'){
            $('#capital').removeClass("not_met");
            $('#capital').addClass("met");

            $('#capital i').removeClass("fa-solid fa-circle-xmark");
            $('#capital i').addClass("fa-solid fa-circle-check");
        }
    }else{
        //case it doesn't
        if($('#capital').attr('class') == 'met'){
            $('#capital').addClass("not_met");
            $('#capital').removeClass("met");

            $('#capital i').removeClass("fa-solid fa-circle-check");
            $('#capital i').addClass("fa-solid fa-circle-xmark");
        }
    }

    //checking if the password contain numbers
    if((/[0-9]/.test(password)) == true){
        //case it does
        if($('#numbers').attr('class') == 'not_met'){
            $('#numbers').removeClass("not_met");
            $('#numbers').addClass("met");

            $('#numbers i').removeClass("fa-solid fa-circle-xmark");
            $('#numbers i').addClass("fa-solid fa-circle-check");
        }
    }else{
        //case it doesn't
        if($('#numbers').attr('class') == 'met'){
            $('#numbers').addClass("not_met");
            $('#numbers').removeClass("met");

            $('#numbers i').removeClass("fa-solid fa-circle-check");
            $('#numbers i').addClass("fa-solid fa-circle-xmark");
        }
    }
    
    //checking if the password contain numbers
    var specialChars = "!@#-_";
    var has_special_character = false;
    for(i = 0; i < specialChars.length;i++){
        if(password.indexOf(specialChars[i]) != -1){
            //case it does
            var has_special_character = true;
        }
    }
    if(has_special_character == true){
        //case it does
        if($('#specials').attr('class') == 'not_met'){
            $('#specials').removeClass("not_met");
            $('#specials').addClass("met");

            $('#specials i').removeClass("fa-solid fa-circle-xmark");
            $('#specials i').addClass("fa-solid fa-circle-check");
        }
    }else{
        //case it doesn't
        if($('#specials').attr('class') == 'met'){
            $('#specials').addClass("not_met");
            $('#specials').removeClass("met");

            $('#specials i').removeClass("fa-solid fa-circle-check");
            $('#specials i').addClass("fa-solid fa-circle-xmark");
        }
    }
})

//just a design function to make the requirements area hide and show
$('#new_password').focusin(function(){
    $('#requirements_area').slideDown();
});

//checking if a valid email has been informed
const validateEmail = (email) => {
    return email.match(
      /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};
  
const validate = () => {
    const $result = $('#email_error');
    const email = $('#new_email').val();
    $result.text('');
  
    if(!validateEmail(email)){
        document.querySelector("#email_error").innerHTML = "<i class='fa-solid fa-circle-xmark'></i>" +
        " please inform a valid email";
    }else{
        //using to AJAX to verify if email already exists
        var formData = {
            'email': $("#new_email").val(),
            'verify_email': true
        };
        console.log(formData);
        
        $.ajax({
            url: "backend/signup.php",
            type: "post",
            data: formData,
            success: function(d) {
                if(d === "in use"){
                    document.querySelector("#email_error").innerHTML = "<i class='fa-solid fa-circle-xmark'></i>" +
                    " this email is already being used";
                }
            }
        });
    }
    return false;
}
  
$('#new_email').on('input', validate);

//when the sign up form is send
$(function() {
    $("#signup").on("submit", function(event) {
        event.preventDefault();
        var error = false;
        //checking if the email was informed
        email = $('#new_email').val();
        if(!validateEmail(email)){
            alert('please inform a valid email');
            error = true;
        }else{
            //using to AJAX to verify if email already exists
            var formData = {
                'email': $("#new_email").val(),
                'verify_email': true
            };
            console.log(formData);
            
            $.ajax({
                url: "backend/signup.php",
                type: "post",
                data: formData,
                success: function(d) {
                    if(d === "in use"){
                        alert('this email is already being used');
                        error = true;
                    }else{
                        error = false;
                        //checking if the password fulfill all the requirements
                        if( $('#total_of_characteres').hasClass('not_met') ||
                            $('#lowercase').hasClass('not_met') ||
                            $('#capital').hasClass('not_met') ||
                            $('#numbers').hasClass('not_met') ||
                            $('#specials').hasClass('not_met')
                        ){
                            alert('please inform a valid password');
                            error = true;
                        }
                        //submiting the form
                        if(error == false){
                            var formData = {
                                'email': $("#new_email").val(),
                                'password': $("#new_password").val(),
                                'signup': true
                            };
                            console.log(formData);
                            
                            $.ajax({
                                url: "backend/signup.php",
                                type: "post",
                                data: formData,
                                success: function(d) {
                                    if(d === "success"){
                                        location.reload();
                                    }else{
                                        console.log(d);
                                    }
                                }
                            });
                        }
                    }
                }
            });
        }

    });
});

//when the log in form is send
$(function() {
    $("#login").on("submit", function(event) {
        event.preventDefault();
        document.querySelector("#login_error").innerHTML = "";
        setTimeout(function(){
            var formData = {
                'email': $("#email").val(),
                'password': $("#password").val()
            };
            console.log(formData);
            
            $.ajax({
                url: "backend/login.php",
                type: "post",
                data: formData,
                success: function(d) {
                    if(d === "success"){
                        location.reload();
                    }else{
                        document.querySelector("#login_error").innerHTML = "email and password don't match";
                    }
                }
            });
        }, 500);
    });
});