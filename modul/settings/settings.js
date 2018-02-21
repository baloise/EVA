$(document).ready(function(){

    $('#newSelLang').change(function(){

        $('#changeLanguageButton').slideDown("slow");

    });

    $("#removeColor").click(function(){

        $.ajax({
            type: "POST",
            data: {doEntry: 'deleteColor'},
            url: "modul/settings/modifyEntry.php",
            success: function(data){
                if(data){

                } else {

                    resetColors();

                }
            }
        });

    });


    $("#saveColor").click(function(){

        var hintergrund = $("#color1").val();
        var akzentfarbe = $("#color2").val();
        var schrift = $("#color3").val();
        var link = $("#color4").val();

        $.ajax({
            type: "POST",
            data: {doEntry: 'changeColor', hintergrund:hintergrund, akzentfarbe:akzentfarbe, schrift:schrift, link:link},
            url: "modul/settings/modifyEntry.php",
            success: function(data){
                if(data){



                } else {

                    $("#saveColor").slideUp("slow");

                }
            }
        });

    });

    $('#changeLanguageButton').click(function(){

        var newLang = $("#newSelLang").val();

        $.ajax({
            type: "POST",
            data: {doEntry: 'changeLang', newLang:newLang},
            url: "modul/settings/modifyEntry.php",
            success: function(data){
                if(data){

                    $("#errorLang").html(data).slideDown("fast");

                } else {

                    $("#AddedNotifLang").slideDown("fast").delay(1000).slideUp("fast", function(){
                        window.location.replace("./logout.php");
                    });

                }
            }
        });

    });

    $(".itemDelete").each(function(){
        $(this).click(function(event){
            var navItemID = ($(this).attr('navItemID'));
            $(".navListPosition").each(function(){

                var entryEntity = $(this);

                $.ajax({
                    type: "POST",
                    data: {doEntry: 'delete', navItemID: navItemID},
                    url: "modul/settings/modifyEntry.php",
                    success: function(data){
                        if(data){
                            $("#error").html(data).slideDown("fast");
                        } else {
                            if(entryEntity.attr('navItemID') == navItemID){
                                entryEntity.slideUp("slow");
                            }
                            $(".nav-link").each(function(){

                                if($(this).attr("navlinkid") == navItemID){
                                    $(this).fadeOut("slow", function(){
                                        $(this).remove();
                                    });
                                }

                            });
                        }
                    }
                });
            });
        });
    });

    $("#itemAdd").click(function(event){
        var addItemID = $('#selectModule').val();
        var userID = $('#selectModule').attr('userid');
        $.ajax({
            type: "POST",
            data: {doEntry: 'add', navItemID: addItemID, userID:userID},
            url: "modul/settings/modifyEntry.php",
            success: function(data){
                if(data){

                    $("#selectModule").val("");
                    $('.navbar-nav').append(data).children(':last').slideDown("slow");
                    if($("#editNavLink")){
                        $("#editNavLink").slideUp("slow");
                    }
                    $("#AddedNotif").slideDown("fast").delay(1000).slideUp("fast", function(){

                        $("#pageContent").load("modul/settings/settings.php", function(){
                            $('.loadScreen').fadeTo("fast", 0, function(){
                                $('#pageContents').fadeTo("fast", 1);
                            });
                        });

                    });

                    $('.nav-link').each(function(){
                        makeDynamic(this);
                    });

                } else {

                    $("#error").html(translate["Fehler"]).slideDown("fast");

                }
            }
        });
    });

	function makeDynamic(objectThis){
        var href = ($(objectThis).attr('href'));

        $(objectThis).click(function(event){
            event.preventDefault();
            $("#pageContent").fadeOut("fast", function(){
                $('.loadScreen').fadeTo("fast", 1);
                if (href){
                    $("#pageContent").load(href, function(responseTxt,statusTxt){

                        if(statusTxt=="error"){
                            $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>"+translate["Fehler"]+" </strong> "+translate["Seite enthält keinen gültigen Pfad"]+".</div>");
                        } else {
                            $('.loadScreen').fadeTo("fast", 0, function(){
                                $('#pageContent').fadeTo("fast", 1);
                            });
                            $.ajax({
                                method: "GET",
                                url: "modul/session/setCurrentPath.php",
                                data: {path:href},
                            });
                        }

                    });
                } else {
                    $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>"+translate["Fehler"]+" </strong> "+translate["Seite wurde noch nicht verlinkt"]+".</div>");
                }
            });
        });
    }

});
