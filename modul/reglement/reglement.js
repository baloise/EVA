$(document).ready(function(){

    $('.openReg').each(function(){

        $(this).click(function(){

            $('#textareaContent').html("");

            $('#textareaContent').slideUp('fast');
            $('#safeRegChange').slideUp('fast');

            event.preventDefault();

            var group = $(this).attr('group');
            var lang = $(this).attr('lang');

            $.ajax({
                method: "POST",
                url: "./modul/reglement/load.php",
                data: {group:group, lang:lang},
                success: function(data){
                    if(data){

                        $('#textareaContent').html('<textarea name="RegContent" id="RegContent">' + data + '</textarea><br/>');

                    } else {

                        $('#textareaContent').html('<textarea name="RegContent" id="RegContent">Noch kein Inhalt...</textarea><br/>');

                    }

                    CKEDITOR.replace( "RegContent" );
                    $('#textareaContent').slideDown('fast');
                    $('#safeRegChange').slideDown('fast');
                    $('#safeRegChange').attr('groupID', group);
                    $('#safeRegChange').attr('langID', lang);

                }
            });

        });

    });

    $('#safeRegChange').click(function(){
        //TODO
    });

});
