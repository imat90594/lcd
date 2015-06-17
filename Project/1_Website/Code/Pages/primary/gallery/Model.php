<?php
require_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/modelSuperClass_Core/modelSuperClass_Core.php';

class model extends modelSuperClass_Core
{
	
	public function getAlbumsWithImagePreview($sorted = FALSE)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "SELECT
								a.album_id,
								a.album_title,
								a.album_folder,
								a.sorting_number,
								(SELECT COUNT(*) FROM images WHERE album_id = a.album_id) as image_count,
								a.is_used,
								s.size_id,
								s.dimensions,
								i.image_id,
								i.image_title,
								i.image_caption,
								i.filename,
								i.filename_ext,
								i.date_created,
								i.path			
							FROM
								albums a
							LEFT JOIN
								album_image_sizes s
							ON 
								a.album_id = s.album_id
							LEFT JOIN
								images i
							ON	
								i.size_id = s.size_id
							WHERE
								a.is_used = 1
					";
				
			if($sorted)
			$sql .= " ORDER BY a.sorting_number";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
			
			$new_albums_array = array();
				
			//remove the duplicate albums and gets the preview
			foreach($results as $result)
			{
				if(!array_key_exists($result["album_id"], $new_albums_array))
				$new_albums_array[$result["album_id"]] = $result;
				else
				{
					if($result["image_id"] != NULL)
					$new_albums_array[$result["album_id"]] = $result;
				}
			}
				
			return $new_albums_array;
		}
		catch(PDOException $e)
		{
	
		}
	}
	
	
	public function getImages($album_id)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "SELECT
							 i. * , 
							 s. * ,
							 a. *
						FROM
						   images i
						LEFT JOIN 
					   		album_image_sizes s 
					   	ON
					   		 i.size_id = s.size_id
					   	LEFT JOIN
					   		albums a
					   	ON
					   		a.album_id = i.album_id
						WHERE
							 a.album_id = :album_id
						";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":album_id", $album_id, PDO::PARAM_INT);
			$pdo_statement->execute();
				
			$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
			return $results;
		}
		catch(PDOException $e)
		{
			echo "<pre>".$e->getMessage();
		}
	}
	
	
}
?>