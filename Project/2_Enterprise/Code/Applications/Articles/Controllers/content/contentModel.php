<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';

class contentModel extends applicationsSuperController
{
	public $article_title = "";
	public $article_category_id = "";
	public $is_publish = "";
}