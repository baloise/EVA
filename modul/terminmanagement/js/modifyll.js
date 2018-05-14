$(document).ready(function(){

    $(".divtoggler").each(function(){

        $(this).click(function(){

            var semID = $(this).attr("subSemid");

            $(".divtogglercontent").each(function(){

                if($(this).attr("subSemid") == semID){

                    $(this).slideToggle("fast");

                }

            });

        });

    });

});
