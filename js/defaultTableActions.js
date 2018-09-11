/** global: translate */
/** global: url */
/** global: load */
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
            $('#errorText').html(translate[146]);
            $('#errorAlert').slideDown("fast");
        } else {

			$("#fsendAndDelete").prop("disabled",true);
			$(this).prop("disabled",true);
            $("#errorAlert").slideUp("fast");

            $.ajax({
                method: "POST",
                url: url,
                data: {todo:"check", entryID:entryID, reason:reason},
                success: function(data){

                    if(data){
                        $('#errorText').html(data);
                        $('#errorAlert').slideDown("fast");
                    } else {

                        $("#checkEntryForm").slideUp("slow",function(){

                            $("#fcheckEntryLL").val("");
                            $("#fcheckEntryReason").val("");
                            $("#fcheckEntryPoints").val("");
                            $("#fsend").prop("disabled",false);
							$("#fsendAndDelete").prop("disabled",false);

                            $('#successText').html(translate[147]);
                            $("#successAlert").slideDown("fast").delay(1300).slideUp("slow");

                        });

                    }

                }
            });

        }

    });

    $("#fsendAndDelete").click(function(event){

        event.preventDefault();

        $("#errorAlert").slideUp("fast");
        $(this).html(translate[148]).removeClass("btn-danger").addClass("btn-warning");

        $(this).click(function(){

            $(this).prop("disabled",true);
            var reason = $("#fcheckEntryReason").val();
            var entryID = $(this).attr("entryID");

            if(!reason){
                $(this).prop("disabled",false);
                $('#errorText').html(translate[146]);
                $('#errorAlert').slideDown("fast");
            } else {

                $("#fsend").prop("disabled",true);
                $(this).prop("disabled",true);

                $.ajax({
                    method: "POST",
                    url: url,
                    data: {todo:"checkAndDelete", entryID:entryID, reason:reason},
                    success: function(data){

                        if(data){
                            $('#errorText').html(data);
                            $('#errorAlert').slideDown("fast");
                        } else {

                            $("#checkEntryForm").slideUp("slow",function(){

                                $("#fcheckEntryLL").val("");
                                $("#fcheckEntryReason").val("");
                                $("#fcheckEntryPoints").val("");

                                $('#successText').html(translate[149]);
                                $("#successAlert").slideDown("fast").delay(1300).slideUp("fast",function(){
                                    $("#pageContent").load(load, function(){
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
        $(this).prop("disabled", true);
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
            $(this).prop("disabled", false);
        } else {

            $('#warningText').html(translate[93]);
            $('#warningAlert').slideDown("fast");
            $("#warningButton").slideDown("fast");
            $("#warningButton").click(function(event){
                event.preventDefault();
                $(this).prop("disabled", true);

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
                    $('#warningButton').prop("disabled", false);
                } else {
                    $("#warningAlert").slideUp("fast");
                    $.ajax({
                        method: "POST",
                        url: url,
                        data: {todo:"addEntry", fTitle:fTitle, fpoints:fpoints, fsem:fsem},
                        success: function(data){

                            if(data){
                                $('#errorText').html(data);
                                $('#errorAlert').slideDown("fast");
                                $('#warningButton').prop("disabled", false);
                            } else {

                                $("#fTitle").val("");
                                $("#fPoints").val("");
                                $('#warningButton').prop("disabled", false);
                                $('#successText').html(translate[103]);
                                $("#successAlert").slideDown("fast").delay(1300).slideUp("fast",function(){
                                    $("#pageContent").load(load, function(){
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
