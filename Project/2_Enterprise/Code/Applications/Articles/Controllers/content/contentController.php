<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'contentView.php';
require_once 'contentModel.php';
require_once 'Project/Model/Articles/articles/articles_query_helper.php';
require_once 'Project/Model/Articles/article_categories/article_categories.php';
require_once 'Project/2_Enterprise/Code/Modules/pagination/pagination.php';
require_once 'Project/Model/Articles/articles/article.php';
require_once 'Project/Model/Routes/route.php';

class contentController extends applicationsSuperController
{
	public function indexAction()
	{
		$view = new contentView();

		//for pagination
		if(isset($_GET["page"]))
			$page = $_GET["page"];
		else
			$page = 1;

		//paginate
		$pagination = new pagination();
		$pagination->limit = 10;
		$pagination->current_page = $page;

		if(count($_GET) > 0)
		{
			$article = new article();

			$article->article_type = routes::getInstance()->getCurrentTopLevelURLName();
			foreach($_GET as $column=>$value)
				$article->__set($column, $value);

			$array_of_articles = $article->searchArticles();
			$view->total_articles = count($array_of_articles);

			$pagination->paginateData($array_of_articles);

			$view->pagination = $pagination->pagination;
			$view->articles = $pagination->result;
		}
		else
		{
			$query_helper = new articles_query_helper();
			$query_helper->article_type = routes::getInstance()->getCurrentTopLevelURLName();

			$array_of_articles = $query_helper->selectAllArticles();;
			$view->total_articles = count($array_of_articles);
			$pagination->paginateData($array_of_articles);

			$view->pagination = $pagination->pagination;
			$view->articles = $pagination->result;
		}

		$view->displayArticleListingTemplate();
	}

	//------------------------------------------------------------------------------------------------------------

	public function viewAction()
	{
		$article_id = $this->getValueOfURLParameterPair("view");

		//select article details
		$article = articles_query_helper::selectByColumn("article_id", $article_id);

		//check if article is realy existing
		if(isset($article["article_id"]))
		{
			$view = new contentView();
				
			//select article categories for displaying in dropdowns
			$article_categories = new article_categories();
			$article_categories->select(routes::getInstance()->getCurrentTopLevelURLName());
			$view->article_categories = $article_categories->categories;
				
			$view->article = $article;
			$view->displayArticleDetailsTemplate();
		}
		else
			header("Location: /404");
	}

	//------------------------------------------------------------------------------------------------------------

	public function updateAction()
	{
		if(isset($_POST["article_id"]))
		{
			$article = new article();
			$article->article_id = $_POST["article_id"];
			$article->select();

			//udpate article
			$article->article_category_id = isset($_POST["article_category_id"]) ? $_POST["article_category_id"] : "";
			$article->author 			  = isset($_POST["author"]) ? $_POST["author"] : "";
			$article->article_title 	  = isset($_POST["article_title"]) ? $_POST["article_title"] : "";
			$article->article_type 	  	  = routes::getInstance()->getCurrentTopLevelURLName();
			$article->date_created  	  = isset($_POST["date_created"]) ? strtotime($_POST["date_created"]) : "";
			$article->is_publish    	  = $_POST["is_publish"];
			$article->image_id			  = isset($_POST["image_id"]) ? $_POST["image_id"] : "";
			$article->content			  = isset($_POST["content"]) ? $_POST["content"] : "";
			$article->metadata			  = isset($_POST["metadata"]) ? $_POST["metadata"] : "";
			$article->position			  = isset($_POST["position"]) ? $_POST["position"] : "";
			$article->hotel_image_id	  = isset($_POST["hotel_image_id"]) ? $_POST["hotel_image_id"] : "";
			$article->hotel_name	  	  = isset($_POST["hotel_name"]) ? $_POST["hotel_name"] : "";
			$article->hotel_description	  = isset($_POST["hotel_description"]) ? $_POST["hotel_description"] : "";
			$article->update();
				
			//update permalink
			if($_POST["current_permalink"] != $_POST["permalink"])
			{
				$route 	   = new route();
				$permalink = $this->createPermalink($_POST["permalink"]);
				$route->ifPermalinkExists($permalink, $_POST["route_id"]);

				if(!$route->getPermalink())
				{
					$route->setPermalink($permalink);
					$route->setRouteId($_POST["route_id"]);
					$route->update();
				}
			}
			$url = routes::getInstance()->getCurrentTopLevelURLName()."/content/view/".$article->article_id;
			header("Location: /$url");
		}
	}

	//------------------------------------------------------------------------------------------------------------

	public function deleteAction()
	{
		if(isset($_POST["article_id"]))
		{
			$article = new article();
			$article->article_id = $_POST["article_id"];
			$article->delete();
			
			$route = new route();
			$route->setRouteId($_POST["route_id"]);
			$route->delete();
			
			
			header("Location: /".routes::getInstance()->getCurrentTopLevelURLName());
		}
	}
	
	//------------------------------------------------------------------------------------------------------------

	public function addAction()
	{
		if(isset($_POST["article_title"]))
		{
			
			$route = new route();
			$route->setPermalink($this->createPermalink($_POST["article_title"])); 
			$route->setPageId(routes::getInstance()->getCurrentTopLevelURLName());
			$route->insert();
			
			if($route->getRouteId())
			{
				$article = new article();
				$article->article_title 	  = $_POST["article_title"];
				$article->article_type 	  	  = routes::getInstance()->getCurrentTopLevelURLName();
				$article->route_id 			  = $route->getRouteId();
				$article->article_category_id = 0;
				$article->is_publish 		  = 0;
				$article->date_created 		  = strtotime(date("Y-m-d H:i"));
				$article->insert();
				
				header("Location: /".routes::getInstance()->getCurrentTopLevelURLName()."/content/view/".$article->article_id);
			}
			else
				header("Location: /".routes::getInstance()->getCurrentTopLevelURLName());
		}
	}

	//------------------------------------------------------------------------------------------------------------

	
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
	
	//------------------------------------------------------------------------------------------------------------
}