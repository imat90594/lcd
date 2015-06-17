<?php

require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/Model/Job_Manager/job.php';
require_once 'Project/2_Enterprise/Code/Applications/Job_Manager/Controllers/jobs/jobsModel.php';

class job_managerAjaxController extends applicationsSuperController
{
	public function checkJobPermalinkAction()
	{
		$job = new job();
		$is_exist = $job->checkPermalink($this->createPermalink($_POST["job_title"]));
		
		if($is_exist)
		{
			jQuery("#error")->html("Permalink already exist");
		}
		else
		{
			jQuery("form[name=add_job_form]")->submit();
		}
		
		jQuery::getResponse();
	}
	
	//---------------------------------------------------------------------------------------
	
	public function updateJobPriorityAction()
	{
		$items = $_POST["items"];
		
		if($items)
		{
			$jobsModel = new jobsModel();
			$jobsModel->udpateJobPriority($items);
		}
	
		jQuery::getResponse();
	}
	
	//---------------------------------------------------------------------------------------
	
	private function createPermalink($permalink)
	{
		//remove the extra spaces
		$permalink = preg_replace('/\s\s+/', ' ', $permalink);

		//old way
		$characters = array(' ','_',',','\'','.',':',';','?','!', '/');
		$string = strtolower(str_replace($characters, '-', $permalink));
		
		//remove all special characters
		$string = preg_replace("/[^-sA-Za-z0-9_]/", "", $string);
		
				//remove extra dashed dashed
		$string = preg_replace('/\-\-+/', '-', $string);
		
		return trim($string, '-');
	}
		
	
}