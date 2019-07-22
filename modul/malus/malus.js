/** global: translate */
$(document).ready(function () {
    
    $('#fweigth').change(function () { 
        var reason = $('#fweigth option:selected').text();
        $('#freasoning').val(reason)
    })
    
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

    $("#fsenMal").click(function(event){

        event.preventDefault();

        $(this).prop("disabled",true);

        var error = "";
        var fselsem = $('#fsem').val();
        var fselUser = $("#fselUser").val();
        var fweigth = $("#fweigth").val();
        var freasoning = $("#freasoning").val();

        if(!fselsem){
            error = error + "<li>" + translate[150]+"</li>";
        }

        if(!fselUser){
            error = error + "<li>" + translate[159]+"</li>";
        }

        if(!fweigth){
            error = error + "<li>" + translate[159]+"</li>";
        }

        if(!freasoning){
            error = error + "<li>" + translate[146]+"</li>";
        }

        if(error){
            $(this).prop("disabled",false);
            $('#errorText').html(error);
            $('#errorAlert').slideDown("fast");
        } else {
            $("#errorAlert").slideUp("fast");

            $.ajax({
                method: "POST",
                url: "./modul/malus/modify.php",
                data: {todo:"addEntry", fselUser:fselUser, fweigth:fweigth, freasoning:freasoning, fselsem:fselsem},
                success: function(data){

                    if(data){
                        $('#errorText').html(data);
                        $('#errorAlert').slideDown("fast");
                        $("#fsenMal").prop("disabled",false);
                    } else {

                        $('#successText').html(translate[103]);
                        $("#successAlert").slideDown("fast").delay(1300).slideUp("slow",function(){
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
                error = error + "<li>" + translate[161]+"</li>";
            }

            if(error){
                $('#errorText').html(error);
                $('#errorAlert').slideDown("fast");
            } else {
                $("#error").html("").slideUp("fast");

                $.ajax({
                    method: "POST",
                    url: "./modul/malus/modify.php",
                    data: {todo:"deleteEntry", fentryId:fentryId, $fselUser:$fselUser},
                    success: function(data){

                        if(data){
                            $('#errorText').html(data);
                            $('#errorAlert').slideDown("fast");
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
