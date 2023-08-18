<?php

// include the composer autoloader for autoloading packages
require_once(__DIR__ . '\vendor\autoload.php');
require_once(__DIR__ . '\config\config.php');

// set up an autoloader for loading classes that aren't in /vendor
// $classDirs is an array of all folders to load from
$classDirs = array(
    __DIR__,
    __DIR__ . '\Entity',
    __DIR__ . '\Foundation',
    __DIR__ . '\Control',
    __DIR__ . '\View',
    __DIR__ . '\Utility'
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
            'host' => DB_HOST,
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'password' => DB_PASS
        );

        $entityManager = \Doctrine\ORM\EntityManager::create($connectionParams, $config);
    }

    return $entityManager;
}
