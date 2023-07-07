<?php
//NOTA IMPORTANTE : SE UTILIZZIAMO IL beginTransaction(), L'ENTITY MANAGER NON RICONOSCE LE ENTITY SALVATE IN PRECEDENZA E QUINDI NE CREA DI NUOVE
use Doctrine\ORM\Query as DQL;
use Doctrine\ORM\Query\Expr;

class FEntityManager{
    private static $instance;
    private $entityManager;


    private function __construct() {
        $this->entityManager = getEntityManager();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * retrive one obj
     * @return obj || null
     */
    public function retriveObj($class, $id){
        try{
            $obj = $this->entityManager->find($class, $id);
            return $obj;
        }catch(Exception $e){
            echo "ERROR: ". $e->getMessage();
            return null;
        }
    }

    /**
     * check if an object is in the db
     * @return boolean
     */
    public function existInDb($class, $id){
        try{
            $obj = $this->entityManager->find($class, $id);

            if($obj){
                return true;
            }else return false;
        }
        catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * save one object in the db (persistance of Entity)
     * @return boolean
     */
    public function saveObject($obj){
        try{
            $this->entityManager->persist($obj);
            $this->entityManager->flush();
            return true;
        }catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * save multiple objects in the db (persistance for multiple Entity)
     * for ex. User-Post, Comment-Post-User etc.
     * @return boolean
     */
    public function saveObjects(array $objects){
        try{
            foreach($objects as $obj){
                $this->entityManager->persist($obj);
            }
            $this->entityManager->flush();
            return true;
        }catch(Exception $e){
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }


    /**
     * delete objects in the db (watch out to relationship between entities)
     * @return boolean
     */
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
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            $result =  false;
        }

        return $result;
    }

    /**
     * retrive a list of objects 
     * for ex. a list of Post belong to a User
     */
    public function objectList($table, $field, $id){
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId";
            $query = $this->entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult(DQL::HYDRATE_ARRAY);
            return $result;
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }
    }
    
    
}