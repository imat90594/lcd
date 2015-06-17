<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'cvView.php';
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';
require_once 'Project/Model/Job_Manager/applicants/applicants.php';
require_once 'Project/Model/Job_Manager/applicants/applicant.php';

class cvController extends applicationsSuperController
{
	public function indexAction()
	{
		$view = new cvView();
		
		$applicants = new applicants();
		
		$applicants->selectToday();
		$view->today_applicants = $applicants->applicants;
		
		$applicants->selectThisWeek();
		$view->this_week_applicants = $applicants->applicants;
		
		$applicants->selectThisMonth();
		$view->this_month_applicants = $applicants->applicants;
		
		$applicants->selectLastMonth();
		$view->last_month_applicants = $applicants->applicants;
		
		$applicants->selectOlder();
		$view->older_applicants = $applicants->applicants;
		
		$view->displayApplicantListing();
	}
	
	public function downloadCVAction()
	{
		$applicant = new applicant();
		$applicant->applicant_id = $this->getValueOfURLParameterPair("id");
		$applicant->select();
		
		$data = json_decode($applicant->applicant_details, TRUE);
		
		$birth_date = $data["date_of_birth"];
		$age 		= $this->computeAge($birth_date);
		
		
		$attachment_name = date("Y.m.d").".".$data["rank_applied"].".".$age.".".$data["preferred_ship_type"];
		
		header("Content-Type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename="'.$attachment_name.'.xls"');
		
		readfile(STAR_SITE_ROOT.'/Data/ApplicantsForm/'.$applicant->application_form_path);
	}
	
	
	private function computeAge($birthDate)
	{
		$birthDate = date("m/d/Y", strtotime($birthDate));
		//explode the date to get month, day and year
		$birthDate = explode("/", $birthDate);
		//get age from date or birthdate
		$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
		? ((date("Y") - $birthDate[2]) - 1)
		: (date("Y") - $birthDate[2]));
		
		return $age;
	}
	
	
	public function downloadFormAction()
	{
		/* if(isset($_GET['name']))
		{
			$category_title = $_GET['name'];
			$path			= STAR_SITE_ROOT.'/Data/Application_Form/Sample_Form/GMMAI_Application_Form_';
			$formFilename   = $path.$category_title;
				
			header("Content-Type: application/vnd.ms-excel");
			
			//ob_clean();
			//flush();
			readfile($formFilename.'.xls');
		}
	 */
	}
}


