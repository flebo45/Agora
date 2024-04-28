<?php
/* Smarty version 3.1.33, created on 2024-04-28 11:30:04
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\adminPost.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_662e171c61a1f1_71329220',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d8967702730086fff8b737ed01a71f2a48088db' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\adminPost.tpl',
      1 => 1713090896,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662e171c61a1f1_71329220 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>reportedPost</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/Smarty/immagini/A.png">

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
</head>
<body>
<nav>
    <div class="container">
        <h2>Agorà</h2>
        <h2><?php echo $_smarty_tpl->tpl_vars['modUsername']->value;?>
</h2>
        <div class="profile-photo">
            <img src="/Agora/Smarty/immagini/2.png" alt="">
        </div>
    </div>
</nav>


<!----------------------VISUALIZATION POST FOR ADMIN----------------------------------------------->
<div class="container" style="margin-top:10%">
    <div class="middle">
        <!----------------FEEDS-------------------------------->
        <div class="feeds">
            <div class="feed">
                <div class="head">
                    <div class="user">
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
                        <div class="ingo">
                            <div>
                                <a  style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value->getTitle();?>
</a>
                            </div>
                            <small><?php echo $_smarty_tpl->tpl_vars['post']->value->getTime()->format('Y-m-d H:i:s');?>
</small>
                        </div>
                    </div>
                </div>
                <div class="caption ">
                    <!-- Smarty tag for username -->
                    <p><a href="/Agora/Moderator/visitUser/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getId();?>
"style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
</a><span class="harsh-tag">
            <?php echo $_smarty_tpl->tpl_vars['post']->value->getDescription();?>
</span></p>
                </div>
                <?php if (count($_smarty_tpl->tpl_vars['post']->value->getImages()) === 0) {?>

                <?php } else { ?>
                    <div class="photo">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['post']->value->getImages(), 'i');
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
        </div>

        <div>
            <form id='ban' action="/Agora/Moderator/banPost/<?php echo $_smarty_tpl->tpl_vars['post']->value->getId();?>
/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getId();?>
" method="post">
                <button class="btn btn-primary "><i class="uil uil-trash-alt">Ban</i></button>
            </form>
        </div>
        <div style="margin-top:10px">
            <label >
                <button class="btn btn-primary " onclick='location.href="/Agora/Moderator/reportList"'><i class="uil">Go Back</i></button>
            </label>
        </div>

    </div>
</div><?php }
}
