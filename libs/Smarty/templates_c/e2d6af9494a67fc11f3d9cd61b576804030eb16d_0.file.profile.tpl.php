<?php
/* Smarty version 3.1.33, created on 2024-04-28 11:25:11
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\profile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_662e15f7962888_35689195',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2d6af9494a67fc11f3d9cd61b576804030eb16d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\profile.tpl',
      1 => 1713037680,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662e15f7962888_35689195 (Smarty_Internal_Template $_smarty_tpl) {
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
</head>
<body>
  <nav>
    <div class="container">
      <h2 class="log">Agorà</h2>
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
        <img src="/Agora/Smarty/immagini/2.png" alt="">
      </div>
    </div>
  </nav>
<!-----------------------MAIN-------------------->
<main>
<div class="container_pr">
    <div class="container">
        <!-----------------------left-------------------->
        <div class="left">
            <a class="profile">
            <?php if ($_smarty_tpl->tpl_vars['personalPic']->value->getSize() > 0) {?>
              <div class="profile-photo">  
                  <img src="data:<?php echo $_smarty_tpl->tpl_vars['personalPic']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['personalPic']->value->getEncodedData();?>
" alt="Img">
              </div>
            <?php } else { ?>
              <div class="profile-photo">
                  <img src="/Agora/Smarty/immagini/1.png" alt="">
              </div>
            <?php }?>
                <div class ="handle">
                <?php if ($_smarty_tpl->tpl_vars['personalUser']->value->isVip()) {?>
                  <h4 class='vip'> <?php echo $_smarty_tpl->tpl_vars['personalUser']->value->getUsername();?>
 <i class='uil uil-star'></i> </h4>
                <?php } else { ?>
                  <h4> <?php echo $_smarty_tpl->tpl_vars['personalUser']->value->getUsername();?>
</h4>
                <?php }?>
                    <p class="text-muted">@<?php echo $_smarty_tpl->tpl_vars['personalUser']->value->getName();?>

                    </p>
                </div>
            </a>
            <!-----------------------SIDE BAR-------------------->
            <div class="sidebar">
              <label class="menu-items tex-bold">
                <button class="btn-transparent" onclick="location.href='/Agora/User/home'"> <i class="uil uil-home"></i></button>Home
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
              <label class="menu-items tex-bold" >
                <button class="btn-transparent" onclick="location.href='/Agora/User/settings'">  <i class="uil uil-setting"></i></button>Setting
              </label>
      </div>
      <!--------------------END OF SIDE BAR----------------->
      <label class="btn btn-primary">create post
        <button class="btn-transparent" onclick="location.href='/Agora/Post/postForm'"></button>
      </label>
    </div>


  <!-----------------------END OF LEFT-------------------->


    <!-----------------------middle-------------------->
    <div class="middle">
      <!----------------FEEDS-------------------------------->
      <div class="feeds">
                <?php if ($_smarty_tpl->tpl_vars['user']->value->isBanned()) {?>
                  <div class="tex-bold feed" style="font-size:18px; color:red">This User is Banned!</div>
                <?php } else { ?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['postList']->value, 'post');
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
                          <a href="/Agora/Post/visit/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getId();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getTitle();?>
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

                    <div class="action-buttons">
                        <div class="interaction-buttons">
                          <a href="/Agora/Post/visit/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getId();?>
" style="text-decoration: none; color: inherit; "><i class="uil uil-comment-dots"></i></a>
                        </div>
                    </div>

                    <div class="liked-by"> <!--FARE QUERY PER PRENDERE L'IMM PROFILO DEGLI  ULTIMI 3 UTENTI CHE HANNO MESSO MI PIACE -->
                        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);
$_smarty_tpl->tpl_vars['i']->value = 0;
if ($_smarty_tpl->tpl_vars['i']->value < 3) {
for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value < 3; $_smarty_tpl->tpl_vars['i']->value++) {
?>
                        <span><img src="/Agora/Smarty/immagini/A.png" alt=""></span>
                        <?php }
}
?>
                        <!-- Smarty tag for username -->
                        <p> liked by <a href="/Agora/Post/like/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getId();?>
" style="text-decoration: none; color: inherit; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value[1];?>
 user</a></p>
                    </div>

                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <?php }?>
                <!----------------END OF FEED------------------------------>
            </div>
            <!----------------END OF FEEDS------------------------------>
        </div>

    <!-----------------------END OF MIDDLE---------------------------->



    <!-----------------------right-------------------->
  <div class="right">
  <?php if ($_smarty_tpl->tpl_vars['user']->value->isBanned()) {?>
  <?php } else { ?>
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
          <?php if ($_smarty_tpl->tpl_vars['user']->value->isVip()) {?>
            <h4 class='vip'> <?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
 <i class='uil uil-star' style="font-size:medium"></i> </h4>
          <?php } else { ?>
            <h4> <?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</h4>
          <?php }?>
            <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>
</p>
          </div>
          <div>
              <a href="/Agora/User/followed/<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['followerNumb']->value;?>
</a>
                  <p class="text-muted">
                      followers
                  </p>
              </div>
              <div>
              <a href="/Agora/User/followers/<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['followedNumb']->value;?>
</a>
                  <p class="text-muted">following</p>
              </div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['follow']->value == true) {?>
          <form id='unfollow' action="/Agora/User/unfollow/<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
" method="post">
            <button class="btn-primary btn">Unfollow</button>
          </form>
        <?php } elseif ($_smarty_tpl->tpl_vars['follow']->value == false) {?>
          <form id='follow' action="/Agora/User/follow/<?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
" method="post">
            <button class="btn-primary btn">Follow</button>
          </form>
        <?php }?>
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
      
      <!----------------------END OF DESCRIPTION--------------------->
  
      </div>
    <?php }?>
  </div>
 </div>
</main>

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
  <?php echo '<script'; ?>
 src="/Agora/Smarty/js/sidebar2.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
