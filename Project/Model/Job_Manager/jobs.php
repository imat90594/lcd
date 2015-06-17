<?php 
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';
require_once "job.php";

class jobs
{
	public $array_of_jobs = array();
	
	public function select($is_published = false)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "
					SELECT 
						*
					FROM
						jobs
			";
			
			if($is_published)
				$sql .= " WHERE is_published = 1";
			
			$sql .= " ORDER BY priority_number ";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
			
			$results = $pdo_statement->fetchAll(PDO::FETCH_OBJ);
			
			foreach($results as $result)
			{
				$job = new job();
				
				$job->job_id 		   = $result->job_id;
				$job->job_title 	   = $result->job_title;
				$job->job_description  = $result->job_description;
				$job->date_created 	   = $result->date_created;
				$job->job_permalink    = $result->job_permalink;
				$job->is_published     = $result->is_published;
				$job->email_receiver   = $result->email_receiver;
				$job->priority_number  = $result->priority_number;
				
				$this->array_of_jobs[] = $job;
			}
			
			
		}
		catch(PDOException $e)
		{
			throw new Exception($e);
		}	
	
	}
}

?>