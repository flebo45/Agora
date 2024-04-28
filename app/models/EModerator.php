<?php
require_once("EPerson.php");

class EModerator extends EPerson{

    public $discr = "moderator";

    private static string $entity = EModerator::class;

    public static function getEntity(): string
    {
        return self::$entity;
    }
 }