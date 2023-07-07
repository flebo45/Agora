<?php
//NOTA IMPORTANTE : SE UTILIZZIAMO SQL, L'ENTITY MANAGER NON RICONOSCE LE ENTITY SALVATE IN PRECEDENZA E QUINDI NE CREA DI NUOVE
use Doctrine\ORM\Query as DQL;
use Doctrine\ORM\Query\Expr;

class FEntityManager{
    private static $instance;
    private static $entityManager;


    private function __construct() {
        self::$entityManager = getEntityManager();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getEM(){
        if (!self::$entityManager){
            self::$entityManager = getEntityManager();
        }
    }

    /**
     * retrive one obj
     * @return obj || null
     */
    public static function retriveObj($class, $id){
        try{
            $obj = self::$entityManager->find($class, $id);
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
    public static function existInDb($class, $id){
        try{
            $obj = self::$entityManager->find($class, $id);

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
    public static function saveObject($obj){
        try{
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
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
    public static function saveObjects(array $objects){
        try{
            foreach($objects as $obj){
                self::$entityManager->persist($obj);
            }
            self::$entityManager->flush();
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
    public static function deleteObjInDb($entityClass, $id){
        try{
            $entity = self::$entityManager->find($entityClass, $id);
            if($entity !== null){
                self::$entityManager->remove($entity);
                self::$entityManager->flush();
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
     * for ex. a list of Posts belong to a User
     */
    public static function objectList($table, $field, $id){
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult(DQL::HYDRATE_ARRAY);
            return $result;
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }
    }
    
    
}