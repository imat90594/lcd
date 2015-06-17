<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once 'Project/2_Enterprise/Code/Modules/pagination/pagination.php';
require_once 'commentModel.php';
require_once 'commentView.php';
/**
 * Created by PhpStorm.
 * User: KEVIN
 * Date: 10/27/14
 * Time: 2:42 PM
 */

class commentController  extends applicationsSuperController
{
	public function indexAction()
	{
		//for pagination
		if(isset($_GET["page"]))
			$page = (int)$_GET["page"];
		else
			$page = 1;

		//paginate
		$pagination = new pagination();
		$pagination->limit = 30;
		$pagination->current_page = $page;

		$commentModel = new commentModel();
		$commentView = new commentView();

		$commentModel->article_type = routes::getInstance()->getCurrentPageId();
		$array_of_comments = $commentModel->select();
		$commentView->total_comments = count($array_of_comments);

		$pagination->paginateData($array_of_comments);
		$commentView->pagination = $pagination->pagination;
		$commentView->array_of_comments = $pagination->result;
		$commentView->displayCommentListingTemplate();
	}

//------------------------------------------------------------------------------------------------------------

	public function viewAction()
	{
		$article_comment_id = $this->getValueOfURLParameterPair("view");

		$commentModel = new commentModel();
		$comment_details = $commentModel->selectOne($article_comment_id);

		//check if article is realy existing
		if(isset($comment_details["article_comment_id"]))
		{
			$commentView = new commentView();
			$commentView->comment_details = $comment_details;
			$commentView->displayCommentDetailsTemplate();
		}
		else
			header("Location: /404");
	}

	//------------------------------------------------------------------------------------------------------------

	public function updateAction()
	{
		if(isset($_POST["article_comment_id"]))
		{
			$commentModel = new commentModel();
			$commentModel->article_comment_id = $_POST['article_comment_id'];
			$commentModel->date_created = strtotime($_POST["date_created"]);
			$commentModel->author = trim(strip_tags($_POST['author']));
			$commentModel->content = trim(strip_tags($_POST['content']));
			$commentModel->update();

			$url = routes::getInstance()->getCurrentTopLevelURLName()."/comment/view/".$commentModel->article_comment_id;
			header("Location: /$url");
		}
		else
			header("Location: /404");
	}

//------------------------------------------------------------------------------------------------------------

	public function deleteAction()
	{
		if(isset($_POST["article_comment_id"]))
		{
			$commentModel = new commentModel();
			$commentModel->article_comment_id = $_POST['article_comment_id'];
			$commentModel->delete();

			$url = routes::getInstance()->getCurrentTopLevelURLName()."/comment";
			header("Location: /$url");
		}
		else
			header("Location: /404");
	}
} 