$(document).ready(function(){
    
    $(".itemDelete").each(function(){
        $(this).click(function(){
            var pos = ($(this).attr('pos'));
            $(".navListPosition").each(function(){
                    if($(this).attr('pos') == pos){
                        $(this).remove();
                        $.ajax({ url: 'modul/settings/modifyEntry.php',
                            data: {doEntry: 'delete', pos: pos},
                            type: 'post',
                            success: function(output) {
                                       
                                     }
                        });
                    }
            });
        });
    });
    
    $("#itemAdd").click(function(){
        
        alert($("#selectModule").val());
        
    });
    
});
