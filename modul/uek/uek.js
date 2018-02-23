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
                url: "./modul/uek/modify.php",
                data: {todo:"check", entryID:entryID, reason:reason},
                success: function(data){

                    if(data){
                        $("#error").html(data).slideDown("fast");
                    } else {

                        $("#checkEntryForm").slideUp("slow",function(){

                            $("#fcheckEntryLL").val("");
                            $("#fcheckEntryReason").val("");
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

        $("#error").slideUp("fast");
        $(this).html(translate[148]).removeClass("btn-danger").addClass("btn-warning");

        $(this).click(function(){

            var reason = $("#fcheckEntryReason").val();
            var entryID = $(this).attr("entryID");

            if(!reason){
                $("#error").html(translate[146]).slideDown("fast");
            } else {

                $("#fsend").prop("disabled",true);
                $(this).prop("disabled",true);

                $.ajax({
                    method: "POST",
                    url: "./modul/uek/modify.php",
                    data: {todo:"checkAndDelete", entryID:entryID, reason:reason},
                    success: function(data){

                        if(data){
                            $("#error").html(data).slideDown("fast");
                        } else {

                            $("#checkEntryForm").slideUp("slow",function(){

                                $("#fcheckEntryLL").val("");
                                $("#fcheckEntryReason").val("");
                                $("#fcheckEntryPoints").val("");

                                $("#checkedNotif").html(translate[149]).slideDown("fast").delay(1300).slideUp("fast",function(){
                                    $("#pageContent").load("modul/uek/uek.php", function(){
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

    });

    $("#finterrupt").click(function(){

        $("#checkEntryForm").slideUp("fast");

    });

    $("#addNewEntryButton").click(function(event){

        event.preventDefault();
        $("#error").slideUp("fast");

        var error = "";
        var fTitle = $("#fTitle").val();
        var fpoints = $("#fPoints").val();
        var fsem = $("#fSem").val();

        if(!fsem){
            error = error + "<br/>" + translate[150]+".";
        }

        if(!fTitle){
            error = error + "<br/>" + translate[168]+".";
        }

        if(!fpoints){
            error = error + "<br/>" + translate[152]+".";
        }

        if(error){
            $("#error").html(error).slideDown("fast");
        } else {

            $("#warnEntry").slideDown("fast");
            $("#addNewEntryButton").html("Bestätigen");

            $("#addNewEntryButton").click(function(event){
                event.preventDefault();

                var error = "";
                var fTitle = $("#fTitle").val();
                var fpoints = $("#fPoints").val();
                var fsem = $("#fSem").val();

                if(!fsem){
                    error = error + "<br/>" + translate[150]+".";
                }

                if(!fTitle){
                    error = error + "<br/>" + translate[168]+".";
                }

                if(!fpoints){
                    error = error + "<br/>" + translate[152]+".";
                }

                if(error){
                    $("#error").html(error).slideDown("fast");
                } else {
                    $("#warnEntry").slideUp("fast");
                    $.ajax({
                        method: "POST",
                        url: "./modul/uek/modify.php",
                        data: {todo:"addEntry", fTitle:fTitle, fpoints:fpoints, fsem:fsem},
                        success: function(data){

                            if(data){
                                $("#error").html(data).slideDown("fast");
                            } else {

                                $("#fTitle").val("");
                                $("#fPoints").val("");

                                $("#addedNotif").slideDown("fast").delay(1300).slideUp("fast",function(){
                                    $("#pageContent").load("modul/uek/uek.php", function(){
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
