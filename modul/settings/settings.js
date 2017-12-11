$(document).ready(function(){
    
    $(".itemDelete").each(function(){
        $(this).click(function(){
            var navItemID = ($(this).attr('navItemID'));
            $(".navListPosition").each(function(){
                    if($(this).attr('navItemID') == navItemID){
                        $(this).remove();
                        
                        $.post({'modul/settings/modifyEntry.php':
                            {doEntry: 'delete', navItemID: navItemID},
                        });
                    }
            });
        });
    });
    
    $(".itemUp").each(function(){
        $(this).click(function(){
            var navItemID = ($(this).attr('navItemID'));
            $(".navListPosition").each(function(){
                    if($(this).attr('navItemID') == navItemID){
                        $(this).remove();
                        
                        $.post({'/modul/settings/modifyEntry.php', {doEntry: 'delete', navItemID: navItemID}
                        });
                    }
            });
        });
    });
    
    $("#itemAdd").click(function(){
        
        alert($("#selectModule").val());
        
        
        
    });
    
});
