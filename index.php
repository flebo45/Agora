<?php
require_once "bootstrap.php";
require_once "autoloader.php";
require_once "StartSmarty.php";
$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);