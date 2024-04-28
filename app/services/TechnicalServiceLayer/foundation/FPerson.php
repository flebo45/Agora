<?php

class FPerson{

    private static $table = "person";

    private static $value = "(NULL,:name,:surname,:year,:email,:password,:username,:discr)";

    private static $key = "idUser";

    public static function getTable(){
        return self::$table;
    }

    public static function getValue(){
        return self::$value;
    }

    public static function getClass(){
        return self::class;
    }

    public static function getKey(){
        return self::$key;
    }

    public static function bind($stmt, $user){
        $stmt->bindValue(":name", $user->getName(), PDO::PARAM_STR);
        $stmt->bindValue(":surname", $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindValue(":year", $user->getYear(), PDO::PARAM_INT);
        $stmt->bindValue(":email", $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(":password", $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(":username", $user->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(":discr", $user->discr, PDO::PARAM_STR);
    }

    public static function verify($field, $id){
        $queryResult = FEntityManagerSQL::getInstance()->retriveObj(self::getTable(), $field, $id);

        return FEntityManagerSQL::getInstance()->existInDb($queryResult);
    }
}