/** global: translate */
var url = "./modul/pe/modify.php";
var load = "./modul/pe/pe.php";
$(document).ready(function(){

    function calcGradeAVG(){

        var gradeCount = 0;
        var allGrades = 0;

        $('.calcGradesForm').each(function(){

            if($(this).val() >= 1 && $(this).val() <= 6){

                allGrades += parseFloat($(this).val());
                gradeCount++;

            }

        });

        if(gradeCount > 0){

            var gradeAvg = Math.round((allGrades / gradeCount) * 100) / 100;
            // Note -1 Mal 14.4 (Da max. Punktzahl = 72)
            var gradeInPoints = Math.round(((gradeAvg-1) * 14.4) * 100) / 100;

            $('#calcResult').html("<b>" + gradeAvg + " = " + gradeInPoints + " " + translate[67] + " <b>");
            $('#fPoints').val(gradeInPoints);

        } else {
            $('#calcResult').html(translate[171]);
        }
    }

    $('#calcGradesBtn').click(function(event){
        event.preventDefault();
        calcGradeAVG();
    });

    $('.calcGradesForm').each(function(){
        $(this).on('keyup', function(){
            calcGradeAVG();
        });
    });

});
