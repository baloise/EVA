	//Lädt die Berufe beim Laden der Seite
	SetKlassen();

	//Legt die aktuelle Woche fest
	var today = new Date();
	var todayFormatted = today.getDate() + "-" + (today.getMonth()+1) + "-" + today.getFullYear();
	var thisWeek = moment(todayFormatted, 'DD-MM-YYYY').week();
	var thisWeekAndYear = thisWeek + "-" + today.getFullYear();

	$('#weekchangerDateNum').html(thisWeekAndYear);

	//Lädt die Klassen anhand des ausgewählten Berufes und fügt sie in das Dropdown ein
	function SetKlassen() {
		$("#k_auswahl").empty();

			$.getJSON('http://home.gibm.ch/interfaces/133/klassen.php','beruf_id=10',function(antwort){

				$('#k_auswahl').append($('<option>',
				{
					text : "-"
				}));


				$.each(antwort,function(klassenId,klasse)
				{

					$('#k_auswahl').append($('<option/>',{
						value: klasse['klasse_id'],
						text : klasse['klasse_longname']
					}));
				});
				$('#klasse_Dropdown').fadeIn();
			});
	}

	//Lädt die Kalenderinfos anhand der Klasse und der bestimmten Woche, formatiert diese und zeigt sie auf der Webseite an
	function setKalender(){

		$("#tafel_content").empty();
		$("#meldung").remove();

		var klasseId = $('#k_auswahl').val();

        if (!klasseId){
            klasseId = $('#k_auswahl').attr("value");
        }

		var weekdays = ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"];

		$('#weekchangerDateNum').html(thisWeekAndYear);

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



						//var tr = '<tr><td>' + field.tafel_datum + " " + weekdays[field.tafel_wochentag] + '</td><td>' + field.tafel_von +" - "+ field.tafel_bis + '</td><td>' + field.tafel_longfach
						//+ '</td><td>' + field.tafel_raum + '</td><td>' + field.tafel_lehrer + '</td></tr>';

						$('#tafel_content').append(tr);
                        $('#k_auswahl').val(klasseId);

					});

				}else{
					//Falls keine Daten zurückgegeben werden, wird davon ausgegangen, dass Ferien sind.
					$('#kalender_tafel').fadeTo("fast", 0);
					$('#kalender_tafel').after('<p id="meldung">'+translate["Keine Daten aus dieser Kalenderwoche: Ferien"]+ '?</p>');

				}

		  }).fail(function(jqXHR, textStatus, errorThrown) {

			alert(translate['Fehler beim laden des Stundenplanes'] + ": " + textStatus);

		  });
		}

		$('.weekchanger').fadeTo("fast", 1);
		$('#kalender_tafel').fadeTo("fast", 1);

	}

	//ActionListener um zu erkennen, ob ein Beruf ausgewählt wurde, um danach die Klassen zu laden und per Animation anzeigen zu lassen
	$( "#b_auswahl" ).change(function() {
		if(this.value !== ""){
			SetKlassen();
			$('#klassenauswahl').fadeTo("fast", 1);
			$('.weekchanger').fadeTo("fast", 0);
			$('#kalender_tafel').fadeTo("fast", 0);
		} else {
			$('#klassenauswahl').fadeTo("fast", 0);
			$('.weekchanger').fadeTo("fast", 0);
			$('#kalender_tafel').fadeTo("fast", 0);
		}
	});

	//ActionListener um zu erkennen, ob eine Klasse ausgewählt wurde, um danach den Stundenplan zu generieren und per Animation anzeigen zu lassen
	$( "#klassenauswahl" ).change(function() {
		if(this.value !== ""){
            $("#saveClassButton").slideDown("slow");
			thisWeekAndYear = thisWeek + "-" + today.getFullYear();
			setKalender();
			document.cookie = "beruf=" + $('#b_auswahl').val();
			document.cookie = "klasse=" + $('#k_auswahl').val();
            $("#stundenplan").fadeTo("fast", 1);
		} else {
			$('.weekchanger').fadeTo("fast", 0);
			$('#kalender_tafel').fadeTo("fast", 0);
		}
	});

	//ActionListener um zu erkennen ob die Woche nach Vorne geändert wurde, um danach den Stundenplan zu aktualisieren.
	$('.weekchangerNext').on('click', function(){

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

		setKalender();

	});

	//ActionListener um zu erkennen ob die Woche nach Hinten geändert wurde, um danach den Stundenplan zu aktualisieren.
	$('.weekchangerBefore').on('click',  function(){

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

		setKalender();

	});

$(document).ready(function(){

    if($("#k_auswahl").attr("value")){


        $('#k_auswahl').val($('#k_auswahl').attr("value"));
        thisWeekAndYear = thisWeek + "-" + today.getFullYear();
		document.cookie = "beruf=" + $('#b_auswahl').val();
		document.cookie = "klasse=" + $('#k_auswahl').val();
        setKalender();
        $("#stundenplan").fadeTo("fast", 1);

    }

    $("#saveClassButton").click(function(){

        var error = "";
        var classSel = $("#k_auswahl").val();

        if(!classSel && classSel != "-"){
            error = error + translate["Keine Klasse ausgewählt"];
        }

        if(error){

        } else {

            $.ajax({
                method: "POST",
                url: "./modul/stundenplan/modify.php",
                data: {classSel:classSel},
                success: function(data){

                    if(data){
                        $("#error").html(data).slideDown("fast");
                    } else {

                        $("#saveClassButton").css("background-color", "green").delay(1000).slideUp("slow", function(){
                             $("#saveClassButton").css("background-color", "#007bff");
                             $("#saveClassButton").html((translate["Klasse speichern"]));
                        });
                        $("#saveClassButton").html(translate["Klasse gespeichert"] + "!");


                    }

                }
            });

        }

    });

});
