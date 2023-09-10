<?php
require_once "autoload.php";
require_once "StartSmarty.php";

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);