$(document).ready(function(){

    $('#sendContact').click(function(event){

        event.preventDefault();

        $(this).prop('disabled', true);

        var email = $('#email').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var subj = $('#subj').val();
        var message = $('#message').val();
        var error = "";

        if(!email){
            error += "<li>Please Enter a valid E-Mail</li>";
        }

        if(!fname){
            error += "<li>Please Enter your Firstname</li>";
        }

        if(!lname){
            error += "<li>Please Enter your Lastname</li>";
        }

        if(!subj){
            error += "<li>Please choose a Subject</li>";
        }

        if(error){

            alert(error);
            $(this).prop('disabled', false);

        } else {


            $.ajax({
                type: "POST",
                data: {email: email, fname: fname, lname: lname, subj: subj, message: message},
                url: "modul/kontakt/sendForm.php",
                success: function(data){
                    if(data){

                        alert(data);
                        $(this).prop('disabled', false);

                    } else {

                        $('.formArea').slideUp('slow', function(){
                            $('.alert-success').slideDown('slow');
                        });

                    }
                }
            });

        }

    });

});
