$(document).ready(function(){
	$(".slider1").mCustomScrollbar({
	    theme:"rounded-dots",
	});
	
	$('#linkScroll1').click(function(){
	    $('html, body').animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 500);

	});
	$('#linkScroll2').click(function(){
	    $('html, body').animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 500);

	});
	$('#linkScroll3').click(function(){
	    $('html, body').animate({
	        scrollTop: $( $(this).attr('href') ).offset().top
	    }, 500);

	});
});


