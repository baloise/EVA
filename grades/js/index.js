function toggleConts(contsID){

    $('.toToggleConts').each(function(){

        if($(this).attr('contsID') == contsID){
            $(this).slideToggle('fast');
        }

    });

}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}

function makeSubject(array){

    var catchContent = "";

    for (var i in array) {

        if(i == "Subject Name"){

            catchContent = catchContent + ("<div class='card highlighter' style='padding-left:15px;padding-right:15px;margin-bottom:10px;'>");
            catchContent = catchContent + ("<br/><b style='margin-left:auto; margin-right:auto;'>" + array[i] + "</b><br/>");

        } else  if(i == "Grades"){

            catchContent = catchContent + ("<table class='table'>");
            catchContent = catchContent + ("<thead><tr><th>Title</th><th>Score</th><th>Weight</th></tr></thead><tbody>");

            for (var y in array[i]) {

                catchContent = catchContent + ("<tr><td>" + array[i][y]['Title'] + "</td>");
                catchContent = catchContent + ("<td>" + array[i][y]['Score'] + "</td>");
                catchContent = catchContent + ("<td>" + array[i][y]['Weight'] + "%</td></tr>");

            }

            catchContent = catchContent + ("</tbody></table>");
            catchContent = catchContent + ("</div>");

        }
    }

    return catchContent;

}

function processXML(content){

    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("deliver");

    if (c) {
        var array = content;
    } else {
        var array = JSON.parse("[" + content + "]");
        var array = array[0];
    }
    var htmlContent = "";
    htmlContent = '<h2>' + array["Title"] + '</h2> <p> Created:' + array["Date"] + '</p>';

    for (var i in array) {
        for (var y in array[i]) {
            for (var z in array[i][y]) {
                if(z == "Semester"){

                    htmlContent = htmlContent + ('\
                        <div class="highlighter card"  style="padding: 20px;margin-top: 5px; margin-left:auto; margin-right:auto; margin-bottom: 80px;"> \
                            <div class="row" style="cursor: pointer;" onclick="toggleConts(' + array[i][y][z] + ')";>\
                                <div class="col-12 text-center">\
                                    <h2>Semester ' + array[i][y][z] + '</h2>\
                                </div>\
                            </div>\
                            <br/>\
\
                            <div class="row toToggleConts" contsID="' + array[i][y][z] + '" style="display:1;">\
                                <div class="col-lg-11" style=" margin-left: auto; margin-right: auto;">\
                    ');

                } else  if(z== "Subjects"){

                    for (var x in array[i][y][z]) {
                        var subjectEntry = array[i][y][z][x];
                        htmlContent = htmlContent + makeSubject(subjectEntry);
                    }

                    htmlContent = htmlContent + ('\
\
                                </div>\
                            </div>\
                        </div>\
                    ');

                }
            }
        }
    }

    $('#gradesContent').html(htmlContent);

}

$(document).ready(function () {
    
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("deliver");

    $('.loadScreen').fadeTo("fast", 0, function(){
		$("#slideMe").slideDown("slow");
		$("#slideMeFoot").slideDown("slow");
        $('#pageContents').fadeTo("fast", 1, function () {
            if (c) {
                $.ajax({
                    method: "POST",
                    url: "../modul/noten/call/createJSON.php",
                    success: function(data){
                        if (data) {
                            processXML(data);
                            window.print();
                        }
                    }
                }); 
            }
        });
    });

    document.getElementById('uploadedFile').addEventListener('change',function () {
        var fr = new FileReader();
        fr.onload = function () {
            processXML(this.result);
        };
        fr.readAsText(this.files[0]);
    });

});
