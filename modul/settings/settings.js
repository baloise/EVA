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
    
    
});
