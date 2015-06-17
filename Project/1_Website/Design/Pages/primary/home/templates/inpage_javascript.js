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
});

