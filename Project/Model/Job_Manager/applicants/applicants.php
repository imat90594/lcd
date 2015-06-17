<?php
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';
require_once 'applicant.php';

class applicants
{
    public $applicants;

    //--------------------------------------------------------------------------------------------------------------------

    public function select()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "SELECT
                            *
                        FROM
                            applicants
            		ORDER BY
            			date_applied
            ";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->execute();
            $results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

            foreach($results as $result)
            {
                $applicant = new applicant();

                $applicant->applicant_id = $result["applicant_id"];
                $applicant->applicant_details = $result["applicant_details"];
                $applicant->application_form_path = $result["application_form_path"];
                $applicant->date_applied = $result["date_applied"];
                $this->applicants[] = $applicant;

            }
        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }
    
    //-------------------------------------------------------------------------------------------
    
    public function selectToday()
    {
    	try
    	{
    		$pdo_connection = starfishDatabase::getConnection();
    		$sql = "SELECT
                                *
                            FROM
                                applicants
                        WHERE DATE(date_applied) = CURDATE()
                		ORDER BY
                			date_applied DESC
                ";
    
    		$pdo_statement = $pdo_connection->prepare($sql);
    		$pdo_statement->execute();
    		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    
    		$this->applicants  = array();
    		
    		foreach($results as $result)
    		{
    			$applicant = new applicant();
    
    			$applicant->applicant_id = $result["applicant_id"];
    			$applicant->applicant_details = $result["applicant_details"];
    			$applicant->application_form_path = $result["application_form_path"];
    			$applicant->date_applied = $result["date_applied"];
    			$this->applicants[] = $applicant;
    
    		}
    	}
    	catch(PDOException $pdoe)
    	{
    		throw new Exception($pdoe);
    	}
    }
    
    //-------------------------------------------------------------------------------------------
    
    public function selectThisWeek()
    {
    	try
    	{
    		$pdo_connection = starfishDatabase::getConnection();
    		$sql = "SELECT * FROM applicants
						WHERE
							WEEK(date_applied) = WEEK(CURDATE())
						AND
							MONTH(date_applied) = MONTH(CURDATE())
                    ";
    
    		$this->applicants  = array();
    		$pdo_statement = $pdo_connection->prepare($sql);
    		$pdo_statement->execute();
    		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    
    		foreach($results as $result)
    		{
    			$applicant = new applicant();
    
    			$applicant->applicant_id = $result["applicant_id"];
    			$applicant->applicant_details = $result["applicant_details"];
    			$applicant->application_form_path = $result["application_form_path"];
    			$applicant->date_applied = $result["date_applied"];
    			$this->applicants[] = $applicant;
    
    		}
    	}
    	catch(PDOException $pdoe)
    	{
    		throw new Exception($pdoe);
    	}
    }
    
    //-------------------------------------------------------------------------------------------
    
    public function selectThisMonth()
    {
    	try
    	{
    		$pdo_connection = starfishDatabase::getConnection();
    		$sql = "
    				SELECT * FROM applicants 
						WHERE MONTH(date_applied) = MONTH(NOW()) AND YEAR(date_applied) = YEAR(NOW())
              ";
    
    		$this->applicants  = array();
    		$pdo_statement = $pdo_connection->prepare($sql);
    		$pdo_statement->execute();
    		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    
    		foreach($results as $result)
    		{
    			$applicant = new applicant();
    
    			$applicant->applicant_id = $result["applicant_id"];
    			$applicant->applicant_details = $result["applicant_details"];
    			$applicant->application_form_path = $result["application_form_path"];
    			$applicant->date_applied = $result["date_applied"];
    			$this->applicants[] = $applicant;
    
    		}
    	}
    	catch(PDOException $pdoe)
    	{
    		throw new Exception($pdoe);
    	}
    }
    
    //-------------------------------------------------------------------------------------------
    
    public function selectLastMonth()
    {
    	try
    	{
    		$pdo_connection = starfishDatabase::getConnection();
    		$sql = "SELECT * FROM applicants
					WHERE 
						date_applied 
					BETWEEN DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m-01 00:00:00') AND DATE_FORMAT(LAST_DAY(NOW() - INTERVAL 1 MONTH), '%Y-%m-%d 23:59:59')
            ";
    
    		$pdo_statement = $pdo_connection->prepare($sql);
    		$pdo_statement->execute();
    		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    
    		$this->applicants  = array();
    		
    		foreach($results as $result)
    		{
    			$applicant = new applicant();
    
    			$applicant->applicant_id = $result["applicant_id"];
    			$applicant->applicant_details = $result["applicant_details"];
    			$applicant->application_form_path = $result["application_form_path"];
    			$applicant->date_applied = $result["date_applied"];
    			$this->applicants[] = $applicant;
    
    		}
    	}
    	catch(PDOException $pdoe)
    	{
    		throw new Exception($pdoe);
    	}
    }
    
    //-------------------------------------------------------------------------------------------
    
    public function selectOlder()
    {
    	try
    	{
    		$pdo_connection = starfishDatabase::getConnection();
    		$sql = "SELECT *
						from applicants
					WHERE
					   date_applied <= (now() - interval 2 month);
            ";
    
    		$pdo_statement = $pdo_connection->prepare($sql);
    		$pdo_statement->execute();
    		$results = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
    
    		foreach($results as $result)
    		{
    			$applicant = new applicant();
    
    			$applicant->applicant_id = $result["applicant_id"];
    			$applicant->applicant_details = $result["applicant_details"];
    			$applicant->application_form_path = $result["application_form_path"];
    			$applicant->date_applied = $result["date_applied"];
    			$this->applicants[] = $applicant;
    
    		}
    	}
    	catch(PDOException $pdoe)
    	{
    		throw new Exception($pdoe);
    	}
    }
    
    
    
    
    
}

?>
