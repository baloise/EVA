$(document).ready(function(){

    $("#fsenMal").click(function(){
    
        event.preventDefault();
        
        $(this).prop("disabled",true);
        
        var error = "";
        var fselUser = $("#fselUser").val();
        var fweigth = $("#fweigth").val();    
        var freasoning = $("#freasoning").val();
        
        if(!fselUser){
            error = error + "Bitte einen Stage-Titel angeben.<br/>";
        }
        
        if(!fweigth){
            error = error + "Bitte eine Punktzahl angeben.<br/>";
        }
        
        if(!freasoning){
            error = error + "Bitte eine Punktzahl angeben.<br/>";
        }
    
        if(error){
            $(this).prop("disabled",false);
            $("#error").html(error).slideDown("fast");
        } else {
            $("#error").html("").slideUp("fast");
            
            $.ajax({
                method: "POST",
                url: "./modul/malus/modify.php",
                data: {todo:"addEntry", fselUser:fselUser, fweigth:fweigth, freasoning:freasoning},
                success: function(data){
                    
                    if(data){
                        $("#error").html(data).slideDown("fast");
                        $("#fsenMal").prop("disabled",false);
                    } else {
                                
                        $("#addedNotif").slideDown("fast").delay(1300).slideUp("fast",function(){
                            $("#pageContent").load("modul/malus.php", function(){
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
            
            if(!fentryId){
                error = error + "Kein Eintrag angegeben.<br/>";
            }
            
            if(error){
                $("#error").html(error).slideDown("fast");
            } else {
                $("#error").html("").slideUp("fast");
                
                $.ajax({
                    method: "POST",
                    url: "./modul/malus/modify.php",
                    data: {todo:"deleteEntry", fentryId:fentryId},
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