(function($) {

	// cache a reference to the navigation div container (<div> with id = #nav)
	// declare $a variable
    var $mainNav = $("#nav"), $a;

    // add Red Item markup via JavaScript
    // (insert it into the navigation div container)
    // cache a reference to it
    $mainNav.append("<li id='red'></li>");
    var $itemRed = $("#red");

    // hide it
    $itemRed.hide();

    // use jQuery's hover() method that accepts two functions
    // 1/ executed on mouseover 2/ executed on mouseout

    // find a link that was just hovered
    $mainNav.find("a").hover(function() {
		// 1/ on mouseover:
		// cache a reference to the hovered link
        $a = $(this);

        // set the css left, width and height for Red Item
		// left - find the link parent that is <li> and grab its 'left' position
	    // width - find the link parent that is <li> and grab its 'width'
	    // height - grab the navigation div container 'height'
        $itemRed.css({
            'left': $a.parent().position().left,
            'width': $($a.parent()).width(),
            'height': $mainNav.height()
        });

        // fade in Red Item
        $itemRed.stop(false, true).fadeIn("slow");

    }, function() {
		// 2/ on mouseout:
		// hide the Red Item again
        $itemRed.hide();

    });
})(jQuery);


