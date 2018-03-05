$(document).ready(function(){

    var group;
    var lang;

    $('.openReg').each(function(){

        $(this).click(function(){

            $('#textareaContent').html("");

            $('#textareaContent').slideUp('fast');
            $('#safeRegChange').slideUp('fast');

            event.preventDefault();

            group = $(this).attr('group');
            lang = $(this).attr('lang');

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

        var contents = $('#RegContent').val();

        $.ajax({
            method: "POST",
            url: "./modul/reglement/change.php",
            data: {group:group, lang:lang, contents:contents},
            success: function(data){
                if(data){

                    $('#safeRegChange').addClass('alert-danger').html(translate['95']).delay(2000).removeClass('alert-danger').html(translate[254]);

                } else {

                    $('#textareaContent').html('<textarea name="RegContent" id="RegContent">Noch kein Inhalt...</textarea><br/>');

                }


            }
        });

    });

});
