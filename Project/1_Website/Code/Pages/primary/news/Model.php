<?phprequire_once FILE_ACCESS_CORE_CODE.'/Framework/MVC_superClasses_Core/modelSuperClass_Core/modelSuperClass_Core.php';require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';class model extends modelSuperClass_Core{	public function selectPrev($previous,$type,$route_id)	{		try 		{			$pdo_connection = starfishDatabase::getConnection();						$sql = "SELECT						a.*,						r.*					FROM						articles a					LEFT JOIN						route r					ON						a.route_id = r.route_id					WHERE						a.article_type = :type					AND						a.date_created <= :date_created					AND						a.route_id < :route_id					AND						a.is_publish = '1'					";						$pdo_statement = $pdo_connection->prepare($sql);			$pdo_statement->bindParam(":date_created",$previous,	PDO::PARAM_INT);			$pdo_statement->bindParam(":type",$type,				PDO::PARAM_STR);			$pdo_statement->bindParam(":route_id",$route_id,		PDO::PARAM_INT);			$pdo_statement->execute();						return $pdo_statement->fetch(PDO::FETCH_ASSOC);		}		catch(PDOException $pdoe)		{			throw new PDOException($pdoe);			}	}		public function selectNext($next,$type,$route_id)	{		try 		{			$pdo_connection = starfishDatabase::getConnection();						$sql = "SELECT						a.*,						r.*					FROM						articles a					LEFT JOIN						route r					ON						a.route_id = r.route_id					WHERE						a.article_type = :type					AND						a.date_created >= :date_created					AND						a.route_id > :route_id					AND						a.is_publish = '1'					";						$pdo_statement = $pdo_connection->prepare($sql);			$pdo_statement->bindParam(":date_created",$next,	PDO::PARAM_INT);			$pdo_statement->bindParam(":type",$type,				PDO::PARAM_STR);			$pdo_statement->bindParam(":route_id",$route_id,		PDO::PARAM_INT);			$pdo_statement->execute();						return $pdo_statement->fetch(PDO::FETCH_ASSOC);		}		catch(PDOException $pdoe)		{			throw new PDOException($pdoe);			}	}		public function selectArchive($type)	{		try		{			$pdo_connection = starfishDatabase::getConnection();						$sql = "SELECT 						DATE_FORMAT(FROM_UNIXTIME(`date_created`), '%Y') as YEAR,						DATE_FORMAT( FROM_UNIXTIME(`date_created`), '%M') as MONTH,						(							SELECT 								count(a.article_title) 							FROM 								articles a							LEFT JOIN								route r							ON								a.route_id = r.route_id							WHERE								article_type = :type							AND								is_publish = '1'							AND								DATE_FORMAT( FROM_UNIXTIME(`date_created`), '%M') = MONTH						) as article_count										FROM 						articles					WHERE						article_type = :type					AND						is_publish = '1'					GROUP BY						MONTH desc					";						$pdo_statement = $pdo_connection->prepare($sql);			$pdo_statement->bindParam(":type",$type, PDO::PARAM_STR);			$pdo_statement->execute();						return $pdo_statement->fetchAll(PDO::FETCH_GROUP);		}		catch(PDOException $pdoe)		{			throw new PDOException($pdoe);		}	}		public function selectArchiveByDate($start_date,$end_date,$type)	{		try		{			$pdo_connection = starfishDatabase::getConnection();						$sql = "SELECT						a.*,						r.*,						ac.article_category_id,						ac.parent_id,						ac.category_type,						ac.category_name,						ac.metadata,						ac.description,						ac.permalink as category_permalink,						i.image_title,						i.image_caption,						CONCAT('/Data/Images/', ab.album_folder, '/', ais.dimensions, '/', i.path) as image_path					FROM						articles a					INNER JOIN						route r					ON						a.route_id = r.route_id					LEFT JOIN						article_categories ac					ON						ac.article_category_id = a.article_category_id					LEFT JOIN						images i					ON						a.image_id = i.image_id					LEFT JOIN						albums ab					ON						i.album_id = ab.album_id					LEFT JOIN						album_image_sizes ais					ON						i.size_id = ais.size_id 					WHERE						1=1					AND						a.article_type = :type					AND						a.is_publish = '1'					AND						a.date_created					BETWEEN						:start_date					AND						:end_date 					";									$pdo_statement = $pdo_connection->prepare($sql);			$pdo_statement->bindParam(":start_date",$start_date,	PDO::PARAM_INT);						$pdo_statement->bindParam(":end_date",$end_date,		PDO::PARAM_INT);						$pdo_statement->bindParam(":type",$type,				PDO::PARAM_STR);						$pdo_statement->execute();						return $pdo_statement->fetchAll(PDO::FETCH_ASSOC);		}		catch(PDOException $pdoe)		{			throw new PDOException($pdoe);		}	}
}