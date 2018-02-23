$(document).ready(function(){

    $('#fselUser').change(function(){

        var selUser = $(this).val();

        if(selUser){
            $.ajax({
                method: "POST",
                url: "./modul/malus/modify.php",
                data: {todo:"getSemester", selUser:selUser},
                success: function(data){
                    if(data){

                        $('#fsem').html(data).removeAttr("disabled");

                    } else {
                        alert(translate[158]);
                    }
                }
            });
        } else {
            $('#fsem').html("").attr("disabled", true);
        }

    });

    $("#fsenMal").click(function(){

        event.preventDefault();

        $(this).prop("disabled",true);

        var error = "";
        var fselsem = $('#fsem').val();
        var fselUser = $("#fselUser").val();
        var fweigth = $("#fweigth").val();
        var freasoning = $("#freasoning").val();

        if(!fselsem){
            error = error + "<br/>" + translate[150]+".";
        }

        if(!fselUser){
            error = error + "<br/>" + translate[159]+".";
        }

        if(!fweigth){
            error = error + "<br/>" + translate[159]+".";
        }

        if(!freasoning){
            error = error + "<br/>" + translate[146]+".";
        }

        if(error){
            $(this).prop("disabled",false);
            $("#error").html(error).slideDown("fast");
        } else {
            $("#error").html("").slideUp("fast");

            $.ajax({
                method: "POST",
                url: "./modul/malus/modify.php",
                data: {todo:"addEntry", fselUser:fselUser, fweigth:fweigth, freasoning:freasoning, fselsem:fselsem},
                success: function(data){

                    if(data){
                        $("#error").html(data).slideDown("fast");
                        $("#fsenMal").prop("disabled",false);
                    } else {

                        $("#addedNotif").slideDown("fast").delay(1300).slideUp("fast",function(){
                            $("#pageContent").load("modul/malus/malus.php", function(){
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

    $(".delEntry").each(function(){

        $(this).click(function(){

            event.preventDefault();

            var error;
            var fentryId = $(this).attr("entryID");
            var $fselUser = $(this).attr("userID");

            if(!fentryId){
                error = error + "<br/>" + translate[161]+".";
            }

            if(error){
                $("#error").html(error).slideDown("fast");
            } else {
                $("#error").html("").slideUp("fast");

                $.ajax({
                    method: "POST",
                    url: "./modul/malus/modify.php",
                    data: {todo:"deleteEntry", fentryId:fentryId, $fselUser:$fselUser},
                    success: function(data){

                        if(data){
                            $("#error").html(data).slideDown("fast");
                        } else {

                            $(".lEntry").each(function(){

                                if($(this).attr("entryID") == fentryId){
                                    $(this).fadeOut("fast", function(){
                                        $(this).remove();
                                    });
                                }

                            });

                        }

                    }
                });

            }

        });

    });

});
