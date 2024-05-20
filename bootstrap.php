<?php

// include the composer autoloader for autoloading packages
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/app/config/config.php');

// set up an autoloader for loading classes that aren't in /vendor
// $classDirs is an array of all folders to load from
/*$classDirs = array(
    __DIR__,
    __DIR__ . './Entity',
);*/

function getEntityManager() : \Doctrine\ORM\EntityManager
{
    $entityManager = null;

    if ($entityManager === null)
    {
        $paths = array(__DIR__ . DIRECTORY_SEPARATOR . "Entity");
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths);
        $config->setAutoGenerateProxyClasses(true);

        # set up configuration parameters for doctrine.
        # Make sure you have installed the php7.0-sqlite package.
        $connectionParams = array(
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'password' => DB_PASS,
            'host' => DB_HOST,
            'driver' => 'pdo_mysql',
        );

        $entityManager = \Doctrine\ORM\EntityManager::create($connectionParams, $config);
    }

    return $entityManager;
}