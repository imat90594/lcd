<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/controllerSuperClass_Core/controllerSuperClass_Core.php';
require_once('Model.php');
require_once('View.php');
require_once "Project/Model/Articles/articles/articles_query_helper.php";
require_once 'Project/1_Website/Code/Pages/primary/news/Model.php';
require_once('Project/1_Website/Code/Modules/pagination/pagination.php');

class controller extends controllerSuperClass_Core
{
	public function indexAction()
	{
		$view 	 	  = new view();
		$pagination   = new pagination;
		$query_helper = new articles_query_helper();
			
		//for pagination  = 1
		if(isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;
			
		$query_helper->is_published = 1;
		$query_helper->article_type = "news";
		$query_helper->limit = 6;
		$query_helper->order_by     = "date_created DESC";
			
		$array_of_articles = $query_helper->selectAllArticles();
			
		//paginate
		$pagination->limit 		  = 10;
		$pagination->current_page = $page;
		$pagination->paginateData($array_of_articles);
			
		$view->articles	  = $pagination->result;
		$view->pagination = $pagination->pagination;
		$model = new model();
		$view->_XMLObj = $model->loadDataSimpleXML("data");
		//get the archive
		$view->archive  = $model->selectArchive("news");
		$view->displayMainTemplate();
		
	}
	
	public function viewAction()
	{
		$url=strtok($_SERVER["REQUEST_URI"],'?');
		$url = explode("/", $url);
		
		//display inner content of news
		$permalink = $url[3];
		
		if($permalink)
		{
			$view = new view();
			$model = new model();
			$articles_query_helper = new articles_query_helper();
			$view->article = $articles_query_helper->selectByColumn("r.permalink", $permalink);
			
			//get the next and previous articles
			
			//$previous 	= $model->selectPrev($view->article["date_created"], "news", $view->article["route_id"]);
			//$next 		= $model->selectNext($view->article["date_created"], "news", $view->article["route_id"]);
			
			$model = new model();
			$view->_XMLObj = $model->loadDataSimpleXML("data");
			//$view->previous = $previous["permalink"];
			//$view->next 	= $next["permalink"];
			$view->displayNewsTemplate();
		}
		else
		{
			header("Location: /404");
		}
	}
	
	public function allAction()
	{
		/* 
		 * display all articles
		 * @permalink value = news or events 
		 * 
		 * */
		
		$permalink = "news";
	
		if($permalink)
		{
			if(strpos($permalink, "?"))
			{
				$permalink = explode("?", $permalink);
				$permalink = $permalink[0];
			}
				
			$view 	 	  = new view();
			$pagination   = new pagination;
			$query_helper = new articles_query_helper();
			
			//for pagination  = 1
			if(isset($_GET["page"]))
				$page = $_GET["page"];
			else
				$page = 1;
			
			$query_helper->is_published = 1;
			$query_helper->article_type = $permalink;
			$query_helper->order_by     = "date_created DESC";
			
			$array_of_articles = $query_helper->selectAllArticles();
			
			//paginate
			$pagination->limit 		  = 10;
			$pagination->current_page = $page;
			$pagination->paginateData($array_of_articles);
			
			$view->articles	  = $pagination->result;
			$view->pagination = $pagination->pagination;
			$model = new model();
			$view->_XMLObj = $model->loadDataSimpleXML("data");
			//get the archive
			$view->archive  = $model->selectArchive($permalink); 
			$view->displayListingTemplate($permalink);
		}
		else
		{
			header("Location: /404");
		}
	}
	
	public function archiveAction()
	{
		$url = explode("/", $_SERVER["REQUEST_URI"]);
		
		$type 	= $this->getValueOfURLParameterPair("archive");
		$year 	= $url[4];
		$month 	= $url[5];
		
		$month = date_parse($month);
		
		$view = new view();
		$model = new model();
		
		$view->archive  = $model->selectArchive($type);
		
		
		$model = new model();
		$view->_XMLObj = $model->loadDataSimpleXML("data");
		
		//filter archive by year and month selected
		$array_of_articles = $this->selectArchiveContent($year,$month["month"],$type);
		
		//for pagination  = 1
		if(isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;
		
		$pagination = new pagination();
		//paginate
		$pagination->limit 		  = 5;
		$pagination->current_page = $page;
		$pagination->paginateData($array_of_articles);
			
		$view->articles	  = $pagination->result;
		$view->pagination = $pagination->pagination;
		
		$view->displayListingTemplate($type);
	}
	
	
	private function selectArchiveContent($year,$month,$type)
	{
		$start_date = strtotime($year."-".$month."-"."01");
		
		if($month == "February")
		{
			$end_date = strtotime($year."-".$month."-"."28");
		}
		else
		{
			$end_date = strtotime($year."-".$month."-"."31");
		}

		$model = new model();
		return $model->selectArchiveByDate($start_date, $end_date,$type);
	}
}
?>