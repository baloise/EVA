function toggleConts(contsID){

    $('.toToggleConts').each(function(){

        if($(this).attr('contsID') == contsID){
            $(this).slideToggle('fast');
        }

    });

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

    var htmlContent = "";

    console.log(content);

    var array = JSON.parse("[" + content + "]");

    var array = array[0];
    console.log(array);

    htmlContent = '<h2>' + array["Title"] + '</h2> <p> Created:' + array["Date"] + '</p>';

    for (var i in array) {

        for (var y in array[i]) {

            for (var z in array[i][y]) {

                if(z == "Semester"){

                    htmlContent = htmlContent + (`
                        <div class="highlighter card"  style="padding: 20px;margin-top: 5px; margin-left:auto; margin-right:auto;">
                            <div class="row" style="cursor: pointer;" onclick="toggleConts(` + array[i][y][z] + `)";>
                                <div class="col-12 text-center">
                                    <h2>Semester ` + array[i][y][z] + `</h2>
                                </div>
                            </div>
                            <br/>

                            <div class="row toToggleConts" contsID="` + array[i][y][z] + `" style="display:none;">
                                <div class="col-lg-11" style=" margin-left: auto; margin-right: auto;">
                    `);

                } else  if(z== "Subjects"){

                    for (var x in array[i][y][z]) {
                        //htmlContent = htmlContent + (z + " Entry: " + array[i][y][z][x] + "<br/>");
                        var subjectEntry = array[i][y][z][x];
                        htmlContent = htmlContent + makeSubject(subjectEntry);
                    }

                    htmlContent = htmlContent + (`

                                </div>
                            </div>
                        </div>
                    `);

                }
            }
        }
    }

    $('#gradesContent').html(htmlContent);

}

$(document).ready(function(){

    $('.loadScreen').fadeTo("fast", 0, function(){
		$("#slideMe").slideDown("slow");
		$("#slideMeFoot").slideDown("slow");
        $('#pageContents').fadeTo("fast", 1);
    });

    document.getElementById('uploadedFile').addEventListener('change',function () {
        var fr = new FileReader();
        fr.onload = function () {
            processXML(this.result);
        };
        fr.readAsText(this.files[0]);
    });


});
