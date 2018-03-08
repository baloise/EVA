$(document).ready(function(){

    var group;
    var lang;
    var textID;

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

                        var arrayContent = JSON.parse(data);
                        textID = arrayContent[0];

                        $('#textareaContent').html('<textarea style="height: 1500px;" name="RegContent" id="RegContent">' + arrayContent[1] + '</textarea><br/>');

                    } else {

                        $('#textareaContent').html('<textarea style="height: 1500px;" name="RegContent" id="RegContent">Noch kein Inhalt...</textarea><br/>');

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

        contents = CKEDITOR.instances.RegContent.getData();

        $.ajax({
            method: "POST",
            url: "./modul/reglement/change.php",
            data: {lang:lang, contents:contents, textID:textID},
            success: function(data){
                if(data){

                    alert(data);

                } else {

                    $('#success').slideDown('fast').delay(1000).slideUp('fast');

                }


            }
        });

    });

});
