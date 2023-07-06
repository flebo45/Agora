<?php
//NOTA IMPORTANTE : SE UTILIZZIAMO IL beginTransaction(), L'ENTITY MANAGER NON RICONOSCE LE ENTITY SALVATE IN PRECEDENZA E QUINDI NE CREA DI NUOVE


class FEntityManager{
    private static $instance;
    private $entityManager;
    private $connection;


    private function __construct() {
        $this->entityManager = getEntityManager();
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

    public function saveObject($obj){
        try{
            $this->entityManager->persist($obj);
            $this->entityManager->flush();
        }catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    public function saveObjects(array $objects){
        try{
            foreach($objects as $obj){
                $this->entityManager->persist($obj);
            }
            $this->entityManager->flush();
        }catch(PDOException $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    public function deleteObjInDb($entityClass, $id){

        try{
            $entity = $this->entityManager->find($entityClass, $id);
            if($entity !== null){
                $this->entityManager->remove($entity);
                $this->entityManager->flush();
                $result = true;
            }else{
                $result = false;
            }
        }catch(PDOException $e){
            echo "ERROR " . $e->getMessage();
            $this->connection->rollBack();
            $result =  false;
        }

        return $result;
    }
//todo
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