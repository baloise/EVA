/** global: translate */
$(document).ready(function(){

    $(".checkEntry").each(function(){

        $(this).click(function(event){

            event.preventDefault();

			$("#checkEntryForm").slideDown("fast", function(){

				$('html, body').animate({
					scrollTop: $(document).height()-$(window).height()},
					500,
					"swing"
				);

			});

            $("#fcheckEntryPoints").val($(this).attr("entryPoints"));
            $("#fcheckEntryLL").val($(this).attr("entryLL"));
            $("#fcheckEntryPA").val($(this).attr("entryPA"));
            $("#fsend").attr("entryID", $(this).attr("entryID"));
            $("#fsendAndDelete").attr("entryID", $(this).attr("entryID"));

        });

    });

    $("#fsend").click(function(event){

        event.preventDefault();
        var reason = $("#fcheckEntryReason").val();
        var entryID = $(this).attr("entryID");

        if(!reason){
            $('#errorText').html(translate[146]);
            $('#errorAlert').slideDown("fast");
        } else {

			$("#fsendAndDelete").prop("disabled",true);
			$(this).prop("disabled",true);
            $("#errorAlert").slideUp("fast");

            $.ajax({
                method: "POST",
                url: "./modul/verhaltensziele/modify.php",
                data: {todo:"check", entryID:entryID, reason:reason},
                success: function(data){

                    if(data){
                        $('#errorText').html(data);
                        $('#errorAlert').slideDown("fast");
                    } else {

                        $("#checkEntryForm").slideUp("slow",function(){

                            $("#fcheckEntryLL").val("");
                            $("#fcheckEntryReason").val("");
                            $("#fcheckEntryPA").val("");
                            $("#fcheckEntryPoints").val("");
                            $("#fsend").prop("disabled",false);
							$("#fsendAndDelete").prop("disabled",false);



                        });

                    }

                }
            });

        }

    });

    $("#fsendAndDelete").click(function(event){

        event.preventDefault();
        var reason = $("#fcheckEntryReason").val();
        var entryID = $(this).attr("entryID");

        if(!reason){
            $('#errorText').html(translate[146]);
            $('#errorAlert').slideDown("fast");
        } else {

            $("#errorAlert").slideUp("fast");
            $(this).html(translate[148]).removeClass("btn-danger").addClass("btn-warning");

            $(this).click(function(){

                if(!reason){
                    $('#errorText').html(translate[146]);
                    $('#errorAlert').slideDown("fast");
                } else {

					$("#fsend").prop("disabled",true);
					$(this).prop("disabled",true);

                    $.ajax({
                        method: "POST",
                        url: "./modul/verhaltensziele/modify.php",
                        data: {todo:"checkAndDelete", entryID:entryID, reason:reason},
                        success: function(data){

                            if(data){
                                $('#errorText').html(data);
                                $('#errorAlert').slideDown("fast");
                            } else {

                                $("#checkEntryForm").slideUp("slow",function(){

                                    $("#fcheckEntryLL").val("");
                                    $("#fcheckEntryReason").val("");
                                    $("#fcheckEntryPA").val("");
                                    $("#fcheckEntryPoints").val("");

                                    $('#successText').html(translate[149]);
                                    $("#successAlert").slideDown("fast").delay(1300).slideUp("slow", function(){
                                        $("#pageContent").load("modul/verhaltensziele/verhaltensziele.php", function(){
                                            $('.loadScreen').fadeTo("fast", 0, function(){
                                                $('#pageContents').fadeTo("fast", 1);
                                            });
                                        });
                                    });

                                });

                            }

                        }
                    });

                }

            });

        }

    });

    $("#finterrupt").click(function(){

        $("#checkEntryForm").slideUp("fast");

    });

    $("#addNewEntryButton").click(function(event){

        $(this).prop("disabled", true);

        event.preventDefault();

        var error = "";
        var fstage = $("#fStage").val();
        var fpoints = $("#fPoints").val();
        var fpa = $("#fPa").val();
        var fsem = $("#fSem").val();

        if(!fsem){
            error = error + "<li>" + translate[150]+"</li>";
        }

        if(!fstage){
            error = error + "<li>" + translate[169]+"</li>";
        }

        if(!fpoints){
            error = error + "<li>" + translate[152]+"</li>";
        }

        if(!fpa){
            error = error + "<li>" + translate[170]+"</li>";
        }

        if(error){
            $(this).prop("disabled", false);
            $('#errorText').html(error);
            $('#errorAlert').slideDown("fast");
        } else {
            $("#errorAlert").slideUp("fast");

            $('#warningText').html(translate[93]);
            $('#warningAlert').slideDown("fast");
            $("#warningButton").slideDown("fast");
            $("#warningButton").click(function(event){

                $(this).prop("disabled", true);
                event.preventDefault();

                var error = "";
                var fstage = $("#fStage").val();
                var fpoints = $("#fPoints").val();
                var fpa = $("#fPa").val();
                var fsem = $("#fSem").val();

                if(!fsem){
                    error = error + "<li>" + translate[150]+"</li>";
                }

                if(!fstage){
                    error = error + "<li>" + translate[169]+"</li>";
                }

                if(!fpoints){
                    error = error + "<li>" + translate[152]+"</li>";
                }

                if(!fpa){
                    error = error + "<li>" + translate[170]+"</li>";
                }

                if(error){
                    $('#errorText').html(error);
                    $('#errorAlert').slideDown("fast");
                    $(this).prop("disabled", false);
                    $("#addNewEntryButton").prop("disabled", false);
                    $('#warningAlert').slideUp("fast");
                } else {


                    $("#warningAlert").slideUp("fast");
                    $.ajax({
                        method: "POST",
                        url: "./modul/verhaltensziele/modify.php",
                        data: {todo:"addEntry", fstage:fstage, fpoints:fpoints, fpa:fpa, fsem:fsem},
                        success: function(data){

                            if(data){
                                $('#errorText').html(data);
                                $('#errorAlert').slideDown("fast");
                            } else {

                                $("#fStage").val("");
                                $("#fPoints").val("");
                                $("#fPa").val("");

                                $('#successText').html(translate[103]);
                                $("#successAlert").slideDown("fast").delay(1300).slideUp("slow",function(){
                                    $("#pageContent").load("modul/verhaltensziele/verhaltensziele.php", function(){
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

        }

    });

});
