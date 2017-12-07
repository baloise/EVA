$(document).ready(function(){

    $("#addUser").click(function(){
        event.preventDefault();
        
        var bkey = $("#usrFormBkey").val();
        
        alert(bkey);
        
        $("#userAddedNotif").slideDown("fast").delay( 1400 ).slideUp("slow");
        $(".addUserInput").val("");
        $(this).html("<b>Weiteren Benutzer hinzufügen</b>");
    });
    
    
});