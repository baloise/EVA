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
                url: "./modul/fachvortrag/modify.php",
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
                    url: "./modul/fachvortrag/modify.php",
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
                                    $("#pageContent").load("modul/fachvortrag/fachvortrag.php", function(){
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

        $("#addNewEntryButton").prop("disabled", true);
        event.preventDefault();
        $("#errorAlert").slideUp("fast");

        var error = "";
        var fTitle = $("#fTitle").val();
        var fpoints = $("#fPoints").val();
        var fsem = $("#fSem").val();

        if(!fsem){
            error = error + "<li>" + translate[150] + "</li>";
        }

        if(!fTitle){
            error = error + "<li>" + translate[176] + "</li>";
        }

        if(!fpoints){
            error = error + "<li>" + translate[152]+"</li>";
        }

        if(error){
            $('#errorText').html(error);
            $('#errorAlert').slideDown("fast");
            $("#addNewEntryButton").prop("disabled", false);
        } else {

            $('#warningText').html(translate[93]);
            $('#warningAlert').slideDown("fast");
            $("#warningButton").slideDown("fast");
            $("#warningButton").click(function(event){
                event.preventDefault();

                var error = "";
                var fTitle = $("#fTitle").val();
                var fpoints = $("#fPoints").val();
                var fsem = $("#fSem").val();

                if(!fsem){
                    error = error + "<li>" + translate[150] + "</li>";
                }

                if(!fTitle){
                    error = error + "<li>" + translate[176] + "</li>";
                }

                if(!fpoints){
                    error = error + "<li>" + translate[152]+"</li>";
                }

                if(error){
                    $('#errorText').html(error);
                    $('#errorAlert').slideDown("fast");
                    $("#addNewEntryButton").prop("disabled", true);
                } else {
                    $("#warningAlert").slideUp("fast");
                    $.ajax({
                        method: "POST",
                        url: "./modul/fachvortrag/modify.php",
                        data: {todo:"addEntry", fTitle:fTitle, fpoints:fpoints, fsem:fsem},
                        success: function(data){

                            if(data){
                                $('#errorText').html(error);
                                $('#errorAlert').slideDown("fast");
                            } else {

                                $("#fTitle").val("");
                                $("#fPoints").val("");

                                $('#successText').html(translate[103]);
                                $("#successAlert").slideDown("fast").delay(1300).slideUp("fast",function(){
                                    $("#pageContent").load("modul/fachvortrag/fachvortrag.php", function(){
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
