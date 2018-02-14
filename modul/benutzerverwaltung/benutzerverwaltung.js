$(document).ready(function(){

    $("#addUser").click(function(event){
        
        event.preventDefault();
        var error = "";
        var bkey = $("#usrFormBkey").val();
        var group = $("#usrFormGroup").val();
        var firstname = $("#usrFormFirstname").val();
        var lastname = $("#usrFormLastname").val();
        
        if(bkey.length != 7){
            error = error + "Der B-Key muss aus 7 Zeichen bestehen.<br/>";
        }
        
        if(!group){
            error = error + "Bitte Gruppe auswählen.<br/>";
        }
        
        if(error){
            $("#error").html(error).slideDown("fast"); 
        } else {
            
			$(this).prop("disabled",true);
            $("#error").slideUp("fast"); 
            
            $.ajax({
                method: "POST",
                url: "./modul/benutzerverwaltung/modifyUser.php",
                data: {action:"add", bkey:bkey, group:group, firstname:firstname, lastname:lastname},
                success: function(data){
                    
                    if(data){
                        $("#error").html(data).slideDown("fast"); 
                    } else {
                        
                        $(".addUserInput").val("");
                        $("#userAddedNotif").slideDown("fast").delay(1000).slideUp("fast",function(){
                            $("#pageContent").load("modul/benutzerverwaltung.php", function(){
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
    
    var typingTimer;
    var doneTypingInterval = 2000;
    
    $('.changeInTable').each(function(){
        
        
        $(this).on('keydown', function () {
            clearTimeout(typingTimer);
        });
        
        $(this).on("keyup", function(){
            
            $('#loadingTable').slideDown("fast");
            
            clearTimeout(typingTimer);
            typingTimer = setTimeout(doneTyping, doneTypingInterval);
            
            var usrID = $(this).attr("usrid");
            var fType = $(this).attr("fType");
            var content = $(this).val();
            
            if(usrID && fType){
                event.preventDefault();
                $.ajax({
                    async: true,
                    method: "POST",
                    url: "./modul/benutzerverwaltung/modifyUser.php",
                    data: {action:"change", userid:usrID, fType:fType, content:content},
                    success: function(data){
                        if(data){
                            $("#error").html(data).slideDown("fast"); 
                        } else {
                            $('#check'+ usrID).fadeTo("fast", 1);
                        }
                    }
                });
            }
        
        });
        
    
    });
    
    var notdone = 0;
    
    function doneTyping() {
        
        if ($.active == 0){
            
            $('#loadingTable').slideUp("fast");
            $("#changesSaveNotif").slideDown("fast").delay( 1400 ).slideUp("slow");
            
        } else {
            notdone = 1;
        }
    }
    
    $(document).ajaxStop(function(){
        if(notdone == 1){
            $('#loadingTable').slideUp("fast");
            $("#changesSaveNotif").slideDown("fast").delay( 1400 ).slideUp("slow");
        }
    });
    
    
    
    $(".fa-trash-o").each(function(){
        
        $(this).hover(function() {
            $(this).css( 'cursor', 'pointer' );
        });
        
        $(this).click(function(){
            
            var usrid = $(this). attr('id');
            var bkey = $(this). attr('bkey');
            
            $("#useridWarn").html(bkey);
            $("#warning").slideDown("fast");
            $("#warnButton").click(function(event){
                if(usrid){
					
					$(this).prop("disabled",true);
                    event.preventDefault();
					
                    $.ajax({
                        method: "POST",
                        url: "./modul/benutzerverwaltung/modifyUser.php",
                        data: {action:"delete", userid:usrid},
                        success: function(data){
                            if(data){
                                
                            } else {
                                $("#rowID" + usrid).slideUp("slow");
                                $("#warning").slideUp("fast");
								$("#warnButton").prop("disabled",false);
                            }
                        }
                    });
                    
                }
            });
            
            
                        
        });
        
    });
    
    
});