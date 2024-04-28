<?php

/**
 * Class to access to SUPERGLOBAL arrays for the HTTP request like $_POST, $_FILES, You must use this class to access theese arrays (in this class are implemented only $_POST and $_FILES) 
 */
class UHTTPMethods{

    /**
     * can access to $_POST superglobal
     */
    public static function post($param){
        return $_POST[$param];
    }

    /**
     * can access to $_FILES superglobal
     */
    public static function files(...$param){
        if (count($param)  == 1) return $_FILES[$param[0]];
        else if (count($param) == 2) return $_FILES[$param[0]][$param[1]];
        else if (count($param) == 3) return $_FILES[$param[0]][$param[1]][$param[2]];
        else if (count($param) == 4) return $_FILES[$param[0]][$param[1]][$param[2]][$param[3]];
        else return $_FILES[$param[0]][$param[1]][$param[2]][$param[3]][$param[4]];
    }
}