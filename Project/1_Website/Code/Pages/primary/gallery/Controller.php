<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');

class controller extends controllerSuperClass_Core
{
	public function indexAction()
	{	
		$view = new view();
		$model = new model();

		$albums = $model->getAlbumsWithImagePreview(true);
		$view->albums = $albums;
		//dumpData($albums);
		$fist_album = array_keys($albums);
		
		if(isset($fist_album[0]))
		{
			$images = $model->getImages($fist_album[0]);
			$view->images = $images;
		}
		
		$view->_XMLObj = $model->loadDataSimpleXML("data");
		$view->renderAll();
	}
	
	public function viewAction()
	{
		if(isset($_GET["album_id"]))
		{
			$model = new model();
			$images = $model->getImages($_GET["album_id"]);
				
			$view = new view();

			$albums = $model->getAlbumsWithImagePreview(true);
			$view->albums = $albums;
			$view->images = $images;
			$view->_XMLObj = $model->loadDataSimpleXML("data");
			$view->renderAll();
			$view->displayMainTemplate();
		}
		else
		header("Location: /404");
	}
}
?>