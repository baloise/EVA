$(document).ready(function(){
    
    $("#pageContent").load($("#pageContent").attr("page"));
    
    $(".foot-link").each(function(){
        makeDynamic(this);
    });
    
    $(".nav-link").each(function(){
        makeDynamic(this);
    });
   
    $(".navbar-brand").each(function(){
        makeDynamic(this);
    });
   
    function makeDynamic(objectThis){
        var href = ($(objectThis).attr('href'));
        
        $(objectThis).click(function(){
            event.preventDefault();
            $("#pageContent").fadeOut("fast", function(){
                if (href){
                    $("#pageContent").load(href, function(responseTxt,statusTxt){

                        if(statusTxt=="error"){
                            $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite enth?lt keinen gültigen Pfad. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                        } else {
                            $.ajax({
                                method: "GET",
                                url: "modul/session/setCurrentPath.php",
                                data: {path:href}
                            });
                        }
                        
                    });
                } else {
                    $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite wurde noch nicht verlinkt. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                }
            }).fadeIn("fast");
        });
    }
   
    
});