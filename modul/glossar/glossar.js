$(document).ready(function(){

    $('.toggler').each(function(){

        $(this).click(function(){

            var Objid = $(this).attr('id');
            var contid = Objid + "Cont";

            $("#"+contid).slideToggle("fast");

            $('.toggableCont').each(function(){
                if($(this).attr('id') != contid){
                    $(this).slideUp("fast");
                }
            });

        });

    });

})
