<?php 
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';


class jobsModel
{
	
	public function udpateJobPriority($items)
	{
		try
		{
			
			$pdo_connection = starfishDatabase::getConnection();
			
			$sql = "UPDATE
						jobs
					SET
						priority_number	= :priority_number
					WHERE
						job_id = :job_id ";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			
			$priority_number = 1;
			foreach($items as $item)
			{
				$pdo_statement->bindParam(":job_id", $item["job_id"], PDO::PARAM_STR);
				$pdo_statement->bindParam(":priority_number", $priority_number, PDO::PARAM_STR);
				$pdo_statement->execute();
				$priority_number++;
			}
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
}

?>