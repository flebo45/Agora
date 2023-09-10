<?php
require_once "bootstrap.php";
require_once "autoload.php";
$em = getEntityManager();

$fem = FEntityManager::getInstance($em);

$pm = FPersistentManager::getInstance();

$idLogged = 1;
$loggedUser  = $pm::retriveObj(EUser::getEntity(), $idLogged);
$loggedPic = $pm::retriveObj(EImage::getEntity(), $loggedUser->getIdImage());

$postInHome = $pm::loadHomePage($loggedUser->getId());

 //load the VIP Users and their profile Images
 $vipUsers = $pm::loadVip();
 $vipPic = array();
 $vipFollower = array();
 

 foreach($vipUsers as $v)
 {
     //associative array for the Vip's images
     $vipPic[$v->getId()] = $pm::retriveObj(EImage::getEntity(), $v->getIdImage());
     //associative array for Vip's followers number
     $vipFollower[$v->getId()] = $pm::getFollowerNumb($v->getId());
 }

//User information
echo 'User Id: ' . $loggedUser->getId()."\n";
echo 'User Username: '. $loggedUser->getUsername()."\n";
echo 'User Name: '. $loggedUser->getName()."\n";

//profile pic infromation
echo 'UserPic size: '. $loggedPic->getSize()."\n";
echo 'UserPic type: '. $loggedPic->getType()."\n";



foreach($postInHome as $p)
{
    //post information
    echo 'Post Id: ' . $p->getId()."\n";
    echo 'Post Title: ' . $p->getTitle()."\n";
    echo 'Post Description: ' . $p->getDescription()."\n";
    echo 'Post Category: ' . $p->getCategory()."\n";
    echo 'Post Time: ' . $p->getTime()->format('Y-m-d H:i:s')."\n";

    //creator information
    echo 'Creator Id: '. $p->getUser()->getId()."\n";
    echo 'Creator Username: '. $p->getUser()->getUsername()."\n";
    echo 'Creator Name: '. $p->getUser()->getName()."\n";
}

//vip information
foreach($vipUsers as $v)
{
    //VIP information
    echo 'Vip Id: ' . $v->getId()."\n";
    echo 'Vip Username: '. $v->getUsername()."\n";
    echo 'Vip Name: '. $v->getName()."\n";
    echo 'Vip Followers: '. $vipFollower[$v->getId()]."\n";

    //VIP pic information
    echo 'VipPic size: '. $vipPic[$v->getId()]->getSize()."\n";
    echo 'VipPic type: '. $vipPic[$v->getId()]->getType()."\n";
}

