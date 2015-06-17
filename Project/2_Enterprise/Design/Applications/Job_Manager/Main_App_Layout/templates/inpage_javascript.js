$(document).ready(function() {
	CKEDITOR.replaceAll('editor');
	//-------------------------------------------------------------------------------------------------		
	//FORM VALIDATION

	jQuery("form").validationEngine();    

	
	//==========================================================================================
	//TAG INPUT
	$('.tagInput').tagsInput({
		'width':'650px',
		'defaultText':'add email Receiver',
	});
	
	//==========================================================================================
	//SORTABLE
	

	$('.sortable').sortable().bind('sortupdate', function(e, ui) {
		items = new Array();
		
		$(".list li").each(function(){
			items.push({job_id:$(this).attr("data-job_id"), priority_number:$(this).attr("data-priority_number")});
		});
		
		
		php.beforeSend = function(){
			$("#popUp_background").fadeIn();
		}
		
		
		$.php("/ajax/job_manager/jobs/updateJobPriority", {items:items});
		
	
		php.complete = function(){
			$("#popUp_background").fadeOut();
		}
		
	});
	
	
	//=========================================================================================
	//JOBS
	
	//add job
	$('span.addJob').click(function(){
		$('div.addJob_popUp, #popUp_background').fadeIn();
	});

	$('span.keep_job, span.cancel').click(function(){
		$('div.popupDialog, div.popUp_delete, #popUp_background').fadeOut();
	});
	
	//delete job
	$('span.deleteJob').click(function(){
		job_id = $(this).attr("data-job_id");
		
		$("#deletejob input[name=job_id]").val(job_id);
	});
	
	//chek permalink
	
	$(".addJob_popUp input[name=add_job]").click(function(e){
		e.preventDefault();
		job_title = $(".addJob_popUp input[name=job_title]").val();
		
		//submission of form is in ajax controller
		$.php("/ajax/job_manager/jobs/checkJobPermalink", {job_title:job_title});
		
	});
	
});
