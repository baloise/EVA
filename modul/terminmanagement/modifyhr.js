function search() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchList");
    li = ul.getElementsByClassName("searchRow");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName("searchFor")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
}

function unCountSems(semID, user, state, obj){

    if(semID && user){

        $.ajax({
            method: "POST",
            url: "./modul/terminmanagement/modify.php",
            data: {todo: 'unCount', semID:semID, user:user, state:$(obj).hasClass("alert-success")},
            success: function(data){
                if(data){
                    alert(data);
                } else {
                    if($(obj).hasClass("alert-success")){
                        $(obj).removeClass("alert-success");
                    } else {
                        $(obj).addClass("alert-success");
                    }
                }

            }
        });

    } else {
        alert ("Error: No changes made");
    }

}

$(document).ready(function(){

    $('.header').each(function(){

        $(this).click(function(){

            var userid = $(this).attr('userID');

            $('.detailed').each(function(){

                if($(this).attr('userID') == userid){
                    $(this).slideToggle('fast');
                } else {
                    $(this).slideUp('fast');
                }

            });

            $('.loadContent').each(function(){

                if($(this).attr('userId') == userid){

                    var containerToLoad = $(this);

                    if(containerToLoad.attr('loaded') != 1){

                        $.ajax({
                            method: "POST",
                            url: "./modul/terminmanagement/getDeadlines.php",
                            data: {userid:userid},
                            success: function(data){
                                if(data){

                                    containerToLoad.slideUp('fast', function(){
                                        containerToLoad.html(data);
                                        containerToLoad.slideDown('fast');
                                    });
                                    containerToLoad.attr('loaded', "1");

                                } else {
                                    containerToLoad.html("<div class='col-12'> "+translate[157]+".</div>");
                                }

                            }
                        });

                    }
                }

            });

        });

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
            $("#changesSaveNotif" + did).slideDown("fast").delay( 1400 ).slideUp("slow");

        } else {
            notdone = 1;
        }
    }

    $(document).ajaxStop(function(){
        if(notdone == 1){
            $('#loadingTable').slideUp("fast");
            $("#changesSaveNotif").slideDown("fast").delay( 1400 ).slideUp("slow");
        }
    });

    $('.changeInTable').each(function(){

        $(this).on("keyup", function(){

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
                            $("#error"+did).html(data).slideDown("fast");
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
                            alert(translate[158]);
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
        $('#error').slideUp("fast");

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
            error = error + "<br/>" + translate[179]+".";
        }

        if(!semester){
            error = error + "<br/>" + translate[150]+".";
        }

        if(error){
            $('#error').html(error).slideDown("fast");
            $(this).prop("disabled",false);
        } else {
            $.ajax({
                method: "POST",
                url: "./modul/terminmanagement/modify.php",
                data: {todo:"addDid", title_de:title_de, title_fr:title_fr, title_it:title_it, description_de:description_de, description_fr:description_fr, description_it:description_it, deadline:deadline, semester:semester},
                success: function(data){
                    if(data){
                        $('#addNewdid').prop("disabled",false);
                        $('#error').html(data).slideDown("fast");
                    } else {

                        $("#addedNotif").slideDown("fast").delay(1300).slideUp("fast",function(){
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

            $("#warning").slideDown("fast");
            $("#warnButton").click(function(event){
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
                                $("#warning").slideUp("fast");
								$("#warnButton").prop("disabled",false);
                            }
                        }
                    });

                }
            });

        });

    });

});

function modifyEntry(deadlineid, userid, state) {


            if(deadlineid && userid){

                if(state == 0 || state == 2){

                    $.ajax({
                        method: "POST",
                        url: "./modul/terminmanagement/modify.php",
                        data: {todo:"addEntry", userid:userid, deadlineid:deadlineid},
                        success: function(data){
                            if(data){
                                alert(data);
                            } else {

                                $('.deadline').each(function(){

                                    if($(this).attr('uid') == userid && $(this).attr('did') == deadlineid){
                                        $(this).removeClass('alert-danger').addClass('alert-success');
                                        $(this).attr('onclick', 'modifyEntry('+ deadlineid +', '+ userid +', 1);');
                                    }

                                });

                            }

                        }
                    });

                } else if (state == 1){

                    $.ajax({
                        method: "POST",
                        url: "./modul/terminmanagement/modify.php",
                        data: {todo:"deleteEntry", userid:userid, deadlineid:deadlineid},
                        success: function(data){
                            if(data){
                                alert(data);
                            } else {

                                $('.deadline').each(function(){

                                    if($(this).attr('uid') == userid && $(this).attr('did') == deadlineid){
                                        $(this).removeClass('alert-success');
                                        $(this).attr('onclick', 'modifyEntry('+ deadlineid +', '+ userid +', 0);');
                                    }

                                });

                            }

                        }
                    });

                } else {
                    alert("Error");
                }

            } else {
                alert("Error");
            }


    }

function expandDeadlines(semesterid, userid){

    $('.deadlineContent').each(function(){

        if($(this).attr("deadlineSemesterID") == semesterid && $(this).attr("userID") == userid){
            $(this).slideToggle('fast');
        } else {
            $(this).slideUp('fast');
        }

    });

}

function unCountSem(semID, userID, state){
    $(".SemUncounter").each(function(){

        if($(this).attr("did") == semID && $(this).attr("userID") == userID){

            var button = $(this);

            if(state == 1){

            } else {

            }

        }

    });
}
