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
                    $('#errorText').html(data);
                    $('#errorAlert').slideDown("fast");
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
        $('#errorText').html(translate[157]);
        $('#errorAlert').slideDown("fast");
    }

}

$(document).ready(function(){

    $('#getEditor').click(function(){

        if($('#editDeadlinesContent').attr('loaded') == "false"){

            $('#editDeadlinesContent').load('modul/terminmanagement/call/deadlineEditor.php', function(){
                $('#editDeadlinesContent').attr('loaded', 'true');
                $('#editDeadlinesContent').slideDown('fast');
                $('html,body').animate({scrollTop: $("#editDeadlinesContent").offset().top}, 'slow');
            });

        }

    });

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
                            url: "./modul/terminmanagement/call/getDeadlines.php",
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
                                $('#errorText').html(data);
                                $('#errorAlert').slideDown("fast");
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
                                $('#errorText').html(data);
                                $('#errorAlert').slideDown("fast");
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
                    $('#errorText').html(translate[95]);
                    $('#errorAlert').slideDown("fast");
                }

            } else {
                $('#errorText').html(translate[95]);
                $('#errorAlert').slideDown("fast");
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
