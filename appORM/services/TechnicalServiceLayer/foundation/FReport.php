<?php

class FReport{

    public static function reportedPostList(){
        $result = FEntityManager::getInstance()->objectListUsingNull(EReport::getEntity(), 'comment');

        return $result;
    }

    public static function reportedCommentList(){
        $result = FEntityManager::getInstance()->objectListUsingNull(EReport::getEntity(), 'post');

        return $result;
    }

    public static function deleteReports($id, $field = null){
        if($field === null){
            $report = FEntityManager::getInstance()->retriveObj(EReport::getEntity(), $id);
            $del = FEntityManager::getInstance()->deleteObj($report);
            return $del;
        }else{
            $reportlist = FEntityManager::getInstance()->objectList(EReport::getEntity(), $field, $id);
            foreach($reportlist as $r){
                FEntityManager::getInstance()->deleteObj($r);
            }
            return true;
        }
    }
}