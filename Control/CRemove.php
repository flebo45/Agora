<?php

class CReport{
    public function reportList(){
        if(CMod::isLogged()){
            $pm = FPersistentManager::getInstance();
            $reportList = $pm->reportTable();

            //call to a view ($reportList)
        }
        else{
            //header
        }
    }

    public function selectReport(){
        if(CMod::isLogged()){
            //take data from the view
            $reportId = $_SESSION[$reportID];

            //show view (pagina post e report)
        }
        else{
            //header
        }
    }

    public function unsetReport(){
        if(CMod::isLogged()){
            //take reportId from the _SESSION
            $pm = FPersistentManager::getInstance();
            $pm->unsetReport($reportID);
            //header tabella
        }
        else{
            //header
        }
    }

    public function deleteItem(){
        if(CMod::isLogged()){
            //take id from _SESSION
            $pm = FPersistentManager::getInstance();
            $pm->deleteItem($id);
            //header tabella
        }
        else{
            //header
        }
    }



}