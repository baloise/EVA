$(document).ready(function(){
    
    $("#pageContent").load("modul/ll_dashboard.php");
    
    $(".nav-link").each(function(){
        
        $(this).attr("id", $(this).html());
        var id = $(this).html().toLowerCase();
        
        $(this).click(function(){
            $("#pageContent").fadeOut("fast", function(){
                $("#pageContent").load("modul/ll_" + id + ".php");
            }).fadeIn("fast");
        });
        
    });
    
});