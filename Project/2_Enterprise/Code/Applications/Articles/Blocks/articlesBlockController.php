<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'articlesBlockView.php';
require_once 'articlesBlockModel.php';

class articlesBlockController extends applicationsSuperController
{
	public function renderArticleListingTemplate($articles, $pagination = NULL, $total_articles = NULL)
	{
		$view 			= new articlesBlockView();
		$view->articles = $articles;
		$view->pagination = $pagination;
		$view->total_articles = $total_articles;

		$article_categories = new article_categories();
		$article_categories->select(routes::getInstance()->getCurrentTopLevelURLName());
		$view->categories = $article_categories->categories;

		return $view->renderArticleListingTemplate();
	}
	
	//------------------------------------------------------------------------------------------------------------
	
	public function renderSideCategoryTemplate()
	{
		$model = new articlesBlockModel();
		$categories = $model->selectArticleCategories();

		$view = new articlesBlockView();
		$view->categories = $categories;
		
		return $view->renderArticleCategoryTemplate();
	}
	
	//------------------------------------------------------------------------------------------------------------

	public function renderArticleListingByCategory($articles)
	{
		$view 			= new articlesBlockView();
		$view->articles = $articles;
		
		return $view->renderArticleListingTemplate();
	}
}