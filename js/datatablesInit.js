/** global: translate */
$(document).ready(function() {

    var loader = setTimeout(function(){

        $('#loadingTable').fadeIn(100);

    },1000);

    $.getScript( "//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js", function() {
        $("#dtmake").dataTable({
            "columnDefs": [{
                "targets": 0,
                "orderable": false
            }],
            "language": {
                "sEmptyTable":      translate[86],
                "sInfo":            "_START_ " + translate[23] + " _END_ " + translate[24] + " _TOTAL_ " + translate[25],
                "sInfoEmpty":       "0 "+ translate[23]+" 0 "+ translate[24]+" 0 "+ translate[25],
                "sInfoFiltered":    "(gefiltert von _MAX_ Einträgen)",
                "sInfoPostFix":     "",
                "sInfoThousands":   ".",
                "sLengthMenu":      "_MENU_ " + translate[17],
                "sLoadingRecords":  "Wird geladen...",
                "sProcessing":      "Bitte warten...",
                "sSearch":          "",
                "sZeroRecords":     translate[87],
                "oPaginate": {
                    "sFirst":       translate[88],
                    "sPrevious":    translate[26],
                    "sNext":        translate[27],
                    "sLast":        translate[89]
                },
                "oAria": {
                    "sSortAscending":  ": aktivieren, um Spalte aufsteigend zu sortieren",
                    "sSortDescending": ": aktivieren, um Spalte absteigend zu sortieren"
                },
                select: {
                        rows: {
                        _: '%d Zeilen ausgewählt',
                        0: 'Zum Auswählen auf eine Zeile klicken',
                        1: '1 Zeile ausgewählt'
                        }
                }
            }
        });
        $('#dtmake_filter input').addClass('form-control').attr('placeholder', translate[28]);
        clearTimeout(loader);
        $('#loadingTable').slideUp(10, function(){
            $("#dtmake").slideDown("fast");
        });
    });
});
