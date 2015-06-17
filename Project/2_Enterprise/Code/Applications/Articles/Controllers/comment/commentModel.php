<?php
require_once 'Project/ApplicationsFramework/MVC_superClasses/applicationsSuperController.php';
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';
/**
 * Created by PhpStorm.
 * User: KEVIN
 * Date: 10/27/14
 * Time: 2:43 PM
 */

class commentModel  extends applicationsSuperController
{
	public $article_comment_id;
	public $article_type;
	public $author;
	public $date_created;
	public $content;

	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "SELECT
						ac.*,
						a.article_title
					FROM
						article_comments ac
					INNER JOIN
						articles a
					ON
						ac.article_id = a.article_id
					WHERE
						ac.article_type = :article_type
					ORDER BY
						ac.date_created DESC";

			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":article_type", $this->article_type);
			$pdo_statement->execute();

			return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}
	}

//------------------------------------------------------------------------------------------------------

	public function selectOne($article_comment_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "SELECT
						ac.*,
						a.article_title
					FROM
						article_comments ac
					INNER JOIN
						articles a
					ON
						ac.article_id = a.article_id
					WHERE
						ac.article_comment_id = :article_comment_id";

			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":article_comment_id", $article_comment_id);
			$pdo_statement->execute();

			return $pdo_statement->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}
	}

//------------------------------------------------------------------------------------------------------

	public function update()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "UPDATE
						article_comments
					SET
						author = :author,
						date_created = :date_created,
						content = :content
					WHERE
						article_comment_id = :article_comment_id";

			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":author", $this->author);
			$pdo_statement->bindParam(":date_created", $this->date_created);
			$pdo_statement->bindParam(":content", $this->content);
			$pdo_statement->bindParam(":article_comment_id", $this->article_comment_id);
			$pdo_statement->execute();

			return $pdo_statement->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}
	}

//------------------------------------------------------------------------------------------------------

	public function delete()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "DELETE FROM
						article_comments
					WHERE
						article_comment_id = :article_comment_id";

			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":article_comment_id", $this->article_comment_id);
			$pdo_statement->execute();
		}
		catch(PDOException $e)
		{
			$e->getMessage();
		}
	}
} 