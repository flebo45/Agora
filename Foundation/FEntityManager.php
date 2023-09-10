<?php

//NOTA IMPORTANTE : SE UTILIZZIAMO SQL, L'ENTITY MANAGER NON RICONOSCE LE ENTITY SALVATE IN PRECEDENZA E QUINDI NE CREA DI NUOVE
require_once('bootstrap.php');

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
    public static function retriveObj($class, $id)
    {
        try{
            $obj = self::$entityManager->find($class, $id);
            return $obj;
        }catch(Exception $e){
            echo "ERROR: ". $e->getMessage();
            return null;
        }
        
    }

    /**
     * return an object finding it not on the id but on an attribute
     */
    public static function retriveObjNotOnId($class, $field, $id)
    {
        try{
            $obj = self::$entityManager->getRepository($class)->findOneBy([$field => $id]);
            return $obj;
        }catch(Exception $e){
            echo "ERROR: ". $e->getMessage();
            return null;
        }
    }

    /**
     * return an object finding it not on the id but specifying 2 attributes
     */
    public static function getObjOnAttributes($table, $field1, $id1, $field2, $id2)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field1 . " = ".$id1. " AND e." . $field2 . " = ". $id2;
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getOneOrNullResult();
            return $result;

        }catch(Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }


    /**
     * delete the object in the db, and all the object related to it if there is cascade
     * @return boolean
     */
    public static function deleteObjInDb($obj)
    {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->remove($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * save one object in the db (persistance of Entity)
     * @return boolean
     */
    public static function saveObject($obj)
    {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

     /**
     * save multiple objects in the db (persistance for multiple Entity)
     * for ex. User-Post, Comment-Post-User etc.
     * @return boolean
     */
    public static function saveObjects(array $objects)
    {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            foreach($objects as $obj){
                self::$entityManager->persist($obj);
            }
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * return a list of objects
     * @return array
     */
    public static function objectList($table, $field, $id)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            return $result;
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return [];
            }
        
    }

    /**
     * return all the object of a specifyc table (ex. all the report)
     * @return array
     */
    public static function objectListNull($table, $field)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." .$field. " IS NULL";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }

    }

    /**
     * retrun a list of objects finding it on a specific attribute
     */
    public static function objectListAttribute($table, $field, $id)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE  e." .$field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return [];
        }
    }

    /**
     * return the numbe of objects in a list finding they on a specific attribute
     */
    public static function countObjectListAttribute($table, $field, $id)
    {
        try{
            $dql = "SELECT COUNT(e) FROM " . $table . " e WHERE  e." .$field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getSingleScalarResult();
            return $result;
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return [];
        }
    }

    /**
     * return a list of object that are not banned (for ex. posts and comments not banned)
     * @return array
     */
    public static function objectListNotRemoved($table, $field, $id)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId AND e.removed = 0";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return array();
        }
    }
    

    public static function topUserFollower()
    {
        $limit = 3;
        $query = self::$entityManager->createQuery("SELECT uf.idFollowed, COUNT(uf.idFollowed) as followCount
        FROM EUserFollow uf
        GROUP BY uf.idFollowed
        ORDER BY followCount DESC")->setMaxResults($limit);

        try {
            $result = $query->getResult();
        }catch (\Exception $e) {
            echo "ERROR " . $e->getMessage();
            return [];
        }
        return $result;
    }

    /**
     * verify if exist an object
     */
    public static function verifyAttributes($fieldId, $table, $field, $id){
        try{
            $dql = "SELECT u.id".$fieldId. " FROM " . $table . " u WHERE u." . $field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getResult();
            if(count($result) > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }
    }

    /**
     * return a list of all the Post that are not beloged to an user
     */
    public static function getPostNotBelongedToUser($table, $field, $idUser)
    {
        try{
            $limit = 10;
            $dql = "SELECT p FROM " . $table . " p WHERE p." . $field . " <> :idUser AND p.removed  = false ORDER BY p.creation_time DESC";
            $query = self::$entityManager->createQuery($dql)->setParameter('idUser', $idUser)->setMaxResults($limit);
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return [];
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }

    /**
     * return a list of all the object that have the $str in the specified attribute
     */
    public static function getSearchedItem($table, $field, $str)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " LIKE :searchedStr";
            $query = self::$entityManager->createQuery($dql)->setParameter('searchedStr', '%' . $str . '%');
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }

    /**
     * return a liss of partial Post  that have the $str in the specified attribute
     */
    public static function getSearchedItemPart($table, $field, $str)
    {
        try{
            $dql = "SELECT partial e.{idPost, user, title} FROM " . $table . " e WHERE e." . $field . " LIKE :searchedStr";
            $query = self::$entityManager->createQuery($dql)->setParameter('searchedStr', '%' . $str . '%');
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }

}