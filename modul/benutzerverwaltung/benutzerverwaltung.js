$(document).ready(function(){

    $("#addUser").click(function(){
        
        
        var bkey = $("#usrFormBkey").val();
        var group = $("#usrFormGroup").val();
        var firstname = $("#usrFormFirstname").val();
        var lastname = $("#usrFormLastname").val();
        
        if(bkey && group){
            event.preventDefault();
            $.ajax({
                method: "GET",
                url: "./modul/benutzerverwaltung/modifyUser.php",
                data: {action:"add", bkey:bkey, group:group, firstname:firstname, lastname:lastname},
                success: function(){     
                    $("#userAddedNotif").slideDown("fast").delay( 1400 ).slideUp("slow");               
                }
            });
            
            $(".addUserInput").val("");
            $(this).html("<b>Weiteren Benutzer hinzufügen</b>");
            
        }
        
        
    });
    
    
});