<?php 

require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';

class job
{
	public $job_id;
	public $job_title;
	public $job_description;
	public $date_created;
	public $job_permalink;
	public $is_published;
	public $email_receiver;
	public $priority_number;
	public $job_metadata;
	
//--------------------------------------------------------------------------------------------------------
	
	
	public function insert()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "
						INSERT INTO
							`jobs`
							(
								job_title,
								job_description,
								date_created,
								job_permalink,
								is_published,
								email_receiver,
								priority_number								
							)
							VALUES
							(
								:job_title,
								:job_description,
								:date_created,
								:job_permalink,
								:is_published,
								:email_receiver,
								:priority_number
							)
					";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_title', $this->job_title, PDO::PARAM_STR);
			$pdo_statement->bindParam(':job_description', $this->job_description, PDO::PARAM_INT);
			$pdo_statement->bindParam(':date_created', $this->date_created, PDO::PARAM_INT);
			$pdo_statement->bindParam(':job_permalink', $this->job_permalink, PDO::PARAM_STR);
			$pdo_statement->bindParam(':is_published', $this->is_published, PDO::PARAM_STR);
			$pdo_statement->bindParam(':email_receiver', $this->email_receiver, PDO::PARAM_STR);
			$pdo_statement->bindParam(':priority_number', $this->priority_number, PDO::PARAM_STR);
				
			$pdo_statement->execute();
	
			$this->job_id = $pdo_connection->lastInsertId();
	
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function delete()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "										
					DELETE FROM
							jobs
						WHERE
							job_id = :job_id
								";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->execute();
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//--------------------------------------------------------------------------------------------------------
	
	public function select()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
	
			$sql = "SELECT * FROM
						jobs	
					WHERE
						job_id	= :job_id
					";
	
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->execute();
	
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
	
			$this->job_id 				= $result['job_id'];
			$this->job_title 			= $result['job_title'];
			$this->job_description		= $result['job_description'];
			$this->date_created			= $result['date_created'];
			$this->job_permalink		= $result['job_permalink'];
			$this->is_published			= $result['is_published'];
			$this->email_receiver       = $result['email_receiver'];
			$this->priority_number      = $result['priority_number'];
			$this->job_metadata    	    = $result['job_metadata'];
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	
	}

	
//--------------------------------------------------------------------------------------------------------
	
	public function update()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "UPDATE
						jobs
					SET
						job_title 		= :job_title,
						job_description = :job_description,
						job_permalink 	= :job_permalink,
						is_published	= :is_published,
						email_receiver	= :email_receiver,
						job_metadata    = :job_metadata
					WHERE
						job_id = :job_id
			";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->bindParam(':job_title', $this->job_title, PDO::PARAM_STR);
			$pdo_statement->bindParam(':job_description', $this->job_description, PDO::PARAM_STR);
			$pdo_statement->bindParam(':job_permalink', $this->job_permalink, PDO::PARAM_STR);
			$pdo_statement->bindParam(':is_published', $this->is_published, PDO::PARAM_STR);
			$pdo_statement->bindParam(':email_receiver', $this->email_receiver, PDO::PARAM_STR);
			$pdo_statement->bindParam(':job_metadata', $this->job_metadata, PDO::PARAM_STR);
			$pdo_statement->execute();
				
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
	
//--------------------------------------------------------------------------------------------------------

	public function updateOneColumn($column, $value)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
			$sql = "UPDATE
						jobs
					SET
						$column = '{$value}'
					WHERE
						job_id = :job_id
			";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(':job_id', $this->job_id, PDO::PARAM_INT);
			$pdo_statement->execute();
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------
	
	public function selectFirst()
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
				
			$sql = "SELECT
							*
						FROM
							jobs
						LIMIT 0,1 ";
			
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->execute();
				
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
	
			$this->job_id 				= $result['job_id'];
			$this->job_title 			= $result['job_title'];
			$this->job_description		= $result['job_description'];
			$this->date_created			= $result['date_created'];
			$this->job_permalink		= $result['job_permalink'];
			$this->is_published			= $result['is_published'];
			$this->email_receiver       = $result['email_receiver'];
			$this->priority_number      = $result['priority_number'];
			$this->job_metadata      	= $result['job_metadata'];
			
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}
	}
	
//-------------------------------------------------------------------------------------------------

	public function checkPermalink($job_permalink)
	{
		try
		{
			$pdo_connection = starfishDatabase::getConnection();
		
			$sql = "SELECT
						*
					FROM
						jobs
					WHERE
						job_permalink = :job_permalink";
				
			$pdo_statement = $pdo_connection->prepare($sql);
			$pdo_statement->bindParam(":job_permalink", $job_permalink, PDO::PARAM_STR);
			$pdo_statement->execute();
		
			$result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
			
			return $result;
		
		}
		catch(PDOException $pdoe)
		{
			throw new Exception($pdoe);
		}	
	}
	
	
	
}

?>