<?php

class FReport extends FEntityManager{

    public static function deleteReportInDb(EReport $report){

        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($report);

        return $result;
    }

    public static function reportedPostList()
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::objectListNull(EReport::getEntity(), 'comment');

        return $result;
    }

    public static function reportedCommentList()
    {
        $fem = FEntityManager::getInstance();

        $result = $fem::objectListNull(EReport::getEntity(), 'post');

        return $result;
    }

    public static function listReportsOnParam($param , $id){
        $fem = FEntityManager::getInstance();

        $result = $fem::objectListAttribute(EReport::getEntity(), $param, $id);

        return $result;
    }

}