<?php

require_once(__DIR__ . '/../../config/config.php');
/**
 * calass for checking if the db exist and if not create it
 */
class Installation{
    public static function install(){
        try{
            $conn =  new PDO("mysql:host=".DB_HOST."; charset=utf8;", DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'");
            if($stmt->rowCount() == 0){
                // Database does not exist, create it
                
                $sql = "CREATE DATABASE " . DB_NAME;
                $conn->exec($sql);
                $conn->exec("USE " . DB_NAME);
                $sqlFile = __DIR__ . '/agora.sql';
                if (!file_exists($sqlFile)) {
                    throw new Exception("SQL file not found: " . $sqlFile);
                }
                $sql = file_get_contents($sqlFile);
                $conn->exec($sql);
            }
            $conn = null;
            return true;
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }
}