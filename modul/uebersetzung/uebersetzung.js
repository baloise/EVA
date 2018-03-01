$('.accordian-body').on('show.bs.collapse', function () {
    $(this).closest("table")
        .find(".collapse.in")
        .not(this)
        .collapse('toggle')
})

function search() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchList");
    li = ul.getElementsByClassName("searchRow");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByClassName("searchFor")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

$(document).ready(function(){

    $('.changeTra').each(function(){

        $(this).click(function(){


            var button = $(this);
            var entryID = $(this).attr('traEntry');
            var entryGer, entryIta, entryFra;

            $('.inGerman').each(function(){
                if($(this).attr('traEntry') == entryID){
                    entryGer = $(this).val();
                }
            });

            $('.inItalian').each(function(){
                if($(this).attr('traEntry') == entryID){
                    entryIta = $(this).val();
                }
            });

            $('.inFrench').each(function(){
                if($(this).attr('traEntry') == entryID){
                    entryFra = $(this).val();
                }
            });

            $.ajax({
                type: "POST",
                data: {do: 'changeTra', entryID:entryID, entryGer:entryGer, entryIta:entryIta, entryFra:entryFra},
                url: "modul/uebersetzung/modify.php",
                success: function(data){
                    if(data){
                        alert(data);
                    } else {

                        $('.collapse').each(function(){

                            if($(this).attr('id') == entryID){
                                button.addClass('alert-success');
                                $(this).addClass('alert-success').delay(500).slideToggle('slow', function(){
                                    button.removeClass('alert-success');
                                    $(this).removeClass('alert-success').removeClass('show').attr("style", "");
                                });
                            }

                        });

                    }
                }
            });

        });

    });

});
