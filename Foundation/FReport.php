<?php

class FReport extends FEntityManager{

    private static $entity_class = Report::class;

    #methods

    public static function getEntityClass(){

        return self::$entity_class;
    }

    public static function retriveReport($id){

        $fem = FEntityManager::getInstance();

        $result = $fem::retriveObj(self::getEntityClass(), $id);

        return $result;
    }

    public static function saveReportPostInDb(Report $report, User $user, Post $post){

        $fem = FEntityManager::getInstance();

        $objects = [$report, $user, $post];

        $result = $fem::saveObjects($objects);

        return $result;
    }

    public static function saveReportCommentInDb(Report $report, User $user, Comment $comment){

        $fem = FEntityManager::getInstance();

        $objects = [$report, $user, $comment];

        $result = $fem::saveObjects($objects);

        return $result;
    }

    public static function deleteReportInDb(Report $report){

        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($report);

        return $result;
    }

    public static function reportPostList(){

        $fem = FEntityManager::getInstance();

        $result = $fem::allObjectList(self::getEntityClass());

        return $result;
    }
}