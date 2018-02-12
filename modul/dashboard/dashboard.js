$(".dashModul").each(function(){
        
    $(this).hover(function() {
        $(this).css( 'cursor', 'pointer' );
    });
            
    makeDynamic(this);
        
});
   
function makeDynamic(objectThis){
    var href = ($(objectThis).attr('href'));
        
    $(objectThis).click(function(event){
        event.preventDefault();
        $("#pageContent").fadeOut("fast", function(){
            $('.loadScreen').fadeTo("fast", 1);
            if (href){
                $("#pageContent").load(href, function(responseTxt,statusTxt){

                    if(statusTxt=="error"){
                        $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite enth?lt keinen gültigen Pfad. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                    } else {
                        $('.loadScreen').fadeTo("fast", 0, function(){
                            $('#pageContent').fadeTo("fast", 1);
                        });
                        $.ajax({
                            method: "GET",
                            url: "modul/session/setCurrentPath.php",
                            data: {path:href},
                            success : function() {
                                
                            }
                        });
                    }
                    
                });
            } else {
                $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite wurde noch nicht verlinkt. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
            }
        });
    });
}