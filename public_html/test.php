<?php
require_once "../bootstrap.php";
require_once "../autoloader.php";

$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

// Test the isLogged() method

// Simulate a logged-in user
USession::setSessionElement('user', 'some_user_id');
if (CUser::isLogged()) {
    echo "User is logged in.\n";
} else {
    echo "User is not logged in.\n";
}

// Simulate a user not logged in
USession::unsetSessionElement('user');
if (CUser::isLogged()) {
    echo "User is logged in.\n";
} else {
    echo "User is not logged in.\n";
}
?>
