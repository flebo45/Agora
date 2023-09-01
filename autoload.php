<?php

function my_autoloader($className) {

        $firstLetter = $className[0];
        switch ($firstLetter) {
            case 'E':
                include_once(__DIR__ . '/Entity/'. $className . '.php' );
                break;

            case 'F':
                include_once(__DIR__ . "/Foundation/" . $className . '.php' );
                break;

            case 'V':
                include_once(__DIR__ . '/View/'. $className . '.php' );
                break;

            case 'C':
                include_once(__DIR__ . '/Controller/'. $className . '.php' );
                break;

            case 'U':
                include_once (__DIR__ . '/Utility/'. $className. '.php');
                break;

    }
}

spl_autoload_register('my_autoloader');