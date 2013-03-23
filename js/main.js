/* Author: Daniel O'Connor / www.danoc.me */

$(window).resize(function() {
	console.log(document.documentElement.clientWidth);
	// if(document.documentElement.clientWidth < 840) {
	// 	$('#date-weather').removeClass().addClass('span7');
	// 	$('#logo').removeClass().addClass('span10');
	// 	$('#search-social').removeClass().addClass('span7');
	// } else {
	// 	$('#date-weather').removeClass().addClass('span6');
	// 	$('#logo').removeClass().addClass('span12');
	// 	$('#search-social').removeClass().addClass('span6');
	// }
});

$(document).ready(function() {
	
	$(".gallery").fancybox({
		'titlePosition'	: 'over'
	});
		
	$.simpleWeather({
		zipcode: '13902',
		unit: 'f',
		success: function(weather) {
			html = '<span title="' + weather.currently + ' and ' + weather.temp + ' degrees in '+ weather.city +', '+weather.region+'">'
			html += '<img src="' + $("#weather").data('template-url') + '/img/weather/partly-sunny.png" alt="Party Sunny">';
			html += weather.temp + '&deg</span>';		
			$("#weather").html(html);
		},
		error: function(error) {}
	});

	$('#mobile-search-link').click(function(e) {
		e.preventDefault();
		
		var search = $('#mobile-search');

		$(this).hide();
		search.slideDown();
		search.find("input[type='search']").focus();
	});

});