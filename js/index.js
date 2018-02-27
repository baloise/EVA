function makeDynamic(objectThis){
    var href = $(objectThis).attr('href');

    $(objectThis).click(function(event){
        event.preventDefault();
        $("#pageContent").fadeOut(50, function(){
            goBack(href);
        });
    });
}

function goBack(href){
    if (href){

        var loader = setTimeout(function(){

            $('.loadScreen').fadeTo("slow", 1);


        },1000);

        $("#pageContent").load(href, function(response, status, xhr){

            if ( status == "error" ) {
                $('.loadScreen').fadeTo("fast", 0);
                var msg = "makeDynamic Error";
                alert( msg + xhr.status + " " + xhr.statusText );
            } else {
                clearTimeout(loader);
                $('.loadScreen').fadeTo(50, 0, function(){
                    $('#pageContent').fadeTo(50, 1);
                });
                $.ajax({
                    method: "GET",
                    url: "modul/session/setCurrentPath.php",
                    data: {path:href},
                    success: function(){

                        var state = {info: href};
                        history.pushState(state, "index.php");

                    }
                });

            }
        });
    } else {
        $("#pageContent").html("<br/><br/><div class='alert alert-danger'><strong>"+translate[95]+" </strong> "+$translate[156]+ ".</div>");
    }
}

$(document).ready(function(){

    $(window).on('popstate',function(event) {

        var href = history.state["info"];

        $("#pageContent").fadeOut("fast", function(){
            $('.loadScreen').fadeTo("fast", 1);
            goBack(href);
        });

    });

    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });

    $("#pageContent").load( $("#pageContent").attr("page"), function(){

        var state = {info: $("#pageContent").attr("page")};
        history.pushState(state, "index.php");

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
    });

    $(".navbar-brand").each(function(){
        makeDynamic(this);
    });

});
