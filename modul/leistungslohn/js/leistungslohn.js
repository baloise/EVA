function search() {

    $('.groupContent').each(function(){
        $(this).slideDown("slow");
    });

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

function toggleGroup(groupID){

    $('.groupContent').each(function(){

        if($(this).attr("groupID") == groupID){
            $(this).slideToggle("fast");
        }

    });

}

function toggleUser(userID){

    $('.userContent').each(function(){

        if($(this).attr("userID") == userID){
            $(this).slideToggle("fast");
        }

    });

}

function toggleCycle(userID, cycleID){

    $('.loading').each(function(){
        $(this).slideDown("fast");
    });

    $('.cycleContent').each(function(){

        if($(this).attr("userID") == userID && $(this).attr("cycleID") == cycleID){

            var cycleContentObject = $(this);

            $(cycleContentObject).slideToggle("fast");

            $.ajax({
                method: "POST",
                url: "./modul/leistungslohn/call/createContent.php",
                data: {userID:userID, cycleID:cycleID},
                success: function(data){
                    if(data){

                        $('.loading').each(function(){
                            $(this).slideUp("slow");
                        });

                        $(cycleContentObject).html(data);

                    } else {

                        $('.loading').each(function(){
                            $(this).slideUp("slow");
                        });

                        $(cycleContentObject).html($translate[157]);

                    }

                }
            });

        }

    });

}

function toggleSemester(userID, semesterID){

    $('.semesterContent').each(function(){

        if($(this).attr("userID") == userID && $(this).attr("semesterID") == semesterID){
            $(this).slideToggle("fast");
        }

    });

}

function toggleCycleExam(userID, cycleID){

    $('.cycleContentExam').each(function(){

        if($(this).attr("userID") == userID && $(this).attr("cycleID") == cycleID){
            $(this).slideToggle("fast");
        }

    });

}

$(document).ready(function(){

    $('#openExporter').click(function(){

        $('#exporterContents').load('./modul/leistungslohn/exporter.php');

    });

});
