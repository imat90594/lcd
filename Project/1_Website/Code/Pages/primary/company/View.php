<?phprequire_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php';class view extends viewSuperClass_Core{	public $page_id;		public $template_location;		public function __construct()	{				$this->template_location = "Project/".DOMAIN."/Design/Pages/primary/company/templates/";	}		public function displayMainTemplate()	{		if($this->page_id == "data")			$this->page_id = "welcome_to_our_website";				$content = $this->renderTemplate($this->template_location.$this->page_id.".phtml");		response::getInstance()->addContentToTree(array("MAIN_CONTENT" => $content));				$content = $this->renderTemplate($this->template_location."side_nav.phtml");		response::getInstance()->addContentToTree(array("SIDE_NAV" => $content));			$content = $this->renderTemplate($this->template_location."inpage_javascript.js");		response::getInstance()->addContentToStack("local_javascript_bottom", array("" => $content) );			$content = $this->renderTemplate($this->template_location."css_links.phtml");		response::getInstance()->addContentToStack("local_css", array("" => $content) );	}		
}?>