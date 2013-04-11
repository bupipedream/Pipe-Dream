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
			var iconSrc = $("#weather").data('template-url') + '/img/weather/';
			// Weather codes from Yahoo!
			// http://developer.yahoo.com/weather/#codes
			switch(parseInt(weather.code, 10)) {
				case 1: // tornado
				case 3: // hurricane
				case 6: iconSrc += 'hurricane.png'; break; // mixed rain and sleet

				case 2: // tropical storm
				case 4: // severe thunderstorms
				case 37: // isolated thunderstorms
				case 38: // scattered thunderstorms
				case 39: // scattered thunderstorms
				case 45: // thundershowers
				case 47: iconSrc += 'lightning.png'; break; // isolated thundershowers

				case 5: // mixed rain and snow
				case 7: // mixed snow and sleet
				case 13: // snow flurries
				case 14: // light snow showers
				case 15: // blowing snow
				case 16: // snow
				case 17: // hail
				case 18: // sleet
				case 41: // heavy snow
				case 43: // heavy snow
				case 46: iconSrc += 'snow.png'; break; // snow showers

				case 8: // freezing drizzle
				case 9: // drizzle
				case 10: // freezing rain
				case 11: // showers
				case 12: // showers
				case 35: // mixed rain and hail
				case 40: iconSrc += 'rain.png'; break; // scattered showers

				case 19: // dust
				case 25: // cold
				case 26: // cloudy
				case 27: // mostly cloudy (night)
				case 28: // mostly cloudy (day)
				case 29: // partly cloudy (night)
				case 30: iconSrc += 'mostly-cloudy.png'; break; // partly cloudy (day)

				case 20: // foggy
				case 21: // haze
				case 22: iconSrc += 'fog.png'; break; // smoky

				case 23: // blustery
				case 24: iconSrc += 'wind.png'; break; // windy

				case 31: // clear (night)
				case 32: // sunny
				case 36: iconSrc += 'sun.png'; break; // hot

				case 33: // fair (night)
				case 34: // fair (day)
				case 44: iconSrc += 'partly-sunny.png'; break; // partly cloudy

				case 42: iconSrc += 'sun-shower.png'; break; // scattered snow showers

				default: iconSrc = false; break;
			}

			var weatherHTML = '<span title="' + weather.currently + ', ' + weather.temp + ' degrees in '+ weather.city +', '+weather.region+'">'
			if(iconSrc) weatherHTML += '<img src="' + iconSrc + '" alt="' + weather.currently + '">';
			weatherHTML += weather.temp + '&deg</span>';
			$("#weather").html(weatherHTML);
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

	$('.page-id-19482 .section-category a').click(function(e) {
		e.preventDefault();
		var section = $(this).parentsUntil('.page-section').parent();
		var old = section.find('.active');
		// remove the active class from the currently active button
		old.removeClass('active');
		
		$(this).parent().addClass('active');
		section.find('.section-description[data-section="'+ old.children('a').data('section') +'"]').hide();

		section.find('.section-description[data-section="'+ $(this).data('section') +'"]').show();
	});

	// randomize the staff on the staff page
	// http://stackoverflow.com/a/7237495
	var staffArray = $('#staff-grid').children().get().sort(function() {
		return 0.5 - Math.random();
	});
	$('#staff-grid').append(staffArray);

	// show staff bio on staff page
	$('#staff-grid figure').click(function(e) {
		e.preventDefault();
		var old = $('#staff-grid figure.active');
		if($(this).hasClass('active')) { // new one is same as old active
			// just close the extra info
			$(this).removeClass('active');
		} else {
			old.removeClass('active'); // hide old bio
			$(this).addClass('active'); // show the bio

			$('#staff-grid figure').each(function( index ) {
				if(((index % 4) !== 0) && $(this).hasClass('active')) {
					// if not first in row and is new active figure, then
					// move new photo to beginning of row
					var newFirst = $(this);
					var firstInRow = $('#staff-grid figure:nth-child('+ (index - (index%4) + 1) +')');
					$(firstInRow).before(this);
				}
			});
		}
	});

});


// parseRSS plugin to pull info for the 'RAVE' alerts 
// parseRSS('http://www.getrave.com/rss/binghamton/channel1?r=' + Math.floor(Math.random()*90000) + 10000 , function(e) {
// var n = e['entries'][0]['title'];
// if(n.indexOf("Alert--ALL CLEAR") === -1) {
// 	var title = e['entries'][0]['title'];
// 	var content = e['entries'][0]['content'];
// 		$('#rave').html(title + " " + content );
// }	
// });
