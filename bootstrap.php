<?php

// include the composer autoloader for autoloading packages
require_once(__DIR__ . '\vendor\autoload.php');

// set up an autoloader for loading classes that aren't in /vendor
// $classDirs is an array of all folders to load from
$classDirs = array(
    __DIR__,
    __DIR__ . '\Entity',
);

new \iRAP\Autoloader\Autoloader($classDirs);

function getEntityManager() : \Doctrine\ORM\EntityManager
{
    $entityManager = null;

    if ($entityManager === null)
    {
        $paths = array(__DIR__ . '\Entity');
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths);

        # set up configuration parameters for doctrine.
        # Make sure you have installed the php7.0-sqlite package.
        $connectionParams = array(
            'driver' => 'pdo_mysql',
            'host' => '127.0.0.1',
            'dbname' => 'provaorm',
            'user' => 'root',
            'password' => 'pippo'
        );

        $entityManager = \Doctrine\ORM\EntityManager::create($connectionParams, $config);
    }

    return $entityManager;
}
