$(document).ready(function(){
    
    $(".itemDelete").each(function(){
        $(this).click(function(){
            var navItemID = ($(this).attr('navItemID'));
            $(".navListPosition").each(function(){
                if($(this).attr('navItemID') == navItemID){
                    $(this).slideUp("slow");
                    $.ajax({
                        type: "POST",
                        data: {doEntry: 'delete', navItemID: navItemID},
                        url: "modul/settings/modifyEntry.php",
                        success: function(){}
                    });
                }
            });
        });
    });
    
    $("#itemAdd").click(function(){
        var addItemID = $('#selectModule').val();
        var userID = $('#selectModule').attr('userid');
        $('#usersNavItems').append('<div style="display: none;" class="navListPosition" id="navListPositionNew" navItemID=""><div style=" background-color: rgb(212, 237, 218);" id="navListItem">wot m8<span></span></div></div>');
        $('#navListPositionNew').slideDown("slow");
        $('#navListPositionNew').attr("id", "navListPosition");
        $.ajax({
            type: "POST",
            data: {doEntry: 'add', navItemID: addItemID, userID:userID},
            url: "modul/settings/modifyEntry.php",
            success: function(){
                
            }
        });
    });
    
    
});
