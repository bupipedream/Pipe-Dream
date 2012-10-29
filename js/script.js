/* Author: Daniel O'Connor / www.danoc.me */

$(document).ready(function() {
	
	$(".gallery").fancybox({
		'titlePosition'	: 'over'
	});
	
	$("#emergency").click(function(){
		window.location=$(this).find("a").attr("href");
		return false;
	});
	
});