<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperView.php';
/**
 * Created by PhpStorm.
 * User: KEVIN
 * Date: 10/27/14
 * Time: 2:50 PM
 */

class commentView  extends applicationsSuperView
{
	public $comment_details;
	public $array_of_comments;
	public $total_comments;
	public $pagination;

//-------------------------------------------------------------------------------------------------

	public function displayCommentListingTemplate()
	{
		$content = $this->renderTemplate('Project/2_Enterprise/Design/Applications/Articles/Controllers/comment/comment_listing.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_CONTENT'=>$content));
	}

//-------------------------------------------------------------------------------------------------

	public function displayCommentDetailsTemplate()
	{
		$content = $this->renderTemplate('Project/2_Enterprise/Design/Applications/Articles/Controllers/comment/comment_details.phtml');
		response::getInstance()->addContentToTree(array('APPLICATION_CONTENT'=>$content));
	}

//-------------------------------------------------------------------------------------------------

	public function  shorten_string($string, $word_count)
	{
		$retval = $string;
		$string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
		$string = str_replace("\n", " ", $string);
		$array  = explode(" ", $string);

		if (count($array) <= $word_count)
		{
			$retval = $string;
		}
		else
		{
			array_splice($array, $word_count);
			$retval = implode(" ", $array)." ...";
		}

		return $retval;
	}
} 