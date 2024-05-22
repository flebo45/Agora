<?php
class FPost{
    public static function postListNotBanned($idUser){
        $field = "user";

        $result = FEntityManager::getInstance()->objectListNotRemoved(EPost::getEntity(), $field, $idUser);

        return $result;
    }

    public static function getSearched($field, $value){
        if($field == "title"){
            $result = FEntityManager::getInstance()->getSearchedItem(EPost::getEntity(), $field, $value);
        }else {
            $result = FEntityManager::getInstance()->objectListNotRemoved(EPost::getEntity(), $field, $value);
        }
       
        return $result;
    }

    public static function postInExplore($idUser){
        $table = EPost::getEntity();
        $field = 'user';
        try{
            $dql = "SELECT p FROM " . $table . " p WHERE p." . $field . " <> :idUser AND p.removed  = false ORDER BY p.creation_time DESC";
            $query = FEntityManager::getInstance()->getEntityManager()->createQuery($dql)->setParameter('idUser', $idUser)->setMaxResults(MAX_POST_EXPLORE);
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

    public static function comparePostsByCreationTime($post1, $post2) {
        $time1 = $post1->getTime();
        $time2 = $post2->getTime();

        if ($time1 == $time2) {
            return 0;
        }

        return ($time1 > $time2) ? -1 : 1;
    }
}