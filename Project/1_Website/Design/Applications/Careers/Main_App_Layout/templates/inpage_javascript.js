$(document).ready(function() {
	
	if( $("input[name=success]").val() == 1) {
		$("#thankyou").modal("show");
	}
	
	
	$("#photo").change(function(){
		imagePrev('#photo');
	});
	
	$( "select[name=date_of_birth_days]" ).addClass( "form-control w56" );
	$( "select[name=date_of_birth_months]" ).addClass( "form-control w67" );
	$( "select[name=date_of_birth_years]" ).addClass( "form-control w71" );
	
	$( "select[name=available_date_days]" ).addClass( "form-control" );
	$( "select[name=available_date_months]" ).addClass( "form-control" );
	$( "select[name=available_date_years]" ).addClass( "form-control" );
	
	$( "select[name=nationality]" ).addClass( "form-control w412" );
	
	togglePopUp();
	submitQuickApply();
	toggleButtons();
	updatePath();
	submitApplication();
	
	
	$('#applicationForm').each(function(){
		this.reset();
	});
	
	$(document).on("click", "#submitApplication", function(e){
		e.preventDefault();
		
		if (validateForm()) {
			
			recaptcha_response_field  = $("input[name=recaptcha_response_field]").val();
			recaptcha_challenge_field = $("input[name=recaptcha_challenge_field]").val();
			
			$.php("/ajax/careers/online-form/checkRecaptcha", {
				recaptcha_response_field:recaptcha_response_field, 
				recaptcha_challenge_field:recaptcha_challenge_field
			});
			
			php.complete = function(){
				
			}
			
			php.messages.defaultCallBack = function (msg, params){
				if(msg == false)
					Recaptcha.reload();
				else{
					$(".hide").remove();
					$('#processApplication').fadeIn();
					$("#applicationForm").submit();
					$("#createApplicationForm").submit();
				}
			}
			
		} else {
			e.returnValue = false;
			e.preventDefault();
		}
		
	});
	
	
	//this is for the recaptcha
	$("#recaptcha_submit").on("click",(function(){
		$("#quick_apply_from").submit();
	}));
});

$(window).load(function(){
	//iePlaceholder();
});

	
function togglePopUp(){
	$('span.readMore').click(function(){
		var id = $(this).data('counter');
		
		$('div#readMoreDialog_'+id).fadeIn();
	});
	
	$('span.close').click(function(){
		$('div[id*="readMoreDialog"]').fadeOut();
	});
}


function submitQuickApply(){
	$("#quick_apply_from input[name=quick_apply]").on("click",(function(e){
		e.returnValue = false;
		e.preventDefault();
		
		if (validateQuickApply()) {
			$("#recaptchaContainer").removeClass("hide")
			//$('#recaptcha').modal('show');
//			$("#quick_apply_from").submit();
		}
	}));
}


function submitApplication(){
	//-----------------------------------------------------------------------------------------------------
	$("#applicationForm, #createApplicationForm").on("submit", (function(e) {
		var formId = $(this).attr('id');
		
		if (validateForm()) {
			$(".hide").remove();
			$('#processApplication').fadeIn();
//			$('#toggleSubmitConfirmation').trigger('click');
		} else {
			e.returnValue = false;
			e.preventDefault();
		}
	}));
}

//-----------------------------------------------------------------------------------------------------
function validateForm() {
	
	return $(".application_form").validate({
		rules:{
			mobile_number:{
				number:true,
			},
			email:{
				email:true,
			},
			confirm_email:{
				email:true,
			},
		},
	}).form();
}
//-----------------------------------------------------------------------------------------------------
function validateQuickApply() {
	
	return $("#quick_apply_from").validate({
		rules:{
			phone:{
				number:true,
			},
			email:{
				email:true,
			},
		},
	}).form();
}

function updatePath(){
//-----------------------------------------------------------------------------------------------------
//photo  invalid file type
	$("#photo").change(function(){
		fake_path      = $(this).val();
		array_path     =  fake_path.split('\\');
		filename       = array_path[2];
		array_filename = filename.split(".");
		index          = array_filename.length - 1;
		ext            = array_filename[index].toLowerCase();
		
		if(ext != 'gif' && ext != 'jpeg' && ext != 'jpg' && ext != 'png' && ext != 'bmp' && ext != 'tiff')
			$("#error_photo").html("Invalid file type");
		else
			$("#error_photo").html("");
	});
}


$(window).load(function(){
	//preFill();
});

function preFill(){


	$("input[name=first_name]").val("John");
	$("input[name=middle_name]").val("Valdez");
	$("input[name=last_name]").val("Smith");
	
	$("select[name=date_of_birth_months]").val("May");
	$("select[name=date_of_birth_days]").val("27");
	$("select[name=date_of_birth_years]").val("1993");
	
	$("select[name=available_date_months]").val("Jun");
	$("select[name=available_date_days]").val("20");
	$("select[name=available_date_years]").val("2014");
	
	$("input[name=address]").val("Leyete St. Malate, Manila");
	$("input[name=mobile_number]").val("09100000444");
	$("input[name=landline_number]").val("42054654");
	
	$("input[name=email]").val("raymart.marasigan@starfi.sh");
	$("input[placeholder='Confirm Email Address*']").val("raymart.marasigan@starfi.sh");
	$("input[name=rank_applied]").val("My rank");
	$("input[name=preferred_ship_type]").val("My ship");
	$("input[name=salary_expectation]").val("$3000");
	
	$("input[name=passport_number]").val("13245789");
	$("select[name=passport_validity_months]").val("Dec");
	$("select[name=passport_validity_days]").val("10");
	$("select[name=passport_validity_years]").val("2015");
	
	$("input[name=seamans_number]").val("234234234");
	$("select[name=seamans_validity_months]").val("Feb");
	$("select[name=seamans_validity_days]").val("11");
	$("select[name=seamans_validity_years]").val("2016");
	
	$("input[name=coc_number]").val("234234234");
	$("select[name=coc_level]").val("Management");
	$("select[name=coc_validity_months]").val("Nov");
	$("select[name=coc_validity_days]").val("12");
	$("select[name=coc_validity_years]").val("2014");
	
	
	$("input[name=us_visa]").val("123423");
	$("select[name=us_visa_validity_months]").val("Jan");
	$("select[name=us_visa_validity_days]").val("11");
	$("select[name=us_visa_validity_years]").val("2016");
	
	$("textarea[name=additional_skills]").val("This is my additional skills acquired. Sample.");
}


//-----------------------------------------------------------------------------------------------------
function toggleButtons(){
	$('input[name="photo"]').change(function(){
		var img = $('#photo').val().replace(/.*(\/|\\)/, '');;
		$('#fileVal').val(img);
		$('#dummyPhoto').removeClass('photoAttach');
		$('#dummyPhoto').addClass('photoAttached');
		$('#photo_hidden').val(1);
	});
}


//-----------------------------------------------------------------------------------------------------
//imagepreview
function imagePrev(input) {
	
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        alert(e.target.result);
        reader.onload = function (e) {
            $('#thumb').css('background-image', 'url(' + e.target.result + ')');
        }

        reader.readAsDataURL(input.files[0]);
    }
}
//-----------------------------------------------------------------------------------------------------
//ie place holder
function iePlaceholder(){
	$('input, textarea').placeholder();
}
//-----------------------------------------------------------------------------------------------------
//reset Form
function resetForm(id) {
	$('#'+id).each(function(){
		this.reset();
	});
}