<?php
//NOTA IMPORTANTE : SE UTILIZZIAMO SQL, L'ENTITY MANAGER NON RICONOSCE LE ENTITY SALVATE IN PRECEDENZA E QUINDI NE CREA DI NUOVE
use Doctrine\ORM\Query as DQL;

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
     * delete the object in the db, and all the object related to it if there is cascade
     * @return boolean
     */
    public static function deleteObjInDb($obj){
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->remove($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection()->rollBack();
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
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection()->rollBack();
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
            self::$entityManager->getConnection()->beginTransaction();
            foreach($objects as $obj){
                self::$entityManager->persist($obj);
            }
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection()->rollBack();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * return a list of objects
     * @return array
     */
    public static function objectList($table, $field, $id){
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            return $result;
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }
        
    }

    /**
     * return a list of object that are not banned (for ex. posts and comments not banned)
     * @return array
     */
    public static function objectListNotRemoved($table, $field, $id){
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId AND e.removed = 0";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            return $result;
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }

    }

    /**
     * return all the object of a specifyc table (ex. all the report)
     * @return array
     */
    public static function allObjectList($table){
        try{
            $dql = "SELECT e FROM " . $table . " e";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            return $result;
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }

    }

}