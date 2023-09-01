<?php
use Doctrine\ORM\Mapping as ORM;
require_once('EPerson.php');
/**
 * @ORM\Entity 
 * @ORM\Table(name="moderator")
 */

 class EModerator extends EPerson{

    public $discr = "moderator";

    private static string $entity = EModerator::class;

    private static string $alias= 'moderator';


    public static function getEntity(): string
    {
        return self::$entity;
    }

    public static function getAlias(): string
    {
        return self::$alias;
    }

 }