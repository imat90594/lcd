<?php
require_once(FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/viewSuperClass_Core/viewSuperClass_Core.php');require_once('footerModel.php');require_once('footerView.php');
class footerController extends controllerSuperClass_Core{	public function getFooter()	{		$view = new footerView();		$model = new footerModel();				$albums = $model->getAlbumsWithImagePreview(true);		$view->albums = $albums;		$view->getFooter();	}}
?>