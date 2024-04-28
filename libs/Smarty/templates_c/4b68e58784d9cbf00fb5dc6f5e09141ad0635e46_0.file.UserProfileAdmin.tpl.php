<?php
/* Smarty version 3.1.33, created on 2024-04-28 11:30:09
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\UserProfileAdmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_662e1721a3f831_67558596',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b68e58784d9cbf00fb5dc6f5e09141ad0635e46' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\UserProfileAdmin.tpl',
      1 => 1713090805,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662e1721a3f831_67558596 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <title>Agorà-<?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/Smarty/immagini/A.png">
    <?php echo '<script'; ?>
 src="/Agora/Smarty/js/test.js"><?php echo '</script'; ?>
>
    <!-- stylesheet -->
    
        <link rel="stylesheet" href="/Agora/Smarty/css/normalize.css">
        <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
    
    <?php echo '<script'; ?>
>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    <?php echo '</script'; ?>
>
    <nav>
        <div class="container">
            <h2>Agorà</h2>
            <h2><?php echo $_smarty_tpl->tpl_vars['modUsername']->value;?>
</h2>
            <form  action="/Agora/Moderator/reportList" method="post">
                <div>
                    <button class="btn btn-primary" type="submit">Go Back</button>
                </div>
            </form>
            <div class="profile-photo">
                <img src="/Agora/Smarty/immagini/2.png" alt="">
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 6rem" >

        <!-----------------------right-------------------->
        <div class="right" style="margin-top: 4rem">
            <div class="side-profile">
                <div class="heading">
                    <?php if ($_smarty_tpl->tpl_vars['userPic']->value->getSize() > 0) {?>
                        <div class="profile-photo">
                            <img src="data:<?php echo $_smarty_tpl->tpl_vars['userPic']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['userPic']->value->getEncodedData();?>
" alt="Img">
                        </div>
                    <?php } else { ?>
                        <div class="profile-photo">
                            <img src="/Agora/Smarty/immagini/1.png" alt="">
                        </div>
                    <?php }?>
                    <div class ="handle">
                        <h4> <?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
 </h4>
                        <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>
</p>
                    </div>
                    <div>
                        <a style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['follower']->value;?>
</a>
                        <p class="text-muted">
                            followers
                        </p>
                    </div>
                    <div>
                        <a style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['followed']->value;?>
</a>
                        <p class="text-muted">following</p>
                    </div>
                </div>
                <form id='ban' action="/Agora/Moderator/banUser/<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
" method="post">
                    <button class="btn-primary btn">Ban</button>
                </form>
                <!----------------------DESCRIPTION-------------------->
                <div class="title">
                    <h6>About me</h6>
                </div>

                <div class="bio">
                    <i class="uil uil-chat-bubble-user"></i>
                    <div class="bio-body">
                        <h5 class="text-bold">Bio</h5>
                        <div class="text-muted">
                            <h5><?php echo $_smarty_tpl->tpl_vars['user']->value->getBio();?>
</h5>
                        </div>
                    </div>
                </div>

                <div class="bio">
                    <i class="uil uil-moneybag"></i>
                    <div class="bio-body">
                        <h5 class="tex-bold">Working </h5>
                        <div class="text-muted">
                            <h5><?php echo $_smarty_tpl->tpl_vars['user']->value->getWorking();?>
</h5>
                        </div>
                    </div>
                </div>

                <div class="bio">
                    <i class="uil uil-graduation-cap"></i>
                    <div class="bio-body">
                        <h5 class="tex-bold">Studied at</h5>
                        <div class="text-muted">
                            <h5><?php echo $_smarty_tpl->tpl_vars['user']->value->getStudiedAt();?>
</h5>
                        </div>
                    </div>
                </div>

                <div class="bio">
                    <i class="uil uil-hourglass"></i>
                    <div class="bio-body">
                        <h5 class="tex-bold">Hobby</h5>
                        <div class="text-muted">
                            <h5><?php echo $_smarty_tpl->tpl_vars['user']->value->getHobby();?>
</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="middle">
            <!----------------FEEDS-------------------------------->
            <div class="feeds" style='width:50%; margin-left:25rem'>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayPostUser']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="/Agora/Smarty/immagini/1.png" alt="">
                                </div>
                                <div class="ingo">
                                    <div>
                                        <a style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getTitle();?>
</a>
                                    </div>
                                    <small><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getTime()->format('Y-m-d H:i:s');?>
</small>
                                </div>
                            </div>
                            <div style="background: linear-gradient(45deg, violet, indigo, blue, green, yellow, orange, red);-webkit-background-clip: text;background-clip: text;color: transparent;font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getCategory();?>
</div>
                        </div>
                        <div class="caption ">
                            <!-- Smarty tag for username -->
                            <p><b><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
</b><span class="harsh-tag">
                        <?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getDescription();?>
</span></p>
                        </div>
                        <?php if (count($_smarty_tpl->tpl_vars['post']->value[0]->getImages()) === 0) {?>

                        <?php } else { ?>
                            <div class="photo">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['post']->value[0]->getImages(), 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                                    <img src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
" alt="Img">

                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </div>
                        <?php }?>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <!----------------END OF FEED------------------------------>
            </div>
            <!----------------END OF FEEDS------------------------------>
        </div>
    </div><?php }
}
