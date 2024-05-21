<?php
/* Smarty version 3.1.33, created on 2024-05-21 10:31:32
  from 'C:\xampp\htdocs\Agora\libs\Smarty\srcORM\templates\userlist.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_664c5be4948c30_94171822',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '562075928445e1b80401035a909a0612cbe106aa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\srcORM\\templates\\userlist.tpl',
      1 => 1716213218,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_664c5be4948c30_94171822 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <title>home</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">
    <?php echo '<script'; ?>
 src="/Agora/libs/Smarty/js/test.js"><?php echo '</script'; ?>
>
    <!-- stylesheet -->
    
        <link rel="stylesheet" href="/Agora/libs/Smarty/css/normalize.css">
        <link rel="stylesheet" href="/Agora/libs/Smarty/css/style.css">
    
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
        <h2 class="log">
            Agorà
        </h2>
        <div class="search-bar">
            <i class ="uil uil-search"></i>
            <label>
                <input type ="search" placeholder="search for post or users">
            </label>
        </div>
        <form  action="/Agora/User/logout" method="post">
            <div>
                <button class="btn btn-primary" type="submit">Log out</button>
            </div>
        </form>
        <div class="profile-photo">
            <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
        </div>
    </div>
</nav>


<main>
    <div class="container">
        <!-----------------------left-------------------->
        <div class="left">

            <div class="sidebar">
                <label class="menu-items tex-bold">
                    <button class="btn-transparent" onclick="location.href='/Agora/User/home'"> <i class="uil uil-home"></i></button> Home
                </label>
                <label class="menu-items tex-bold">
                    <button class="btn-transparent" onclick="location.href='/Agora/User/explore'"> <i class="uil uil-compass"></i></button> Explore
                </label>

                <label class="menu-items tex-bold">
                    <button class="btn-transparent" onclick="location.href='/Agora/User/personalProfile'"> <i class="uil uil-user-circle"></i></button>Profile

                </label>
                <label class="tex-bold theme-cust"  id="theme">
                    <span> <i class="uil uil-palette"></i></span>Theme
                </label>
                <label class="menu-items tex-bold " >
                    <button class="btn-transparent" onclick="location.href='/Agora/User/settings'"><i class="uil uil-setting"></i> </button>Setting
                </label>
            </div>
            <!--------------------END OF SIDE BAR----------------->
        </div>


        <div class="middle">
            <div class="feeds">
                <div class ="feed">
            <?php if (count($_smarty_tpl->tpl_vars['userList']->value) == 0) {?>
                <?php if ($_smarty_tpl->tpl_vars['param']->value == 'like') {?>
                    <div class="tex-bold" style="font-size:18px">This post has 0 like for now</div>
                <?php } elseif ($_smarty_tpl->tpl_vars['param']->value == 'followed') {?>
                    <div class="tex-bold" style="font-size:18px">No one is following this user</div>
                <?php } elseif ($_smarty_tpl->tpl_vars['param']->value == 'followers') {?>
                    <div class="tex-bold" style="font-size:18px">This user is not following anyone</div>
                <?php }?>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['param']->value == 'like') {?>
                    <div class="tex-bold" style="font-size:18px">This Post is liked by:</div>
                <?php } elseif ($_smarty_tpl->tpl_vars['param']->value == 'followers') {?>
                    <div class="tex-bold" style="font-size:18px">This User is following:</div>
                <?php } elseif ($_smarty_tpl->tpl_vars['param']->value == 'followed') {?>
                    <div class="tex-bold" style="font-size:18px">This User is followed by:</div>
                <?php }?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['userList']->value, 'l');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value) {
?>
                    
                    <div style="display: flex; align-items: center; font-size:18px; margin-top:1rem">
                        <?php if ($_smarty_tpl->tpl_vars['l']->value[1]->getSize() > 0) {?>
                            <div class="profile-photo">
                                <img src="data:<?php echo $_smarty_tpl->tpl_vars['l']->value[1]->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['l']->value[1]->getEncodedData();?>
" alt="Img">
                            </div>
                        <?php } else { ?>
                            <div class="profile-photo">
                                <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                            </div>
                        <?php }?>
                        
                        <?php if ($_smarty_tpl->tpl_vars['param']->value == 'like') {?>
                            <?php if ($_smarty_tpl->tpl_vars['l']->value[0]->isVip()) {?>
                                <i class="uil uil-heart" style="color:red; margin-left:1rem"></i><a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
" class="vip"><?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
</a>
                            <?php } else { ?>
                            <i class="uil uil-heart" style="color:red; margin-left:1rem"></i> <a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
" class="tex-bold" style="text-decoration: none; color: inherit"><?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
</a>
                            <?php }?>
                            <p class="text-muted left-transition"> <?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getName();?>
</p>
                        <?php } else { ?>
                            <?php if ($_smarty_tpl->tpl_vars['l']->value[0]->isVip()) {?>
                                <i class='uil uil-star' class="vip"></i> <a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
" class="vip"><?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
</a>
                            <?php } else { ?>
                                <i class="uil uil-chat-bubble-user" style="color:red; margin-left:1rem"></i> <a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
" class="tex-bold" style="text-decoration: none; color: inherit"><?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getUsername();?>
</a>
                            <?php }?>
                            <p class="text-muted left-transition"> <?php echo $_smarty_tpl->tpl_vars['l']->value[0]->getName();?>
</p>
                        <?php }?>
                        
                    </div>

                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
                </div>
            </div>
            <button class="btn-primary btn"  onclick="history.back()">Go Back</button>
    </div>
</main>
<?php echo '<script'; ?>
 src="/Agora/libs/Smarty/js/sidebar2.js"><?php echo '</script'; ?>
><?php }
}
