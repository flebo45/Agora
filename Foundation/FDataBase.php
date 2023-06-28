<?php

class FDataBase{

    private static $instance;
    private $connection;

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
        // Initialize your database connection here
        $this->connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function closeConnection(){
        static::$instance = null;
    }

    /**
     * check if exist an entity in the table($entity)
     * checking the value ($field, $id)
     */
    public function existInDb($entity, $field, $id){

        try{
            $query = "SELECT * FROM" . $entity . "WHERE" . $field . "=" . $id . ";";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $this->closeConnection();

            if(count($result) >= 1) return true;
            
            else{return false;}
        }

        catch(PDOException $e){
            echo "ERROR" . $e->getMessage();
            return false;
        }
    }
}