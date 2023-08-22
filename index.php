<?php
require_once "bootstrap.php";
require_once "autoloader.php";
require_once "StartSmarty.php";
$fc = new CFrontController();
print_r($_SERVER['REQUEST_URI']);
$fc->run($_SERVER['REQUEST_URI']);