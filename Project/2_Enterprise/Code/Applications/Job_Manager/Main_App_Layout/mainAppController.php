<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once('mainAppModel.php');
require_once('mainAppView.php');
require_once 'Project/Model/Job_Manager/jobs.php';

class mainAppController extends controllerSuperClass_Core
{
	public function getMainLayout()
	{	
		$mainAppView = new mainAppView();
		
		//get all jobs to be displayed in side navigation
		$jobs = new jobs();
		$jobs->select();
		
		$mainAppView->jobs = $jobs->array_of_jobs;

		$mainAppView->displayMainApplicationLayout();
		$mainAppView->displayJobsNavigation();
		$mainAppView->displayPopupDialog();
	}
}

?>