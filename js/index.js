$(document).ready(function(){
    
    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });
    
    $("#pageContent").load( $("#pageContent").attr("page"), function(){
        $('.loadScreen').fadeTo("fast", 0, function(){
			$("#slideMe").slideDown("slow");
			$("#slideMeFoot").slideDown("slow");
            $('#pageContents').fadeTo("fast", 1);
        });
    });
    
    $(".foot-link").each(function(){
        makeDynamic(this);
    });
    
    $(".nav-link").each(function(){
        makeDynamic(this);
		$(this).hover(function(){
			
		});
    });
   
    $(".navbar-brand").each(function(){
        makeDynamic(this);
    });
   
    function makeDynamic(objectThis){
        var href = ($(objectThis).attr('href'));
        
        $(objectThis).click(function(event){
            event.preventDefault();
            $("#pageContent").fadeOut("fast", function(){
                $('.loadScreen').fadeTo("fast", 1);
                if (href){
                    $("#pageContent").load(href, function(response, status, xhr){
                        
                        if ( status == "error" ) {
                            var msg = "Sorry but there was an error: ";
                            alert( msg + xhr.status + " " + xhr.statusText );
                        } else {
                            
                            $('.loadScreen').fadeTo("fast", 0, function(){
                                $('#pageContent').fadeTo("fast", 1);
                            });
                            $.ajax({
                                method: "GET",
                                url: "modul/session/setCurrentPath.php",
                                data: {path:href},
                            });
                            
                        }
                    });
                } else {
                    $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>Fehler </strong> Seite wurde noch nicht verlinkt. Bitte wenden Sie sich an einen <a href='mailto:elia.reutlinger@baloise.ch'>Administrator</a>.</div>");
                }
            });
        });
    }
   
    
});