$(document).ready(function(){
    $('#searchInput').on('keyup', function(){

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

    });
});
