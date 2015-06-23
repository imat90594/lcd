$(document).ready(function(){
	$('.slider1').bxSlider({
	    slideWidth: 270,
	    minSlides: 2,
	    maxSlides: 4,
	    slideMargin: 5
	  });
	
	$('.carousel-fade').carousel({
		interval: 1000 * 15
	});
	
	$('.carousel').carousel({
	});
	
	$('#myTab a').click(function (e) {
	  e.preventDefault()
	  $(this).tab('show')
	});

	/* 
	* Test Locations
	* Austin lat/long: 30.2676,-97.74298
	* Austin WOEID: 2357536
	*/
	$(document).ready(function() {
	  loadWeather('Philippines',''); //@params location, woeid
	});

	function loadWeather(location, woeid) {
	  $.simpleWeather({
	    location: location,
	    woeid: woeid,
	    unit: 'c',
	    success: function(weather) {
	      html = '<h2></i> '+weather.temp+'&deg;'+weather.units.temp+'</h2>';
	     
	      
	      $("#weather").html(html);
	    },
	    error: function(error) {
	      $("#weather").html('<p>'+error+'</p>');
	    }
	  });
	}
});

