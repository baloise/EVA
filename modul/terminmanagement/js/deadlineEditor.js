function toggleEdit(groupID){
    $('.toggleEditGroup').each(function(){

        if($(this).attr('id') == groupID){
            $(this).slideToggle('fast');
        }

    });
}

$(document).ready(function(){

    $('#toggleDeadlineAdder').click(function(){

        $('#deadlineAdder').slideToggle('fast');

    });

    var typingTimer;
    var notdone = 0;
    var did = 0;

    $('.deadlineHead').each(function(){
        $(this).click(function(){

            did = $(this).attr("did");

            $('.deadlineContent').each(function(){

                if($(this).attr('did') == did){
                    $(this).slideToggle("fast");
                } else {
                    $(this).slideUp("fast");
                }

            });

        });
    });

    $('.deadlineListToggler').each(function(){
        $(this).click(function(){

            var semID = $(this).attr("semID");

            $('.deadlineList').each(function(){

                if($(this).attr('semID') == semID){
                    $(this).slideToggle("fast");
                } else {
                    $(this).slideUp("fast");
                }

            });

        });
    });

    function doneTyping() {

        if ($.active == 0){

            $('#loadingTable' + did).slideUp("fast");
            $('#successText').html(translate[101]);
            $("#successAlert").slideDown("fast").delay(1300).slideUp("fast");

        } else {
            notdone = 1;
        }
    }

    $(document).ajaxStop(function(){
        if(notdone == 1){
            $('#loadingTable').slideUp("fast");
            $('#successText').html(translate[101]);
            $("#successAlert").slideDown("fast").delay(1300).slideUp("fast");
        }
    });

    $('.changeInTable').each(function(){

        $(this).on("keyup change", function(){

            clearTimeout(typingTimer);

            did = $(this).attr("did");
            var fType = $(this).attr("fType");
            var lang = $(this).attr("lang");
            var content = $(this).val();

            $('#loadingTable' + did).slideDown("fast");


            if(did && fType){
                event.preventDefault();
                $.ajax({
                    async: true,
                    method: "POST",
                    url: "./modul/terminmanagement/modify.php",
                    data: {todo:"editList", did:did, fType:fType, lang:lang, content:content},
                    success: function(data){
                        if(data){
                            $('#errorText').html(data);
                            $('#errorAlert').slideDown("fast");
                        } else {


                            typingTimer = setTimeout(doneTyping, 1000);

                        }
                    }
                });
            }

        });


    });

    $('.updateSems').each(function(){

        $(this).change(function(){

            var selGroup = $(this).val();
            var obj = $(this);
            did = $(this).attr("did");

            if(selGroup){
                $.ajax({
                    method: "POST",
                    url: "./modul/terminmanagement/modify.php",
                    data: {todo:"getSemester", selGroup:selGroup},
                    success: function(data){
                        if(data){

                            $('.inTableSelect').each(function(){

                                if($(this).attr("did") == did){
                                    $(this).html(data).removeAttr("disabled");
                                }

                            });

                        } else {
                            $('#errorText').html(translate[158]);
                            $('#errorAlert').slideDown("fast");
                        }
                    }
                });
            } else {
                $('#fsem').html("").attr("disabled", true);
            }

        });

    });

    $('#addNewdid').click(function(){

        $(this).prop("disabled",true);
        $('#errorAlert').slideUp("fast");

        var title_de = $('#fTitle_de').val();
        var title_fr = $('#fTitle_fr').val();
        var title_it = $('#fTitle_it').val();

        var description_de = $('#fDescription_de').val();
        var description_fr = $('#fDescription_fr').val();
        var description_it = $('#fDescription_it').val();

        var deadline = $('#fDeadline').val();
        var semester = $('#fSemester').val();
        var error = "";

        if(!deadline){
            error = error + "<li>" + translate[179]+"</li>";
        }

        if(!semester){
            error = error + "<li>" + translate[150]+"</li>";
        }

        if(error){
            $('#errorText').html(error);
            $('#errorAlert').slideDown("fast");
            $(this).prop("disabled",false);
        } else {
            $.ajax({
                method: "POST",
                url: "./modul/terminmanagement/modify.php",
                data: {todo:"addDid", title_de:title_de, title_fr:title_fr, title_it:title_it, description_de:description_de, description_fr:description_fr, description_it:description_it, deadline:deadline, semester:semester},
                success: function(data){
                    if(data){
                        $('#addNewdid').prop("disabled",false);
                        $('#errorText').html(data);
                        $('#errorAlert').slideDown("fast");
                    } else {

                        $('#successText').html(translate[103]);
                        $("#successAlert").slideDown("fast").delay(1300).slideUp("fast",function(){
                            $("#pageContent").load("modul/terminmanagement/terminmanagement.php", function(){
                                $('.loadScreen').fadeTo("fast", 0, function(){
                                    $('#pageContents').fadeTo("fast", 1);
                                });
                            });
                        });

                    }

                }
            });
        }

    });

    $('.removeDid').each(function(){

        $(this).click(function(){

            did = $(this).attr("did");

            $('#warningText').html("<strong>" + translate[122] + "</strong> " + translate[98]);
            $('#warningAlert').slideDown("fast");
            $("#warningButton").slideDown("fast");
            $("#warningButton").click(function(event){
                if(did){

					$(this).prop("disabled",true);

                    event.preventDefault();

                    $.ajax({
                        method: "POST",
                        url: "./modul/terminmanagement/modify.php",
                        data: {todo:"deleteDid", did:did},
                        success: function(data){
                            if(data){

                            } else {
                                $(".rowID" + did).each(function(){
                                    $(this).slideUp("slow");
                                });
                                $("#warningAlert").slideUp("fast");
								$("#warningButton").prop("disabled",false);
                            }
                        }
                    });

                }
            });

        });

    });

});
