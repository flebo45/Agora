<?php

class FReport extends FEntityManager{

    public static function deleteReportInDb(EReport $report){

        $fem = FEntityManager::getInstance();

        $result = $fem::deleteObjInDb($report);

        return $result;
    }

}