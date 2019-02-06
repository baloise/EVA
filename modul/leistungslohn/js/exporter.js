$(document).ready(function(){

    $('.cycleChecker').each(function(){

        $(this).click(function(){

            var userID = $(this).attr('userID');
            var cycleID = $(this).find('input').attr('cycleID');

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
            contentType: "application/json",
            data: JSON.stringify(users),
            success: function(data){

                clearInterval(loadingText);
                $('#getCSVnotif').fadeOut('fast');

                if (navigator.msSaveBlob) { // IE 10+
                    var blob = new Blob([data],{type: "text/csv;charset=utf-8;"});
                    navigator.msSaveBlob(blob, "Eva-Generated Salarys.csv")
                } else {
                    var element = document.createElement('a');
                    if (element.download !== undefined) {
                        var element = document.createElement('a');
                        element.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(data));
                        element.setAttribute('download', 'Eva-Generated Salarys.csv');
                        element.style.display = 'none';
                        document.body.appendChild(element);
                        element.click();
                        document.body.removeChild(element);
                    }
                }

                $('#getCSV').prop('disabled', false);

            }
        });

    });

});
