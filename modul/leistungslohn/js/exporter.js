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

    $('.getCSV').each(function(){

        $(this).click(function(){

            var currButtn = $(this);
            var type = $(this).attr('id');

            currButtn.prop('disabled', true);
            $('.getCSVnotif').each(function(){
                $(this).fadeIn('slow');
            });
            var users = [];

            var loadingText = setInterval(function(){

                $('.getCSVnotif').each(function(){
                    $(this).fadeOut('slow', function(){
                        $(this).fadeIn('slow');
                    });
                });

            }, 2000);

            $('.userEntry').each(function(){
                
                if($(this).hasClass(type)){
                    var userID = $(this).attr('userID');
                    var bKey = $(this).attr('bKey');

                    $('.cycleChecker').each(function(){
                        if($(this).attr('userID') == userID && $(this).find('input').prop('checked')){

                            var cycleID = $(this).find('input').attr('cycleID');
                            users.push([bKey, userID, cycleID]);

                        }
                    });
                }

            });

            $.ajax({
                method: "POST",
                url: "./modul/leistungslohn/call/createCSV.php",
                contentType: "application/json",
                data: JSON.stringify(users),
                success: function(data){

                    clearInterval(loadingText);

                    $('.getCSVnotif').each(function(){
                        $(this).fadeOut('slow');
                    });

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

                    currButtn.prop('disabled', false);

                }
            });

        });

    })

});
