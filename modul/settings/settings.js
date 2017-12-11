$(document).ready(function(){
    
    $(".itemDelete").each(function(){
        $(this).click(function(){
            var navItemID = ($(this).attr('navItemID'));
            $(".navListPosition").each(function(){
                if($(this).attr('navItemID') == navItemID){
                    $(this).remove();
                    $.ajax({
                        type: "POST",
                        data: {doEntry: 'delete', navItemID: navItemID},
                        url: "modul/settings/modifyEntry.php",
                        success: function(data){}
                    });
                    //$.post('modul/settings/modifyEntry.php', {doEntry: 'delete', navItemID: navItemID});
                }
            });
        });
    });
    
    $("#itemAdd").click(function(){
        var addItemID = $('#selectModule').val();
        var userID = $('#selectModule').attr('userid');
        $.ajax({
            type: "POST",
            data: {doEntry: 'add', navItemID: addItemID, userID:userID},
            url: "modul/settings/modifyEntry.php",
            success: function(data){}
        });
    });
    
    
});
