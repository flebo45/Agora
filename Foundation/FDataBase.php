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
    public function existInDb($table, $field, $id){

        try{
            $query = "SELECT * FROM " . $table . " WHERE " . $field . " = " . $id . ";";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $this->closeConnection();

            if(count($result) >= 1) return true;
            
            else{return false;}
        }

        catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /** 
     * update the raw in the table 
     * using the $obj with the entity manager
     */
    public function updateRaw($obj){
        $em = getEntityManager();

        try{
            //mutual exclusion when we add or update obj in db
            $this->connection->beginTransaction();

            $em->persist($obj);
            $em->flush();

            self::closeConnection();
        }catch (PDOException $e){
            echo "ERROR: " . $e->getMessage();
            $this->connection->rollBack();
            return false;
        }


    }

    /** 
     * create a new raw in the table
     * using the $obj  with entity manager
     */
    public function createRaw($obj){
        $em = getEntityManager();

        try{
            //mutual exclusion when we add or update obj in db
            $this->connection->beginTransaction();

            $em->persist($obj);
            $em->flush();

            self::closeConnection();
        }catch (PDOException $e){
            echo "ERROR: " . $e->getMessage();
            $this->connection->rollBack();
            return false;
        }


    }

    public function createRawInRelation($obj1, $obj2){
        $em = getEntityManager();

        try{
            //mutual exclusion when we add or update obj in db
            $this->connection->beginTransaction();

            $em->persist($obj1);
            $em->persist($obj2);
            $em->flush();

            self::closeConnection();
        }catch (PDOException $e){
            echo "ERROR: " . $e->getMessage();
            $this->connection->rollBack();
            return false;
        }

    }

    public function deleteObjInDb($table, $field, $id){

        try{
            //mutual exclusion when we add or update obj in db
            $this->connection->beginTransaction();

            $exist = $this->existInDb($table, $field, $id);
            if($exist){

                $query = "DELETE  FROM " . $table . " WHERE " . $field . " = " . $id . ";";
                $statement = $this->connection->prepare($query);
                $statement->execute();
                $this->connection->commit();
                $this->closeConnection();
                $result = true;
            }else{
                $this->closeConnection();
                $result = false;
            }
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->connection->rollBack();
            $result =  false;
        }

        return $result;
    }


    public function objectList($table, $field, $id){
        try{
            $query = "SELECT * FROM " . $table . " WHERE " . $field . " = " . $id . ";";
            $statement = $this->connection->prepare($query);
            $statement->execute();

            $n = $statement->rowCount();

            if($n == 0){
                $result = null;
            }elseif($n == 1){
                $result = $statement->fetch(PDO::FETCH_ASSOC);
            }else{
                $result=array();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $statement->fetch())
                    $result[] = $row;
            }
            $this->closeConnection();
            return $result;
            }catch(PDOException $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }
        }

    
}