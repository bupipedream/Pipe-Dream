/* Author: Daniel O'Connor / www.danoc.me */

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

});
