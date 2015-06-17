<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';
require_once 'Project/1_Website/Code/Applications/Careers/Modules/pickers/dropdown_renderer.php';

class online_formView extends applicationsSuperView
{
	public $jobs;
	public $job;
	
	public $has_error;
	
	private $current_application_id;
	
	public function __construct()
	{
		$this->current_application_id = applicationsRoutes::getInstance()->getCurrentApplicationID();
	}
	
	//----------------------------------------------------------------------------------------------------------------------------------------------
	
	public function displayCareersListingTemplate()
	{
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$this->current_application_id.'/Controllers/online_form/main_online_form_template.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
		
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$this->current_application_id.'/Controllers/online_form/quick_apply.phtml');
		response::getInstance()->addContentToTree(array('QUICK_APPLY'=>$content));
		
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$this->current_application_id.'/Controllers/online_form/application_listing.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_LISTING'=>$content));
		
	}
	
	//----------------------------------------------------------------------------------------------------------------------------------------------
	
	public function displayOnlineFormTemplate()
	{
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$this->current_application_id.'/Controllers/online_form/online_form.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
	}
	
	//----------------------------------------------------------------------------------------------------------------------------------------------
	
	public function displayCreateFormTemplate()
	{
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$this->current_application_id.'/Controllers/online_form/create_online_form.phtml');
		response::getInstance()->addContentToTree(array('CONTENT_COLUMN'=>$content));
	}
	
	
	public function  shorten_string($string, $word_count)
	{
		$retval = $string;
		$string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
		$string = str_replace("\n", " ", $string);
		$array  = explode(" ", $string);
		
		if (count($array) <= $word_count)
		{
			$retval = $string;
		}
		else
		{
			array_splice($array, $word_count);
			$retval = implode(" ", $array)."...";
		}
		
		return $retval;
	}
	
}