$(document).ready(function(){

    $("#addUser").click(function(event){

        event.preventDefault();
        var error = "";
        var bkey = $("#usrFormBkey").val();
        var group = $("#usrFormGroup").val();

        if(bkey.length != 7){
            error = error + "<li>" + translate[153]+"</li>";
        }

        if(!group){
            error = error + "<li>" + translate[154]+"</li>";
        }

        if(error){
            $("#errorText").html(error);
            $("#errorAlert").slideDown("fast");
        } else {

			$(this).prop("disabled",true);
            $("#errorAlert").slideUp("fast");

            $.ajax({
                method: "POST",
                url: "./modul/benutzerverwaltung/modifyUser.php",
                data: {action:"add", bkey:bkey, group:group},
                success: function(data){

                    if(data){
                        $("#errorText").html(data);
                        $("#errorAlert").slideDown("fast");
                    } else {

                        $(".addUserInput").val("");
                        $("#successText").html(translate[101]);
                        $("#successAlert").slideDown("fast").delay(1000).slideUp("fast",function(){

                            $("#pageContent").load("modul/benutzerverwaltung/benutzerverwaltung.php", function(){
                                $('.loadScreen').fadeTo("fast", 0, function(){
                                    $('#pageContents').fadeTo("fast", 1);
                                });
                            });
                        });

                    }

                }
            });

        }


    });

    var typingTimer;
    var doneTypingInterval = 2000;

    $('.changeInTable').each(function(){


        $(this).on('keydown', function () {
            clearTimeout(typingTimer);
        });

        $(this).on("keyup", function(){

            $('#loadingTable').slideDown("fast");

            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);

            var usrID = $(this).attr("usrid");
            var fType = $(this).attr("fType");
            var content = $(this).val();

            if(usrID && fType){
                event.preventDefault();
                $.ajax({
                    async: true,
                    method: "POST",
                    url: "./modul/benutzerverwaltung/modifyUser.php",
                    data: {action:"change", userid:usrID, fType:fType, content:content},
                    success: function(data){
                        if(data){
                            $("#errorAlert").html(data).slideDown("fast");
                        } else {
                            $('#check'+ usrID).fadeTo("fast", 1);
                        }
                    }
                });
            }

        });


    });

    var notdone = 0;

    function doneTyping() {

        if ($.active == 0){

            $('#loadingTable').slideUp("fast");
            $("#successText").html(translate[101]);
            $("#successAlert").slideDown("fast").delay(1400).slideUp("fast");

        } else {
            notdone = 1;
        }
    }

    $(document).ajaxStop(function(){
        if(notdone == 1){
            $('#loadingTable').slideUp("fast");
            $("#successText").html(translate[101]);
            $("#successAlert").slideDown("fast").delay(1400).slideUp("fast");
        }
    });



    $(".fa-trash-o").each(function(){

        $(this).hover(function() {
            $(this).css( 'cursor', 'pointer' );
        });

        $(this).click(function(){

            var usrid = $(this). attr('id');
            var bkey = $(this). attr('bkey');

            $("#warningText").html("<strong>" + translate[97] + "</strong> " + translate[98] + ": " + bkey);
            $("#warningAlert").slideDown("fast");
            $("#warningButton").slideDown("fast");
            $("#warningButton").click(function(event){
                if(usrid){

					$(this).prop("disabled",true);
                    event.preventDefault();

                    $.ajax({
                        method: "POST",
                        url: "./modul/benutzerverwaltung/modifyUser.php",
                        data: {action:"delete", userid:usrid},
                        success: function(data){
                            if(data){

                            } else {
                                $("#rowID" + usrid).slideUp("slow");
                                $("#warningAlert").slideUp("fast");
								$("#warningButton").prop("disabled",false);
                            }
                        }
                    });

                }
            });



        });

    });


});
