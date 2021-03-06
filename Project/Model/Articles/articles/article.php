<?php
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';

class article
{
    public $article_id;
    public $route_id;
    public $article_category_id;
    public $article_title;
    public $content;
    public $author;
    public $is_publish;
    public $date_created;
    public $date_modified;
    public $metadata;
    public $downloadables_path;
    public $image_id;
    public $article_type;
    public $hotel_image_id;
    public $hotel_description;
    public $hotel_name;
    public $position;

//================================================================================================//

	public function __get($field)
	{
		if(property_exists($this, $field)) return $this->{$field};
		else return NULL;
	}

//================================================================================================//

	public function __set($field, $value)
	{
		if(property_exists($this, $field)) $this->{$field} = $value;
	}

//================================================================================================//

	public function searchArticles()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();

			$sql = "SELECT
						a.*,
						r.*,
						ac.*
					FROM
						articles a
					INNER JOIN
						route r
					ON
						a.route_id = r.route_id
					LEFT JOIN
						article_categories ac
					ON
						a.article_category_id = ac.article_category_id
					WHERE
						1=1 ";

			foreach($this as $column=>&$value)
			{
				if($value != "" OR $value != NULL)
				{
					if($column == 'article_title')
						$sql .= " AND ".$column." LIKE CONCAT('%',:".$column.",'%')";
					elseif($column == 'article_category_id')
						$sql .= " AND ac.".$column." = :".$column;
					else
						$sql .= " AND ".$column." = :".$column;
				}
			}

			$pdo_statement = $pdo_connection->prepare($sql);

			foreach($this as $column=>&$value)
			{
				if($value != '' OR $value != NULL)
					$pdo_statement->bindParam(":$column", $value);;
			}

			$pdo_statement->execute();
			return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}

    //---------------------------------------------------------------------------------------------------------------------

    public function insert()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "INSERT INTO
                        articles
                        (
                            route_id,
                            article_category_id,
                            article_title,
                            is_publish,
                            article_type,
                            date_created
                        )
                    VALUES
                        (
                            :route_id,
                            :article_category_id,
                            :article_title,
                            :is_publish,
                            :article_type,
                            :date_created
                        )";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":route_id", 			  $this->route_id,			  PDO::PARAM_INT);
            $pdo_statement->bindParam(":article_category_id", $this->article_category_id, PDO::PARAM_INT);
            $pdo_statement->bindParam(":article_title", 	  $this->article_title, 	  PDO::PARAM_STR);
            $pdo_statement->bindParam(":is_publish", 		  $this->is_publish, 		  PDO::PARAM_INT);
            $pdo_statement->bindParam(":article_type", 		  $this->article_type, 		  PDO::PARAM_INT);
            $pdo_statement->bindParam(":date_created", 		  $this->date_created, 		  PDO::PARAM_INT);
            $pdo_statement->execute();

            $this->article_id = $pdo_connection->lastInsertId();

        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

    //---------------------------------------------------------------------------------------------------------------------

    public function select()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "SELECT
                            *
                        FROM
                            articles
                        WHERE
                            article_id = :article_id";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":article_id", $this->article_id, PDO::PARAM_INT);
            $pdo_statement->execute();
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);

            $this->article_id 			= $result["article_id"];
            $this->route_id 			= $result["route_id"];
            $this->article_category_id  = $result["article_category_id"];
            $this->article_title 		= $result["article_title"];
            $this->article_type			= $result["article_type"];
            $this->content 				= $result["content"];
            $this->author 				= $result["author"];
            $this->is_publish 			= $result["is_publish"];
            $this->date_created 		= $result["date_created"];
            $this->date_modified 		= $result["date_modified"];
            $this->metadata 			= $result["metadata"];
            $this->downloadables_path   = $result["downloadables_path"];
            $this->image_id 			= $result["image_id"];
        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

    //---------------------------------------------------------------------------------------------------------------------

    public function update()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "UPDATE
                        articles
                    SET
                        route_id 			= :route_id,
                        article_category_id = :article_category_id,
                        article_title 		= :article_title,
                        content 			= :content,
                        author 				= :author,
                        article_type 	    = :article_type,
                        is_publish 			= :is_publish,
                        date_created 		= :date_created,
                        date_modified 		= :date_modified,
                        metadata 			= :metadata,
                        downloadables_path  = :downloadables_path,
                        image_id 			= :image_id,
                        hotel_image_id 			= :hotel_image_id,
                        hotel_name 			= :hotel_name,
                        hotel_description 			= :hotel_description,
                        position = :position
                    WHERE
                        article_id = :article_id";

            
            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":article_id", 		  $this->article_id,	      PDO::PARAM_INT);
            $pdo_statement->bindParam(":route_id", 			  $this->route_id,			  PDO::PARAM_INT);
            $pdo_statement->bindParam(":article_category_id", $this->article_category_id, PDO::PARAM_INT);
            $pdo_statement->bindParam(":article_title", 	  $this->article_title, 	  PDO::PARAM_STR);
            $pdo_statement->bindParam(":content", 			  $this->content, 			  PDO::PARAM_STR);
            $pdo_statement->bindParam(":author", 			  $this->author,			  PDO::PARAM_STR);
            $pdo_statement->bindParam(":article_type", 		  $this->article_type,		  PDO::PARAM_STR);
            $pdo_statement->bindParam(":is_publish", 		  $this->is_publish, 		  PDO::PARAM_INT);
            $pdo_statement->bindParam(":date_created", 		  $this->date_created, 		  PDO::PARAM_INT);
            $pdo_statement->bindParam(":date_modified", 	  $this->date_modified,	  	  PDO::PARAM_INT);
            $pdo_statement->bindParam(":metadata", 			  $this->metadata, 			  PDO::PARAM_STR);
            $pdo_statement->bindParam(":downloadables_path",  $this->downloadables_path,  PDO::PARAM_STR);
            $pdo_statement->bindParam(":image_id", 			  $this->image_id, 			  PDO::PARAM_INT);
            $pdo_statement->bindParam(":hotel_image_id", 			  $this->hotel_image_id, 			  PDO::PARAM_INT);
            $pdo_statement->bindParam(":hotel_name", 			  $this->hotel_name, 			  PDO::PARAM_INT);
            $pdo_statement->bindParam(":hotel_description", 			  $this->hotel_description, 			  PDO::PARAM_INT);
            $pdo_statement->bindParam(":position", 			  $this->position, 			  PDO::PARAM_INT);
            $pdo_statement->execute();

        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

    //---------------------------------------------------------------------------------------------------------------------

    public function delete()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "DELETE FROM
                            articles
                        WHERE
                            article_id = :article_id";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":article_id", $this->article_id, PDO::PARAM_INT);
            $pdo_statement->execute();

        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

    //---------------------------------------------------------------------------------------------------------------------

    public function updateOneColumn($column, $value)
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "UPDATE
                            articles
                        SET
                            $column = :$column
                        WHERE
                            article_id = :article_id";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":article_id", $this->article_id, PDO::PARAM_INT);
            $pdo_statement->bindParam(":$column", $value, PDO::PARAM_INT);
            $pdo_statement->execute();

        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }
}

?>
