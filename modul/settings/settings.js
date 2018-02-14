$(document).ready(function(){
    
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
                            $('#slideMe').slideUp("fast", function(){
                                $('#naviLink').html("").load("modul/navi.php", function(){
                                    $('#slideMe').slideDown("fast");
									$(".nav-link").each(function(){
										makeDynamic(this);
									});
									$(".navbar-brand").each(function(){
										makeDynamic(this);
									});
                                }); 
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
                    $("#error").html(data).slideDown("fast"); 
                } else {
                    $("#selectModule").val("");
                    $('#slideMe').slideUp("fast", function(){
                        $('#naviLink').html("").load("modul/navi.php", function(){
                            $('#slideMe').slideDown("fast");
							$(".nav-link").each(function(){
								makeDynamic(this);
							});
							$(".navbar-brand").each(function(){
								makeDynamic(this);
							});
                        }); 
                    });
                    $("#AddedNotif").slideDown("fast").delay(1000).slideUp("fast",function(){
                        $("#pageContent").load("modul/settings.php", function(){
                            $('.loadScreen').fadeTo("fast", 0, function(){
                                $('#pageContents').fadeTo("fast", 1);
                            });
                        });
                    });
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
                            $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite enth?lt keinen gültigen Pfad. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
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
                    $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite wurde noch nicht verlinkt. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                }
            });
        });
    }
    
});
