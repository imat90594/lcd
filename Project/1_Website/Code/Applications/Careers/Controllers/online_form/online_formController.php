<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'online_formView.php';
require_once 'online_formModel.php';
require_once 'Project/Model/Job_Manager/jobs.php';
require_once 'Project/Model/Job_Manager/job.php';
require_once 'Project/Model/Job_Manager/applicants/applicant.php';
require_once 'Project/1_Website/Code/Applications/Careers/Modules/exceler.php';
require_once 'Project/1_Website/Code/Modules/mailer.php';
require_once 'Project/Model/Settings/settings.php';
require_once 'Project/1_Website/Code/Applications/Careers/Modules/recaptchalib.php';
require_once "Project/1_Website/Code/Applications/Careers/Modules/userSession.php";

class online_formController extends applicationsSuperController
{
	public function indexAction()
	{
		if(isset($_POST["recaptcha_response_field"]))
		{
			$has_error = $this->quickApply();
		}
		else
			$has_error = false;
		
		
		//select all jobs
		$jobs = new jobs();
		$jobs->select(true);
	
		$view = new online_formView();
		$model = new online_formModel();
		
		$view->_XMLObj = $model->loadDataSimpleXML("data");
		
		metaData::getInstance()->meta_title       = $view->displayElement("page_title_element");
		metaData::getInstance()->meta_description = $view->displayElement("meta_description");
		
		$view->has_error = $has_error;
		$view->jobs = $jobs->array_of_jobs;
		$view->displayCareersListingTemplate();
	}
	
	public function sendAction()
	{
		if(userSession::getSession("recaptcha_valid") == true)
		{
			$model = new online_formModel();
			$dates = array("date_of_birth",
						   "available_date",
						   "coc_validity",
						   "passport_validity",
						   "seamans_validity",
						   "us_visa_validity");
			
			//combine the dates
			$data = $model->buildDates($dates, $_POST);
			
			//file name of the excel to be saved
			$filename = uniqid().".xls";
			$path 	  = STAR_SITE_ROOT."/Data/ApplicantsForm/".$filename;
			
			//create and save the application form
			$exceler = new exceler;
			$exceler->data = $data;
			$exceler->fillExcelTemplate();
			$exceler->fillSeaService($data["service"]);
			
			//fill the photo if exist
			if($_FILES["photo"]["tmp_name"] != "")
			$exceler->fillPhoto($_FILES["photo"]["tmp_name"]);
			
			$exceler->saveApplicationForm($path);
				
			//save info to database
			$applicant = new applicant();
			$applicant->applicant_details 	  = json_encode($data);
			$applicant->application_form_path = $filename;
			$applicant->insert();
			
			//clean the name for securtiy in the email
			$first_name   = strtoupper(preg_replace("/[^-sA-Za-z0-9_]/", "",   $_POST["first_name"]));
			$last_name    = strtoupper(preg_replace("/[^-sA-Za-z0-9_]/", "",   $_POST["last_name"]));
			$middle_name  = strtoupper(preg_replace("/[^-sA-Za-z0-9_]/", "",   $_POST["middle_name"]));
			$ship_type    = strtoupper(preg_replace("/[^-sA-Za-z0-9_]/", "",   $_POST["preferred_ship_type"]));
			$rank_applied = strtoupper(preg_replace("/[^-sA-Za-z0-9_]/", "",   $_POST["rank_applied"]));
			
			//send email
			//$subject		 =  date("Y.m.d").".".$rank_applied.".".$this->computeAge($data["date_of_birth"]).".".$ship_type;
			$subject		 =  $rank_applied.".".$this->computeAge($data["date_of_birth"]).".".$ship_type;
			
			$attachment_name =  date("Y.m.d").".".$rank_applied.".".$this->computeAge($data["date_of_birth"]).".".$ship_type;
			
			$from = array(
						"name" =>  "Avior Marine Website - Job Applicant",
						"email" => "mailer@aviormarine.com"
			);
			
			$attachments[] = array("path" => $path, "filename" => $attachment_name.".xls");
			
			$job = new job();
			$job->job_id = $_POST["job_id"];
			$job->select();
			
			if($job->email_receiver != "")
			{
				$email_receiver = explode(",", $job->email_receiver);
				foreach($email_receiver as $email)
				$to[] = array("email" => $email);
			}
			else
				$to = NULL;
			
			//send the email
			mailer::send_with_phpmailer($from, $subject, $model->buildEmailTemplate($data), $to, $attachments);
			mailer::send_with_phpmailer($from, "Avior Marine", "Thank you for your application to Avior Marine Inc. Please find attached your application form as submitted", array(array("email" => $_POST["email"])), $attachments);
			
			userSession::updateSession("recaptcha_valid", false);
			header("Location: /careers?success=1");
		}
	}
	
	//------------------------------------------------------------------------------------------
	
	private function quickApply()
	{
		if(isset($_POST["recaptcha_response_field"]))
		{
			$resp = recaptcha_check_answer(PRIVATE_KEY,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);
			$error = '';
			
			if($resp->is_valid)
			{
				$body = "
								Name : {$_POST["full_name"]} <br />
								Rank : {$_POST["rank"]} <br />
								Date of Birth : {$_POST["date_of_birth_days"]}-{$_POST["date_of_birth_months"]}-{$_POST["date_of_birth_years"]} <br />
								Phone : {$_POST["phone"]} <br />
								Email : {$_POST["email"]} <br />
								Vessel Type : {$_POST["vessel_type"]} <br /> <br />
								Comment : {$_POST["comment"]}
							";
					
				$from = array(
						"name" =>  $_POST["full_name"],
						"email" => $_POST["email"]
				);
				
				//get the age
				$month = date_parse($_POST["date_of_birth_months"]);
				$birthday = new DateTime($_POST["date_of_birth_years"]."/".$month["month"]."/".$_POST["date_of_birth_days"]);
				$current_date = new DateTime(date("Y/m/d"));
				$interval = $birthday->diff($current_date);
				$age = $interval->y;
				
				$subject = "{$_POST["rank"]}.{$age}.{$_POST["vessel_type"]}";
				
				mailer::send_with_phpmailer($from, $subject, $body);
					
				header("Location: /careers?success=1");
			}
			else
			{
				return true;
			}
		}
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
	
	
	//------------------------------------------------------------------------------------------
	
	public function create_applicationAction()
	{
		$model = new online_formModel();
		$view = new online_formView();
		$view->_XMLObj = $model->loadDataSimpleXML("data");
		$view->displayCreateFormTemplate();
	}
	
	//------------------------------------------------------------------------------------------
	
	public function applyAction()
	{
				
		$job_permalink = $this->getValueOfURLParameterPair("apply");
		
		
		if($job_permalink == "")
		{
			$view = new online_formView();
			$view->displayOnlineFormTemplate();
		}
		else
		{
			$job_obj = new job();
			$job     = $job_obj->checkPermalink($job_permalink);
			
			//check if the permalink is existing
			if($job)
			{
				//set metadata for seo
				metaData::getInstance()->meta_title       = $job["job_title"];
				metaData::getInstance()->meta_description = $job["job_metadata"];
				
				$model = new online_formModel();
				$view = new online_formView();
				$view->job = $job;				
				$view->_XMLObj = $model->loadDataSimpleXML("data");
				$view->displayOnlineFormTemplate();
			}
			else 
				header("Location: /careers");
			
		}
	
	}
	
	
	
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