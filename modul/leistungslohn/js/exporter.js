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

        //"B-KEY", "USER-ID", "CYCLE-ID"
        var users = [];

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

        console.log(users);

        $.ajax({
            method: "POST",
            url: "./modul/leistungslohn/call/createCSV.php",
            data: {userArray:users},
            success: function(data){
                var element = document.createElement('a');
                element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(data));
                element.setAttribute('download', 'Eva-Generated Salarys.csv');
                element.style.display = 'none';
                document.body.appendChild(element);
                element.click();
                document.body.removeChild(element);
            }
        });

    });

});
