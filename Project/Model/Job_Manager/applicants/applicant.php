<?php
require_once FILE_ACCESS_CORE_CODE.'/Modules/Database/starfishDatabase.php';
class applicant
{
    public $applicant_id;
    public $applicant_details;
    public $application_form_path;
    public $date_applied;

    //--------------------------------------------------------------------------------------------------------------------

    public function insert()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "INSERT INTO
                        applicants
                        (
                            applicant_details,
                            application_form_path,
                            date_applied
                        )
                    VALUES
                        (
                            :applicant_details,
                            :application_form_path,
                            :date_applied
                        )";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":applicant_details", $this->applicant_details, PDO::PARAM_INT);
            $pdo_statement->bindParam(":application_form_path", $this->application_form_path, PDO::PARAM_STR);
            $pdo_statement->bindParam(":date_applied", $this->date_applied, PDO::PARAM_STR);
            $pdo_statement->execute();

            $this->applicant_id = $pdo_connection->lastInsertId();

        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

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
                        WHERE
                            applicant_id = :applicant_id";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":applicant_id", $this->applicant_id, PDO::PARAM_INT);
            $pdo_statement->execute();
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);

            $this->applicant_id = $result["applicant_id"];
            $this->applicant_details = $result["applicant_details"];
            $this->application_form_path = $result["application_form_path"];
            $this->date_applied = $result["date_applied"];
        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

    //--------------------------------------------------------------------------------------------------------------------

    public function update()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "UPDATE
                        applicants
                    SET
                        applicant_details = :applicant_details,
                        application_form_path = :application_form_path,
                        date_applied = :date_applied 
                    WHERE
                        applicant_id = :applicant_id";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":applicant_id", $this->applicant_id, PDO::PARAM_INT);
            $pdo_statement->bindParam(":applicant_details", $this->applicant_details, PDO::PARAM_INT);
            $pdo_statement->bindParam(":application_form_path", $this->application_form_path, PDO::PARAM_STR);
            $pdo_statement->bindParam(":date_applied", $this->date_applied, PDO::PARAM_STR);
            $pdo_statement->execute();

        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

    //--------------------------------------------------------------------------------------------------------------------

    public function delete()
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "DELETE FROM
                            applicants
                        WHERE
                            applicant_id = :applicant_id";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":applicant_id", $this->applicant_id, PDO::PARAM_INT);
            $pdo_statement->execute();

        }
        catch(PDOException $pdoe)
        {
            throw new Exception($pdoe);
        }
    }

    //--------------------------------------------------------------------------------------------------------------------

    public function updateOneColumn($column, $value)
    {
        try
        {
            $pdo_connection = starfishDatabase::getConnection();
            $sql = "UPDATE
                            applicants
                        SET
                            $column = :$column
                        WHERE
                            applicant_id = :applicant_id";

            $pdo_statement = $pdo_connection->prepare($sql);
            $pdo_statement->bindParam(":applicant_id", $this->applicant_id, PDO::PARAM_INT);
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
