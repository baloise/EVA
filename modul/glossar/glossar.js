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

    $('.saveText').each(function(){
        $(this).click(function(){

            var textId = $(this).attr('id');
            newText = CKEDITOR.instances["textarea-"+textId].getData();
            button = $(this);

            $.ajax({
                method: "POST",
                url: "./modul/glossar/editText.php",
                data: {textId:textId, newText:newText},
                success: function(data){
                    if(data){

                        $('#errorText').html(data);
                        $('#errorAlert').slideDown("fast");

                    } else {

                        CKEDITOR.remove("textarea-"+textId);

                        $('#successText').html(translate[101]);
                        $("#successAlert").slideDown("fast").delay(1300).slideUp("fast");
                        button.slideUp('fast', function(){

                            $('.textContentSpace').each(function(){
                                if($(this).attr('id') == textId){

                                    $(this).html(newText);

                                }
                            });

                            $('.editText').each(function(){
                                if($(this).attr('id') == textId){
                                    $(this).slideDown('fast');
                                }
                            });

                        });

                    }


                }
            });


        });
    });

    $('.editText').each(function(){
        $(this).click(function(){

            var textId = $(this).attr('id');
            $(this).slideUp('fast', function(){

                $('.saveText').each(function(){
                    if($(this).attr('id') == textId){
                        $(this).slideDown('fast');
                    }
                });

            });

            $('.textContentSpace').each(function(){

                if($(this).attr('id') == textId){

                    textContent = $(this).html();

                    $(this).fadeOut('fast', function(){
                        $(this).html("<br/><textarea id='textarea-"+textId+"'>"+textContent+"</textarea>");
                        CKEDITOR.replace("textarea-"+textId);
                        $(this).fadeIn('fast');
                    });

                }

            });

        });
    });

})
