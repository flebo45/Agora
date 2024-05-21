<?php
/* Smarty version 3.1.33, created on 2024-05-20 16:37:06
  from 'C:\xampp\htdocs\Agora\libs\Smarty\srcORM\templates\search_result.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_664b6012074215_72438188',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c0b58d1b2b555eb1c165d56c3dd46c3cf337528' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\srcORM\\templates\\search_result.tpl',
      1 => 1716213124,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_664b6012074215_72438188 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>Agorà</title>
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
    <a href="/Agora/User/home" class="log" style="text-decoration: none; color: inherit; font-size: 1.5rem; font-weight : bold" >Agorà</a>
    <div class="search-bar">
    <form id='search' action="/Agora/Search/search" method="post">
    <i class ="uil uil-search"></i>
    <label>
        <input type ="search" name="keyword" placeholder="search for post or users">
    </label>
    </form>
    </div>
    <form  action="/Agora/User/logout" method="post">
      <div>
        <button class="btn btn-primary" type="submit">Log out</button>
      </div>
    </form>
    <div class="profile-photo">
      <img src="/Agora/libs/Smarty/immagini/A.png" alt="">
    </div>
  </div>
</nav>


<!------------------------------------------------------
                  RESULT FOR SEARCH
----------------------------------------------------->
<main>

  <div class="result">
    <h3 class="text-muted">Result for : <?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
</h3>
  </div>
  <div class="result" style="margin-top: 2%">
  <h3>Posts:</h3>
  <?php if (count($_smarty_tpl->tpl_vars['searchedPost']->value) === 0) {?>
    <div class="result" style="margin-top: 2%">There are no post with this title, try something else</div>
    <?php } else { ?>
    <div class="left">
    
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['searchedPost']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
      <div style="padding:1.5rem">
      <div class="profile">
        <?php if ($_smarty_tpl->tpl_vars['post']->value[1]->getSize() > 0) {?>
          <div class="profile-photo">
            <img src="data:<?php echo $_smarty_tpl->tpl_vars['post']->value[1]->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['post']->value[1]->getEncodedData();?>
" alt="Img">
          </div>
        <?php } else { ?>
          <div class="profile-photo">
            <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
          </div>
        <?php }?>
        <div class ="handle">
        <?php if ($_smarty_tpl->tpl_vars['post']->value[0]->getUser()->isVip()) {?>
          <a  href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
" class="vip"> <?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
</a> <i class='uil uil-star vip'></i>
        <?php } else { ?>
          <a  href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
</a>
        <?php }?>
          <p class="text-muted">
            @<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getuser()->getName();?>

          </p>
        </div>
      </div>
      <div>
      <h5 class="text-muted">Title:</h5>
        <a href="/Agora/Post/visit/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getId();?>
" class="search" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> <?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getTitle();?>
</a>
          </div>
        
    </div>
    
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <?php }?>
    <h3>User: </h3>
    <?php if (count($_smarty_tpl->tpl_vars['searchedUser']->value) === 0) {?>
      <div class="result" style="margin-top: 2%">There are no user with this username, try something else</div>
    <?php } else { ?>
      <div class="right">
      
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['searchedUser']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
    <div style="padding:1rem">  
      <div class="list-profile">
          
        <div class="profile">
            <?php if ($_smarty_tpl->tpl_vars['user']->value[1]->getSize() > 0) {?>
              <div class="profile-photo">
                <img src="data:<?php echo $_smarty_tpl->tpl_vars['user']->value[1]->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['user']->value[1]->getEncodedData();?>
" alt="Img">
              </div>
            <?php } else { ?>
              <div class="profile-photo">
                <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
              </div>
            <?php }?>
            <div class ="handle">
            <?php if ($_smarty_tpl->tpl_vars['user']->value[0]->isVip()) {?>
              <a  href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value[0]->getUsername();?>
" class="vip"> <?php echo $_smarty_tpl->tpl_vars['user']->value[0]->getUsername();?>
</a> <i class='uil uil-star vip'></i>
          <?php } else { ?>
              <a  href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value[0]->getUsername();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['user']->value[0]->getUsername();?>
</a>
          <?php }?>
              <p class="text-muted">
                @<?php echo $_smarty_tpl->tpl_vars['user']->value[0]->getName();?>

              </p>
            </div>
          </div>
      </div>  
      </div>
      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </div>
      <?php }?>
  

  </div>

  
    <!----------------- THEME CUSTOMIZATION---------------------------->

    <div class="customize-theme">
        <div class="card">
            <h2>Customize your view</h2>
            <p class="text-muted">Manage your font size, color and background.</p>
            <!-------------------------FONT SIZE----------------------------->
            <div class="font-size">
                <h2>Font size</h2>
                <div>
                    <h6>Aa</h6>
                    <div class="choose-size">
                        <span class="font-size-1"></span>
                        <span class="font-size-2"></span>
                        <span class="font-size-3 active"></span>
                        <span class="font-size-4"></span>
                        <span class="font-size-5"></span>
                    </div>
                    <h3>Aa</h3>
                </div>
            </div>


            <!-----------------------PRIMARY COLORS------------------------>
            <div class="color">
                <h4>Color</h4>
                <div class="choose-color">
                    <span class="color-1 active"></span>
                    <span class="color-2"></span>
                    <span class="color-3"></span>
                    <span class="color-4"></span>
                    <span class="color-5"></span>
                </div>
            </div>

            <!----------------------------BACKGROUND COLORS----------------------->
            <div class="background">
                <h4>Background</h4>
                <div class="choose-bg">
                    <div class="bg-1 active">
                        <span></span>
                        <h5>Light</h5>
                    </div>
                    <div class="bg-2">
                        <span></span>
                        <h5>Dim</h5>
                    </div>
                    <div class="bg-3">
                        <span></span>
                        <h5> Lights Out</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php }
}
