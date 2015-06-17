<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';

class jobsView extends applicationsSuperView
{
	public $job;

//---------------------------------------------------------------------------------------------------------
	public function displayJobsEditor()
	{
		$content = $content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/Job_Manager/Controllers/templates/jobs/jobs_editor.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_CONTENT'=>$content));
	}
}
?>