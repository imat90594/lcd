$(document).ready(function(){
	getSMTPState();
	$('select[name="use_smtp"]').change(function(){
		getSMTPState();
	});
	
	$("input[name='saveBtn']").click(function(){
		$('.modal-backdrop').addClass('in').removeClass('hide');
	});
});
function getSMTPState(){
	var state = $('select[name="use_smtp"]').val();
	if(state == 0){
		$('#smtp').find('input[name*="smtp_"]').attr('readonly',true);
	}
	else{
		$('#smtp').find('input[name*="smtp_"]').removeAttr('readonly');
	}
}