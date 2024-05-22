<?php

class FUserFollow{

    public static function followedNumb($idUser){
        $result = FEntityManager::getInstance()->countObjectListAttribute(EUserFollow::getEntity(), 'idFollower', $idUser);

        return $result;
    }

    public static function followerNumb($idUser){
        $result = FEntityManager::getInstance()->countObjectListAttribute(EUserFollow::getEntity(), 'idFollowed', $idUser);

        return $result;
    }

    public static function followedList($idUser){
        $result = FEntityManager::getInstance()->objectList(EUserFollow::getEntity(), 'idFollower', $idUser);

        return $result;
    }

    public static function followerList($idUser){
        $result = FEntityManager::getInstance()->objectList(EUserFollow::getEntity(), 'idFollowed', $idUser);

        return $result;
    }

    public static function getTopUserFollower(){
        $query = FEntityManager::getInstance()::getEntityManager()->createQuery("SELECT uf.idFollowed, COUNT(uf.idFollowed) as followCount
        FROM EUserFollow uf
        GROUP BY uf.idFollowed
        ORDER BY followCount DESC")->setMaxResults(MAX_VIP);

        try {
            $result = $query->getResult();
        }catch (\Exception $e) {
            echo "ERROR " . $e->getMessage();
            return [];
        }
        return $result;
    }

    public static function retriveUserFollow($idUser, $idFollowed){
        $result = FEntityManager::getInstance()->getObjOnTwoAttributes(EUserFollow::getEntity(), 'idFollower', $idUser, 'idFollowed', $idFollowed);

        return $result;
    }
}