$(document).ready(function(){

    $('.openReg').each(function(){
        $(this).click(function(event){

            event.preventDefault();

            var group = $(this).attr('group');
            var lang = $(this).attr('lang');

            $('.toggableReg').each(function(){

                if($(this).attr('lang') == lang && $(this).attr('group') == group){
                    $(this).slideToggle('fast');
                } else {
                    $(this).slideUp('fast');
                }

            });

        });
    });

});
