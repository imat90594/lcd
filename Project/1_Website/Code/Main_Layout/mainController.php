<?phprequire_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';require_once('mainModel.php');require_once('mainView.php');class mainController extends controllerSuperClass_Core{	public function getMainLayout()	{		//we should teach new devs to only require classes that are needed		//authorization shouldn't be here				require_once 'Project/Model/Settings/settings.php';		$analytics = new settings();		$analytics->selectGoogleAnalytics();				//now, i don't know why these two placed in view. it's better to place these here		//view should be only for rendering functions		$this->getHeader();		$this->getFooter();		$mainView = new mainView();  		$mainView->setGoogleAnalytics($analytics->__get('google_analytics'));				$mainView->getMainLayout();			}		private function getHeader()	{		$model = new mainModel();		$lcd = $model->loadDataSimpleXML("Data/1_Website/Content/Pages/primary/les_clefs_dor/data", null, null, true);				$data = array(		"lcd" => $lcd		);				require_once 'Project/'.DOMAIN.'/Code/Panels/header/headerController.php';		$headerView = new headerController();		$headerView->data = $data; 		$headerView->getHeader();	}	private function getFooter()	{		require_once 'Project/'.DOMAIN.'/Code/Panels/footer/footerController.php';		$footerController = new footerController();		$footerController->getFooter();					}}?>