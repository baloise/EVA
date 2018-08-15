$(document).ready(function(){

    $('#searchInput').on('keyup', function(){

        var input, filter, ul, li, a, i;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("searchList");
        li = ul.getElementsByClassName("searchRow");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByClassName("searchFor")[0];
            if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }

    });

    $('.userHeader').each(function(){
        $(this).click(function(){

            var userID = $(this).attr("userID");

            $('.userContent').each(function(){

                if($(this).attr("userID") == userID){

                    $(this).slideToggle('fast');

                } else if($(this).attr("userID") != userID){

                    if($(this).css('display') != 'none'){
                        $(this).slideUp('fast');
                    }

                }

            });

        });
    });

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
                url: "./modul/benutzerverwaltung/call/modifyUser.php",
                data: {action:"add", bkey:bkey, group:group},
                success: function(data){

                    if(data){
                        $("#errorText").html(data);
                        $("#errorAlert").slideDown("fast");
                    } else {

                        $(".addUserInput").val("");
                        $("#successText").html(translate[101]);
                        $('#addUserModal').modal('toggle');
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

    $(".fSave").each(function(){
        $(this).click(function(event){
            var button = $(this);
            event.preventDefault();
            button.prop("disabled",true);

            var error = "";
            var userID = $(this).attr('userID');
            var fFirstname = $("#"+userID+"_fFirstname").val();
            var fLastname = $("#"+userID+"_fLastname").val();
            var fGroup = $("#"+userID+"_fGroup").val();
            var fMail = $("#"+userID+"_fMail").val();
            var fLanguage = $("#"+userID+"_fLanguage").val();
            var fSemester = $("#"+userID+"_fSemester").val();

            if(fGroup.length <= 0){
                error = error + "<li>" + translate[154]+"</li>";
            }

            if(fMail.length <= 0){
                error = error + "<li>" + translate[255] + " " + translate[95] +"</li>";
            }

            if(error){
                $("#errorText").html(error);
                $("#errorAlert").slideDown("fast");
                button.prop("disabled",false);
            } else {
                $("#errorAlert").slideUp("fast");

                $.ajax({
                    method: "POST",
                    url: "./modul/benutzerverwaltung/call/modifyUser.php",
                    data: {action:"change", userID:userID, fFirstname:fFirstname, fLastname:fLastname, fGroup:fGroup, fMail:fMail, fLanguage:fLanguage, fSemester:fSemester},
                    success: function(data){
                        if(data){
                            $("#errorText").html(data);
                            $("#errorAlert").slideDown("fast");
                            button.prop("disabled",false);
                        } else {
                            $(".addUserInput").val("");
                            $("#successText").html(translate[101]);
                            $("#successAlert").slideDown("fast").delay(1000).slideUp("fast");
                            button.prop("disabled",false);
                        }
                    }
                });

            }



        });
    });

    $('.fFirstname').each(function(){
        $(this).on('keyup', function(){

            var userID = $(this).attr('userID');
            $("#"+userID+"_FNameHeader").html($(this).val() + " " + $("#"+userID+"_fLastname").val());

        });
    });

    $('.fLastname').each(function(){
        $(this).on('keyup', function(){

            var userID = $(this).attr('userID');
            $("#"+userID+"_FNameHeader").html($("#"+userID+"_fFirstname").val() + " " + $(this).val());

        });
    });

    $('.fGroup').each(function(){
        $(this).on('change', function(){

            var userID = $(this).attr('userID');
            $("#"+userID+"_FGroupHeader").html($(this).find('option:selected').text());

        });
    });

    $('.fLogin').each(function(){
        $(this).click(function(event){
            event.preventDefault();

            var usrid = $(this).attr('userID');
            var bkey = $(this).attr('bkey');

            $.ajax({
                method: "POST",
                url: "./modul/benutzerverwaltung/call/relogin.php",
                data: {bkey:bkey},
                success: function(data){
                    if(data){
                        alert(data);
                    } else {
                        $("body").fadeOut("slow", function(){
                            window.location.href = 'index.php?page=dashboard&adm=true';
                        });
                    }
                }
            });


        });
    });


    $(".fDelete").each(function(){
        $(this).click(function(event){
            event.preventDefault();

            var usrid = $(this).attr('userID');
            var bkey = $(this).attr('bkey');

            $("#warningText").html("<strong>" + translate[97] + "</strong> " + translate[98] + ": " + bkey);
            $("#warningAlert").slideDown("fast");
            $("#warningButton").slideDown("fast");
            $("#warningButton").click(function(event){
                if(usrid){

					$(this).prop("disabled",true);
                    event.preventDefault();

                    $.ajax({
                        method: "POST",
                        url: "./modul/benutzerverwaltung/call/modifyUser.php",
                        data: {action:"delete", userid:usrid},
                        success: function(data){
                            if(data){
                                alert(data);
                            } else {
                                $("#warningAlert").slideUp("fast");
								$("#warningButton").prop("disabled",false);
                                $("#"+usrid+"_FUserRow").slideUp('slow', function(){
                                    $("#"+usrid+"_FUserRow").remove();
                                });
                            }
                        }
                    });

                }
            });



        });
    });

});
