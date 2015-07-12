$(document).ready(function(){

	$(".dropdown").hover(
			  function () {
			    $(this).addClass('open');
			  }, 
			  function () {
			    $(this).removeClass("open");
			  }
			);
	$(".descContainer p").addClass("ellipsis");
	
	$(".ellipsis").dotdotdot();
	
	
});