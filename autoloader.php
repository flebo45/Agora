<?php
spl_autoload_register(function ($className) {
    // Define the base directory where your packages are located
    $baseDir = __DIR__ ;

    // Map the package names to their corresponding directories
    $packageDirs = [
        'Control' => 'Control/',
        'Foundation' => 'Foundation/',
        'Entity' => 'Entity/',
        'View' => 'View/',
        'config'=>'config/'
    ];

    // Iterate through the package directories to find the class file
    foreach ($packageDirs as $packageName => $packageDir) {
        $classFile = $baseDir . $packageDir . $className . '.php';
        if (file_exists($classFile)) {
            require_once $classFile;
            return;
        }
    }
});