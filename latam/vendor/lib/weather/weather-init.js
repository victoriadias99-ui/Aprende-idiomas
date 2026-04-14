(function ($) {
    //    "use strict";

	var getCelsius = function (temp) {
    return Math.round((5.0/9.0)*(temp-32.0));
};


    function loadWeather(location, woeid) {
        $.simpleWeather({
            location: location,
            woeid: woeid,
            unit: 'f',
            success: function (weather) {
				 //$(".preloader").fadeIn();
				var isFarenheitBug = weather.units.temp === "F";
				if (isFarenheitBug) {
					weather.temp = getCelsius(parseInt(weather.temp));
					weather.units.temp = "C";
				}

                html = '<i class="wi wi-yahoo-' + weather.code + '"></i><h2> ' + weather.temp + '&deg;' + weather.units.temp + '</h2>';
                html += '<div class="city">' + weather.city + ', ' + weather.region + '</div>';
                html += '<div class="currently">' + weather.currently + '</div>';
                html += '<div class="celcious">' + weather.alt.temp + '&deg;C</div>';

                $("#weather-one").html(html);
				 $(".preloader").fadeOut();
            },
            error: function (error) {
                $("#weather-one").html('<p>' + error + '</p>');
				//$(".preloader").fadeOut();
            }
        });
    }


    // init
    loadWeather('Buenos Aires', '');

})(jQuery);
