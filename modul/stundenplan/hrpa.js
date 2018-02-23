$(document).ready(function(){

    $('.clickandload').each(function(){

        $(this).click(function(event){

            $(".timetableContent").slideDown("slow");

            var elem = $(this);

            $("#tafel_content").empty();
            $("#meldung").remove();

            event.preventDefault();

            //Legt die aktuelle Woche fest
            var today = new Date();
            var todayFormatted = today.getDate() + "-" + (today.getMonth()+1) + "-" + today.getFullYear();
            var thisWeek = moment(todayFormatted, 'DD-MM-YYYY').week();
            var thisWeekAndYear = thisWeek + "-" + today.getFullYear();

            $('#weekchangerDateNum').html(thisWeekAndYear);

            function setKalender(elem){



                var klasseId = $(elem).attr('classId');

                if (!klasseId){
                    klasseId = $('#k_auswahl').attr("value");
                }

                var weekdays = ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"];

                if (klasseId >= 0 && klasseId !== "") {

                    $.getJSON('http://home.gibm.ch/interfaces/133/tafel.php?klasse_id=' + klasseId + '&woche=' + thisWeekAndYear, function(result){

                        if (result != "") {

                            $.each(result, function(i, field){

                                var tr = '<tr><td class="agenda-date" class="active" rowspan="1"> ' +
                                                '<div class="dayofmonth">' + weekdays[field.tafel_wochentag] + '</div>' +
                                                '<div class="dayofweek"></div>' +
                                                '<div class="shortdate text-muted">' + field.tafel_datum + '</div></td>' +
                                            '<td class="agenda-time"> '+ field.tafel_von +' - '+ field.tafel_bis +' </td>' +
                                            '<td class="agenda-events"><div class="agenda-event">'+ field.tafel_longfach +'</div></td>' +
                                            '<td class="agenda-events"><div class="agenda-event">' + field.tafel_raum + '</div></td>' +
                                            '<td class="agenda-events"><div class="agenda-event">' + field.tafel_lehrer + '</div></td>' +
                                            '</tr>';



                                $('#tafel_content').append(tr);
                                $('#k_auswahl').val(klasseId);
                                $("#kalender_tafel").fadeTo("fast", 1);

                            });

                        }else{
                            //Falls keine Daten zurückgegeben werden, wird davon ausgegangen, dass Ferien sind.
                            $('#kalender_tafel').fadeTo("fast", 0);
                            $('#kalender_tafel').after('<p id="meldung">' + $translate[167] + '?</p>');

                        }

                    }).fail(function(jqXHR, textStatus, errorThrown) {

                        alert($translate['Fehler beim laden des Stundenplanes'] + ": " + textStatus);

                    });
                }

            }

            setKalender(elem);

            //ActionListener um zu erkennen ob die Woche nach Vorne geändert wurde, um danach den Stundenplan zu aktualisieren.
            $('.weekchangerNext').on('click', function(){

                $("#tafel_content").empty();
                $("#meldung").remove();

                var selectedWeek = $('#weekchangerDateNum').html();
                var weeks = selectedWeek.split('-')[0];
                if(weeks == '52'){

                    var year = parseInt(selectedWeek.split('-')[1]) + 1;
                    selectedWeek = '1-' + year;
                }else{

                    weeks = parseInt(weeks) + 1;
                    selectedWeek = weeks + '-' + selectedWeek.split('-')[1];
                }

                //Änderung der bestimmten Woche und erneute Ausführung der Kalender-Function
                $('#weekchangerDateNum').html(selectedWeek);
                thisWeekAndYear = selectedWeek;

                setKalender(elem);

            });

            //ActionListener um zu erkennen ob die Woche nach Hinten geändert wurde, um danach den Stundenplan zu aktualisieren.
            $('.weekchangerBefore').on('click',  function(){

                $("#tafel_content").empty();
                $("#meldung").remove();

                var selectedWeek = $('#weekchangerDateNum').html();
                var weeks = selectedWeek.split('-')[0];
                if(weeks == '1'){
                    var year = parseInt(selectedWeek.split('-')[1]) - 1;
                    selectedWeek = '52-' + year;
                }else{
                    weeks = parseInt(weeks) - 1;
                    selectedWeek = weeks + '-' + selectedWeek.split('-')[1];
                }

                //Änderung der bestimmten Woche und erneute Ausführung der Kalender-Function
                $('#weekchangerDateNum').html(selectedWeek);
                thisWeekAndYear = selectedWeek;

                setKalender(elem);

            });

        });

    });

});
