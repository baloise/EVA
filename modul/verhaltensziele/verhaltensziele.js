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
            $("#error").html(translate[146]).slideDown("fast");
        } else {

			$("#fsendAndDelete").prop("disabled",true);
			$(this).prop("disabled",true);
            $("#error").slideUp("fast");

            $.ajax({
                method: "POST",
                url: "./modul/verhaltensziele/modify.php",
                data: {todo:"check", entryID:entryID, reason:reason},
                success: function(data){

                    if(data){
                        $("#error").html(data).slideDown("fast");
                    } else {

                        $("#checkEntryForm").slideUp("slow",function(){

                            $("#fcheckEntryLL").val("");
                            $("#fcheckEntryReason").val("");
                            $("#fcheckEntryPA").val("");
                            $("#fcheckEntryPoints").val("");
                            $("#fsend").prop("disabled",false);
							$("#fsendAndDelete").prop("disabled",false);
                            $("#checkedNotif").html(translate[147]).slideDown("fast").delay(2000).slideUp("slow");

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
            $("#error").html(translate[146]).slideDown("fast");
        } else {

            $("#error").slideUp("fast");
            $(this).html(translate[148]).removeClass("btn-danger").addClass("btn-warning");

            $(this).click(function(){

                if(!reason){
                    $("#error").html(translate[146]).slideDown("fast");
                } else {

					$("#fsend").prop("disabled",true);
					$(this).prop("disabled",true);

                    $.ajax({
                        method: "POST",
                        url: "./modul/verhaltensziele/modify.php",
                        data: {todo:"checkAndDelete", entryID:entryID, reason:reason},
                        success: function(data){

                            if(data){
                                $("#error").html(data).slideDown("fast");
                            } else {

                                $("#checkEntryForm").slideUp("slow",function(){

                                    $("#fcheckEntryLL").val("");
                                    $("#fcheckEntryReason").val("");
                                    $("#fcheckEntryPA").val("");
                                    $("#fcheckEntryPoints").val("");

                                    $("#checkedNotif").html(translate[149]).slideDown("fast").delay(1300).slideUp("fast",function(){
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

        event.preventDefault();

        var error = "";
        var fstage = $("#fStage").val();
        var fpoints = $("#fPoints").val();
        var fpa = $("#fPa").val();
        var fsem = $("#fSem").val();

        if(!fsem){
            error = error + "<br/>" + translate[150]+".";
        }

        if(!fstage){
            error = error + "<br/>" + translate[169]+".";
        }

        if(!fpoints){
            error = error + "<br/>" + translate[152]+".";
        }

        if(!fpa){
            error = error + "<br/>" + translate[170]+".";
        }

        if(error){
            $("#error").html(error).slideDown("fast");
        } else {
            $("#error").slideUp("fast");

            $("#warnEntry").slideDown("fast");
            $("#addNewEntryButton").html("Bestätigen");

            $("#addNewEntryButton").click(function(event){
                event.preventDefault();

                var error = "";
                var fstage = $("#fStage").val();
                var fpoints = $("#fPoints").val();
                var fpa = $("#fPa").val();
                var fsem = $("#fSem").val();

                if(!fsem){
                    error = error + "<br/>" + translate[150]+".";
                }

                if(!fstage){
                    error = error + "<br/>" + translate[169]+".";
                }

                if(!fpoints){
                    error = error + "<br/>" + translate[152]+".";
                }

                if(!fpa){
                    error = error + "<br/>" + translate[170]+".";
                }

                if(error){
                    $("#error").html(error).slideDown("fast");
                } else {


                    $("#warnEntry").slideUp("fast");
                    $.ajax({
                        method: "POST",
                        url: "./modul/verhaltensziele/modify.php",
                        data: {todo:"addEntry", fstage:fstage, fpoints:fpoints, fpa:fpa, fsem:fsem},
                        success: function(data){

                            if(data){
                                $("#error").html(data).slideDown("fast");
                            } else {

                                $("#fStage").val("");
                                $("#fPoints").val("");
                                $("#fPa").val("");

                                $("#addedNotif").slideDown("fast").delay(1300).slideUp("fast",function(){
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
