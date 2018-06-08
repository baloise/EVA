$(document).ready(function(){

    $('.cycleChecker').each(function(){

        $(this).click(function(){

            var userID = $(this).attr('userID');
            var cycleID = $(this).find('input').attr('cycleID');

            if($(this).find('input').is(':checked')){
                $(this).find('input').prop("checked", false);
            } else {
                $(this).find('input').prop("checked", true);
            }

            $('.cycleChecker').each(function(){
                if($(this).attr('userID') == userID){
                    if($(this).find('input').attr('cycleID') != cycleID){
                        $(this).find('input').prop("checked", false);
                    }
                    if($(this).hasClass("alert-warning")){
                        $(this).removeClass("alert-warning");
                    }
                }
            });

        });

    });

    $('#getCSV').click(function(){

        $(this).prop('disabled', true);
        $('#getCSVnotif').fadeIn('slow');
        var users = [];

        var loadingText = setInterval(function(){
            $('#getCSVnotif').fadeOut('slow', function(){
                $('#getCSVnotif').fadeIn('slow');
            });
        }, 2000);

        $('.userEntry').each(function(){

            var userID = $(this).attr('userID');
            var bKey = $(this).attr('bKey');

            $('.cycleChecker').each(function(){
                if($(this).attr('userID') == userID && $(this).find('input').prop('checked')){

                    var cycleID = $(this).find('input').attr('cycleID');
                    users.push([bKey, userID, cycleID]);

                }
            });

        });

        $.ajax({
            method: "POST",
            url: "./modul/leistungslohn/call/createCSV.php",
            data: {userArray:users},
            success: function(data){
                clearInterval(loadingText);
                $('#getCSVnotif').fadeOut('fast');
                var element = document.createElement('a');
                element.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(data));
                element.setAttribute('download', 'Eva-Generated Salarys.csv');
                element.style.display = 'none';
                document.body.appendChild(element);
                element.click();
                document.body.removeChild(element);
                $('#getCSV').prop('disabled', false);
            }
        });

    });

});
