$(document).ready(function(){


    $("#addUser").click(function(){
        var bkey = $("#usrFormBkey").val();
        var group = $("#usrFormGroup").val();
        var firstname = $("#usrFormFirstname").val();
        var lastname = $("#usrFormLastname").val();
        
        if(bkey && group){
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "./modul/benutzerverwaltung/modifyUser.php",
                data: {action:"add", bkey:bkey, group:group, firstname:firstname, lastname:lastname},
                success: function(){
                    
                    $("#userTableBody").append("<tr id='newTR' style='background-color: #d4edda; display: none;'><td>NEU</td><td>" + bkey + "</td><td>"+ group +"</td><td>"+ firstname +"</td><td>"+ lastname +"</td><td></td></tr>");
                    $('#newTR').slideDown("slow");
                    $('#newTR').attr("id", "NULL");
                    $("#userAddedNotif").slideDown("fast").delay( 1400 ).slideUp("slow");
                    $(".addUserInput").val("");
                    $(this).html("<b>Weiteren Benutzer hinzufügen</b>");
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
                    success: function(){     
                        $('#check'+usrID).fadeTo("fast", 1);
                    }
                });
            }
        
        });
        
    
    });
    
    var notdone = 0;
    
    function doneTyping() {
        
        console.log("Start doneTyping");
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
            
            if(usrid){
                event.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "./modul/benutzerverwaltung/modifyUser.php",
                    data: {action:"delete", userid:usrid},
                    success: function(){     
                        $("#rowID" + usrid).slideUp("slow");               
                    }
                });
                
            }
                        
        });
        
    });
    
    
});