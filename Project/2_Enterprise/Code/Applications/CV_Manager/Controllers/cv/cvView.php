<?php

require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';


class cvView extends applicationsSuperView
{
	public $today_applicants;
	public $this_week_applicants;
	public $last_month_applicants;
	public $older_applicants;
	public $this_month_applicants;
//---------------------------------------------------------------------------------------------------------
	public function displayApplicantListing()
	{
		$content = $content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/CV_Manager/Controllers/templates/cv/applicant_listing.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_CONTENT'=>$content));
	}
}
?>