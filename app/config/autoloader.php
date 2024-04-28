<?php

/**
 * Autoload
 * This function take the class name, every class should have the initial of the package,
 * for ex. if there is a class called User in the Entity Package the class must be renamed in EUser.php,
 * and read the first letter, for each letter there is a specific folder like Entity 
 */
function my_autoloader($className) {

        $firstLetter = $className[0];
        switch ($firstLetter) {
            case 'E':
                include_once(__DIR__ . '/../models/'. $className . '.php' );
                break;

            case 'F':
                include_once(__DIR__ . "/../services/TechnicalServiceLayer/foundation/" . $className . '.php' );
                break;

            case 'V':
                include_once(__DIR__ . '/../views/'. $className . '.php' );
                break;

            case 'C':
                include_once(__DIR__ . '/../controllers/'. $className . '.php' );
                break;

            case 'U':
                include_once (__DIR__ . '/../services/TechnicalServiceLayer/utility/'. $className. '.php');
                break;

    }
}

spl_autoload_register('my_autoloader');