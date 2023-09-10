<?php

// include the composer autoloader for autoloading packages
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/config/config.php');

// set up an autoloader for loading classes that aren't in /vendor
// $classDirs is an array of all folders to load from
/*$classDirs = array(
    __DIR__,
    __DIR__ . './Entity',
);*/
// Parse the JawsDB URL



function getEntityManager() : \Doctrine\ORM\EntityManager
{
    $dbUrl = getenv('JAWSDB_URL') ?: getenv('JAWSDB_MARIA_URL');
    $url = parse_url($dbUrl);
    $entityManager = null;

    if ($entityManager === null)
    {
        $paths = array(__DIR__ );
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration($paths);
        $config->setAutoGenerateProxyClasses(true);

        # set up configuration parameters for doctrine.
        # Make sure you have installed the php7.0-sqlite package.
        $connectionParams = array(
            'dbname' => substr($url['path'], 1),
            'user' => $url['user'],
            'password' => $url['pass'],
            'host' => $url['host'],
            'port' => $url['port'],
            'driver' => 'pdo_mysql',
        );

        $entityManager = \Doctrine\ORM\EntityManager::create($connectionParams, $config);
    }

    return $entityManager;
}