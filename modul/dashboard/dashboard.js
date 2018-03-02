function move(elemID, speed, fully) {
	var elem = document.getElementById(elemID);
	var width = 1;
	var id = setInterval(frame, speed, fully);
	function frame() {
		if (width >= fully) {
			clearInterval(id);
		} else {
			width++;
			elem.style.width = width + '%';
			elem.innerHTML = "<b style='color:white;'>" + width * 1 + '% </b>';
		}
	}
}

$(document).ready(function(){

	$('.mt-5').delay(1000).fadeTo("slow", 1);

    $(".dashModul").each(function(){

        makeDynamic(this);

    });

    jQuery('img.svg').each(function(){

        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {

            var $svg = jQuery(data).find('svg');

            if(typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }

            if(typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            $svg = $svg.removeAttr('xmlns:a');

            $img.replaceWith($svg);

        }, 'xml');

    });

});
