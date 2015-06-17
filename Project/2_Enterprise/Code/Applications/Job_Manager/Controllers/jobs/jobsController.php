<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'jobsView.php';
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';
require_once 'Project/Model/Job_Manager/jobs.php';
require_once 'Project/Model/Job_Manager/job.php';

class jobsController extends applicationsSuperController
{
	public function indexAction()
	{
		$jobs_view = new jobsView();
		$job 	   = new job();

		//get the first job_id
		$job->selectFirst();

		if($job->job_id != NULL)
		{
			header("location: /".routes::getInstance()->getCurrentTopLevelURLName()."/jobs/view/".$job->job_id);
		}
		//if there is no fetched job, display editor instead "NO JOB TO DISPLAY"
		else
		{
			$jobs_view->job = NULL;
			$jobs_view->displayJobsEditor();
		}
	}

	//-------------------------------------------------------------------------------------------------

	public function viewAction()
	{
		$jobs_view = new jobsView();
		$job	   = new job();

		//get the job id
		$job->job_id = $this->getValueOfURLParameterPair("view");
		$job->select();

		if($job->job_id == NULL)
		{
			//if the job id not exists, go to the index action instead
			header("location: /".routes::getInstance()->getCurrentTopLevelURLName());
		}
		else
		{
			$jobs_view->job = $job;
			$jobs_view->displayJobsEditor();
			$this->editAction();
		}
	}

	//-------------------------------------------------------------------------------------------------

	public function addAction()
	{
		if(isset($_POST['job_title']))
		{
			$job = new job();
				
			$job->job_title    		 = $_POST['job_title'];
			$job->job_description    = NULL;
			$job->job_permalink    	 = $this->createPermalink($_POST['job_title']);
			$job->date_created       = strtotime(date("Y-m-d h:i:s"));
			$job->is_published 		 = false;
			$job->email_receiver     = "";
			$job->insert();
				
			$job->updateOneColumn("priority_number", $job->job_id);
				
			header("location: /".routes::getInstance()->getCurrentTopLevelURLName()."/jobs/view/".$job->job_id);
		}

	}

	//-------------------------------------------------------------------------------------------------

	public function editAction()
	{
		if(isset($_POST['edit_job']))
		{
			$job = new job();
			$job->job_id = $_POST["job_id"];
			$job->select();
				
			//get the job id, if no value fetched, set to null
			$job->job_title    	  = $_POST['job_title'];
			$job->job_description = stripslashes($_POST['job_description']);
			$job->is_published    = $_POST['is_published'];
			$job->email_receiver  = $_POST["email_receiver"];
			$job->job_metadata  = $_POST["job_metadata"];
			$job->job_permalink   = $this->createPermalink($_POST['job_permalink']);
				
			$job->update();
				
			header("location: /".routes::getInstance()->getCurrentTopLevelURLName()."/jobs/view/".$_POST["job_id"]);
		}
	}

	//-------------------------------------------------------------------------------------------------


	public function deleteAction()
	{
		if(isset($_POST['job_id']))
		{
			$job = new job();
			$job->job_id = $_POST['job_id'];
			$job->delete();
				
			header("location: /".routes::getInstance()->getCurrentTopLevelURLName());
		}
	}


	//-------------------------------------------------------------------------------------------------

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

