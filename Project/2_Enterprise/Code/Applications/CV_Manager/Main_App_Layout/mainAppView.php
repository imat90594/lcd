<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');

class mainAppView extends viewSuperClass_Core
{	
	public $active_nav;
//-------------------------------------------------------------------------------------------------	

// 	public function displayMainApplicationLayout()
// 	{
// 		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/_Common/templates/js_and_css_links.phtml');
// 		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('COMMON_CS_JS'=>$content));
		
// 		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/CV_Manager/Main_App_Layout/templates/js_and_css_links.phtml');
// 		response::getInstance()->addContentToStack('css_and_javascript_links_for_this_page_only',array('JOBS_CS_JS'=>$content));
		
// 		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/CV_Manager/Main_App_Layout/templates/inpage_javascript.js');
// 		response::getInstance()->addContentToStack('inpage_javascript_bottom',array('CURRENT SECTION CSS'=>$content));
		
// 		$content = $this->renderTemplate('Project/Design/'.DOMAIN.'/Applications/CV_Manager/Main_App_Layout/templates/main_app_layout.phtml');
// 		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
// 	}
	
	public function displayMainApplicationLayout()
	{
		$currentApplicationID = applicationsRoutes::getInstance()->getCurrentApplicationID();
	
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$currentApplicationID.'/Main_App_Layout/templates/inpage_javascript.js');
		response::getInstance()->addContentToStack('local_javascript_bottom',array('IMAT_JS'=>$content));
	
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$currentApplicationID.'/Main_App_Layout/templates/js_and_css_links.phtml');
		response::getInstance()->addContentToStack('local_css',array('ATICLE_JS_CSS'=>$content));
	
		//$content = $this->renderTemplate('Project/2_Enterprise/Design/Applications/'.$currentApplicationID.'/Main_App_Layout/templates/side_navigation.phtml');
		//response::getInstance()->addContentToTree(array('APPLICATION_LEFT_COLUMN'=>$content));
	
		$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$currentApplicationID.'/Main_App_Layout/templates/main_app_layout.phtml');
		response::getInstance()->addContentToTree(array('MAIN_CONTENT'=>$content));
	
		//$content = $this->renderTemplate('Project/'.DOMAIN.'/Design/Applications/'.$currentApplicationID.'/Main_App_Layout/templates/popup_dialog.phtml');
		//response::getInstance()->addContentToTree(array('POPUP_DIALOGS'=>$content));
	}
	
	
//-------------------------------------------------------------------------------------------------	

}
?>