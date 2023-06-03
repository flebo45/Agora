<?php
class CMod{

    //Verify if the user is logged
    public static function isLogged(){
        $identified = false;
        if (isset($_SESSION['userID'])){
            $identified = true;
        }
        return $identified;
    }
}