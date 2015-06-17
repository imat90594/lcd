<?php

require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
 

//----------------------------------------------------------
require_once 'Project/1_Website/Code/Applications/Careers/Modules/recaptchalib.php';
require_once "Project/1_Website/Code/Applications/Careers/Modules/userSession.php";


class careersAjaxController extends applicationsSuperController
{
	public function checkRecaptchaAction()
	{
		
		if (isset($_POST["recaptcha_response_field"])) {
			
			$resp = recaptcha_check_answer (PRIVATE_KEY,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);
		
			if ($resp->is_valid) 
			{
				userSession::saveSession(array("recaptcha_valid" => true));
				jQuery::addMessage(true);
			} 
			else 
			{
				jQuery::addMessage(false);
			}
		}
		
		jQuery::getResponse();
	}
	
}