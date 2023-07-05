<?php

class FLike{

    private $table_name = "flike";

    private $table_field = "id";

     # methods

     public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }

    public static function createLikeInDB(){

        
    }

}