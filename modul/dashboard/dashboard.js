$(".dashModul").each(function(){

    $(this).hover(function() {
        $(this).css( 'cursor', 'pointer' );
    });

    makeDynamic(this);

});

$(document).ready(function(){
	$('.mt-5').delay(1000).fadeTo("slow", 1);

    jQuery('img.svg').each(function(){
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {

            var $svg = jQuery(data).find('svg');

            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }

            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            $svg = $svg.removeAttr('xmlns:a');

            $img.replaceWith($svg);

        }, 'xml');

    });

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
                        $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>" + translate["Fehler"] +" </strong> " + translate["Seite enthält keinen gültigen Pfad"] + ".</div>");
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
                $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>" + translate["Fehler"] +" </strong> " + translate["Seite wurde noch nicht verlinkt"]+".</div>");
            }
        });
    });
}
