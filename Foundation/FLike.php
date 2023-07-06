<?php

class FLike extends FEntityManager{

    private $table_name = "elike";

    private $table_field = "id";

     # methods

     public static function getTable(){

        return self::$table_name;
    }

    public static function getField(){

        return self::$table_field;
    }
}