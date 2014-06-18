/*
 author: istockphp.com
 */
jQuery(function($) {
    var val_holder;

    $("form input[name='register']").click(function() { // triggred click

        /************** form validation **************/
        val_holder = 0;
        
        alert("checking");
        if (!$('#checkUs').is(':checked')) {
            $("p.checkUs_val").html("You must accept rules in order to complete this registration.");
            val_holder = 1;
            alert("oops");
        }
        if (val_holder == 1) {
            return false;
        }
        val_holder = 0;
        /************** form validation end **************/

        $.ajax({
            type: 'post',
            url: 'admin/data/sample-register-form.php',
            data: {
                
                wichOne: $("#wichOne").html(),
                first_name: $("input#first_name").val(),
                last_name: $("input#last_name").val(),
                nationality: $("#nationality option:selected").val(),
                phone: $("input#tel").val(),
                adress: $("input#address_line").val(),
                country: $("#country option:selected").val(),
                city: $("input#city").val(),
                zip: $("input#zip").val(),
                resume: $("#about").val(),
                
                
                institution: $("input:radio[name=institution]:checked" ).val(),
                institutionName: $("#institutionName").val(),
                laboratory: $("#laboratory").val(),
                workteam: $("#workteam").val(),
                favThemes: $("#favThemes").val() || [],
                
                hotel: $("input#hotels:checked" ).val(),
                checkInOut: $('#checkInOut').text(),
                roomType: $( "#roomType" ).val(),         
                arrivalTime: $("input#arrivalTime").val(),
                
                email: $("input#email").val(),
                password: $("input#password").val()
            },
            success: function(responseText) { // get the response
                if (responseText == 1) { // if the response is 1
                    $("p.email_exist").html("Email are already exist.");
                } else { // else blank response
                    if (responseText == "") {
                        $("p.email_exist").html("You are registred. redirecting...");
                        setTimeout(function() { // deley
                            
                            window.location = 'success.php' ; // redirect

                        }, 1500); // 1,5 sec
                    }
                    else{
                         setTimeout(function() { // deley
                            
                            window.location = 'success.php' ; // redirect

                        }, 1500); // 1,5 sec
                    }
                }
            } // end success
        }); // ajax end
        /************** end: email exist function and etc. **************/
    }); // click end
}); // jquery end