<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'\Agora\Entity\EPost.php');
require_once(__ROOT__.'\Agora\Control\CManagePost.php');

$CMP = new CManagePost();

var_dump($CMP->newSketch());

?>