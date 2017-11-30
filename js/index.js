$(document).ready(function(){
    
    $("#pageContent").load("modul/dashboard.php");
    
    $(".nav-link").each(function(){
        
        var href = ($(this).attr('href'));
        
        $(this).click(function(){
            event.preventDefault();
            $("#pageContent").fadeOut("fast", function(){
                if (href){
                    $("#pageContent").load(href, function(responseTxt,statusTxt){

                        if(statusTxt=="error"){
                            $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite enthält keinen gültigen Pfad. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                        }
                        
                    });
                } else {
                    $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite wurde noch nicht verlinkt. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                }
            }).fadeIn("fast");
        });
        
    });
    
});