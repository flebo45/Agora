<?php
require_once __DIR__ . "/app/config/autoloader.php";
require_once __DIR__ . "/app/install/StartSmarty.php";
require_once __DIR__ . "/app/install/Installation.php";

Installation::install();

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);