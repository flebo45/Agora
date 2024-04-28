<?php
/* Smarty version 3.1.33, created on 2024-04-27 18:50:32
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\visualization_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_662d2cd8adec34_94895595',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b413f66dd7d1fdbc7794172b2ea95f486a55fa01' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\visualization_post.tpl',
      1 => 1713290319,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662d2cd8adec34_94895595 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('userlogged', (($tmp = @$_smarty_tpl->tpl_vars['userlogged']->value)===null||$tmp==='' ? 'nouser' : $tmp));?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <title>home</title>
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
    <h2 class="log">
      Agorà
    </h2>
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

<main>
<div class="container_vi">
  <div class="container">
    <!-----------------------left-------------------->
    <div class="left">
      <a class="profile">
      <?php if ($_smarty_tpl->tpl_vars['user']->value !== null) {?>
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
 <i class='uil uil-star'></i> </h4>
          <?php } else { ?>
            <h4> <?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</h4>
          <?php }?>
            <p class="text-muted">
              @<?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>

            </p>
          </div>
      <?php } else { ?>
        <div class="profile-photo">
              <img src="/Agora/Smarty/immagini/1.png" alt="">
        </div>
        <div class ="handle">
          <h4>Guest User</h4>
          <p class="text-muted">
            Log in
          </p>
        </div>
      <?php }?>
      </a>
      <!-----------------------SIDE BAR-------------------->
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
  <label class="btn btn-primary">create post
      <button class="btn-transparent" onclick="location.href='/Agora/Post/postForm'"></button>
  </label>
</div>


    <!-----------------------END OF LEFT-------------------->


    <!-----------------------middle-------------------->
    <div class="middle">
      <!----------------FEEDS-------------------------------->
      <div class="feeds">
      <?php if ($_smarty_tpl->tpl_vars['post']->value->getUser()->isBanned()) {?>
        <div class="tex-bold feed" style="font-size:18px; color:red">This User is Banned!</div>
      <?php } else { ?>
      <div class="feed">
      <div class="head">
        <div class="user">
          <div class="profile-photo">
              <img src="/Agora/Smarty/immagini/1.png" alt="">
          </div>
          <div class="ingo">
            <div>
              <a href="/Agora/Post/visit/<?php echo $_smarty_tpl->tpl_vars['post']->value->getId();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value->getTitle();?>
</a>
            </div>
            <small><?php echo $_smarty_tpl->tpl_vars['post']->value->getTime()->format('Y-m-d H:i:s');?>
</small>
          </div>
        </div>
          <div style="background: linear-gradient(45deg, violet, indigo, blue, green, yellow, orange, red);-webkit-background-clip: text;background-clip: text;color: transparent;font-weight: bold;"><?php echo $_smarty_tpl->tpl_vars['post']->value->getCategory();?>
</div>
      </div>
        <div class="caption">
            <!-- Smarty tag for username -->
            <p><b><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
</b><span class="harsh-tag">
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
          
        <div class="action-buttons">
        <?php if ($_smarty_tpl->tpl_vars['checkLike']->value == true) {?>
            <div class="interaction-buttons">
                <form id="like" action="/Agora/Post/deleteLike/<?php echo $_smarty_tpl->tpl_vars['post']->value->getId();?>
" method="post">
                    <button class="like-button btn-transparent"  style="color:red; font-size:24px;width:40px;height:40px;padding:5px;"><i class="uil uil-heart"></i> </button>
                </form>
            </div>
        <?php } else { ?>
          <div class="interaction-buttons">
            <form id="like" action="/Agora/Post/settingLike/<?php echo $_smarty_tpl->tpl_vars['post']->value->getId();?>
" method="post">
              <button class="like-button btn-transparent"  style="font-size:24px;width:40px;height:40px;padding:5px;"><i class="uil uil-heart"></i> </button>
            </form>
          </div>
        <?php }?>
            <div class= "interaction-buttons " id="report">
                <button type = "button" class="btn btn-transparent"><i class = "uil uil-exclamation-triangle" > </i> </button>
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
            <p> liked by <a href="/Agora/Post/like/<?php echo $_smarty_tpl->tpl_vars['post']->value->getId();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['numericInfo']->value[0];?>
 user</a> </p>
        </div>

          <div class="comments">
            <div class="head-comment">
              <div class=" action-buttons">
                <span><i class="uil uil-comment-dots"></i></span>
              </div>
              <h3  class="tex-bold">comments</h3>
            </div>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['comments']->value, 'comment');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->value) {
?>
              <div class="comment">
                <div class="head">
                  <div class="user">
                  <?php if ($_smarty_tpl->tpl_vars['comment']->value[1]->getSize() > 0) {?>
                    <div class="profile-photo">  
                        <img src="data:<?php echo $_smarty_tpl->tpl_vars['comment']->value[1]->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['comment']->value[1]->getEncodedData();?>
" alt="Img">
                    </div>
                  <?php } else { ?>
                    <div class="profile-photo">
                        <img src="/Agora/Smarty/immagini/1.png" alt="">
                    </div>
                  <?php }?>
                    <div class="ingo">
                    <?php if ($_smarty_tpl->tpl_vars['comment']->value[0]->getUser()->isVip()) {?>
                      <a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['comment']->value[0]->getUser()->getUsername();?>
"class="vip"> <?php echo $_smarty_tpl->tpl_vars['comment']->value[0]->getUser()->getUsername();?>
<i class='uil uil-star' style='font-size:medium'></i> </a>
                    <?php } else { ?>
                      <a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['comment']->value[0]->getUser()->getUsername();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> <?php echo $_smarty_tpl->tpl_vars['comment']->value[0]->getUser()->getUsername();?>
</a>
                    <?php }?>
                      <small><?php echo $_smarty_tpl->tpl_vars['comment']->value[0]->getTime()->format('Y-m-d H:i:s');?>
</small>
                    </div>
                  </div>

                  <div class="body-comment">
                    <b><?php echo $_smarty_tpl->tpl_vars['comment']->value[0]->getBody();?>
</b>
                  </div>
                </div>
                <form id="report" action="/Agora/Report/reportComment/<?php echo $_smarty_tpl->tpl_vars['comment']->value[0]->getId();?>
" method="post">
                      <button class="btn btn-transparent" id="delete"><i class="uil uil-exclamation-triangle" style="color:red"></i></button>
                </form>
              </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <div class="send-comment">
              <form id="comment-post"  action="/Agora/Comment/createComment/<?php echo $_smarty_tpl->tpl_vars['post']->value->getId();?>
"  method="post">
              <label class="left-transition ">
                <input type="text" name ='body'placeholder="write a comment" required>
              </label>
                <label class="btn btn-primary left-transition">send
                  <button type="submit" class="btn-transparent"></button>
                </label>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!----------------END OF FEEDS------------------------------>
    <!-----------------------END OF MIDDLE---------------------------->


    <!-----------------------right-------------------->
    <div class="right">
      <div class="side-profile">
        <div class="heading">
        <?php if ($_smarty_tpl->tpl_vars['visitedUserPic']->value->getSize() > 0) {?>
          <div class="profile-photo">  
              <img src="data:<?php echo $_smarty_tpl->tpl_vars['visitedUserPic']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['visitedUserPic']->value->getEncodedData();?>
" alt="Img">
          </div>
        <?php } else { ?>
          <div class="profile-photo">
              <img src="/Agora/Smarty/immagini/1.png" alt="">
          </div>
        <?php }?>
          <div class ="handle">
          <?php if ($_smarty_tpl->tpl_vars['post']->value->getUser()->isVip()) {?>
            <a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
" class='vip'> <?php echo $_smarty_tpl->tpl_vars['post']->value->getuser()->getUsername();?>
 <i class='uil uil-star' style='font-size:medium'></i> </a>
          <?php } else { ?>
            <a href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> <?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
 </a>
          <?php }?>
            <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getName();?>
</p>
          </div>
          <div>
            <a href="/Agora/User/followed/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getId();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['numericInfo']->value[1];?>
</a>
            <p class="text-muted">
              followers
            </p>
          </div>
          <div>
          <a href="/Agora/User/followers/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getId();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['numericInfo']->value[2];?>
</a>
            <p class="text-muted">following</p>
          </div>
        </div>
      <?php if ($_smarty_tpl->tpl_vars['user']->value !== null) {?>
        <?php if ($_smarty_tpl->tpl_vars['user']->value->getId() !== $_smarty_tpl->tpl_vars['post']->value->getUser()->getId()) {?>
          <?php if ($_smarty_tpl->tpl_vars['followCheck']->value == true) {?>
            <form id='unfollow' action="/Agora/User/unfollow/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getId();?>
" method="post">
              <button class="btn-primary btn">Unfollow</button>
            </form>
          <?php } elseif ($_smarty_tpl->tpl_vars['followCheck']->value == false) {?>
            <form id='follow' action="/Agora/User/follow/<?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getId();?>
" method="post">
              <button class="btn-primary btn">Follow</button>
            </form>
          <?php }?>
        <?php } else { ?>
        <?php }?>
      <?php } else { ?>
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
              <h5><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getBio();?>
</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-moneybag"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Working </h5>
            <div class="text-muted">
              <h5><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getWorking();?>
</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-graduation-cap"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Studied at</h5>
            <div class="text-muted">
              <h5><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getStudiedAt();?>
</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-hourglass"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Hobby</h5>
            <div class="text-muted">
              <h5><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getHobby();?>
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

<!-----------------REPORT MODAL----------------------------------->


<div class="report">
<div class="card">
    <h2>Report</h2>
    <h3 class="text-muted">Why are you reporting this post?</h3>
    <form id="report"  action="/Agora/Report/reportPost/<?php echo $_smarty_tpl->tpl_vars['post']->value->getId();?>
" method="post">

        <div class="report-checkbox">
            <input type="radio" required id="violence" name='type' value="violence">
            <label for="violence">violence</label>
        </div>
        <div class="report-checkbox">
            <input type="radio"  required id="gambling" name='type' value="gambling">
            <label for="gambling">gambling</label>
        </div>
        <div class="report-checkbox">
            <input type="radio" required id="inappropriate or offending" name='type' value="inappropriate or offending">
            <label for="inappropriate or offending">inappropriate or offensive</label>
        </div>
        <div class="report-checkbox">
            <input type="radio" required id="suspicious activities" name='type' value="suspicious activities">
            <label for="suspicious activities">suspicious activities</label>
        </div>
        <div class="report-checkbox">
            <input type="radio" required id="pornography" name='type' value="pornography">
            <label for="pornography">pornography</label>
        </div>
        <div>
            <h3 class="text-muted">Write a small description why you're reporting this post</h3>
            <label>
                <textarea class="text-area" name='description'></textarea>
            </label>
        </div>
        <label>
            <button type="submit" class="btn btn-primary" style="margin-top: 1%">Send</button>
        </label>
        
    </form>
    <label>
      <button onclick="location.reload()" class="btn btn-primary" style="margin-top: 1%">cancel</button>
    </label>
</div>
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
<?php echo '<script'; ?>
 src="/Agora/Smarty/js/sidebar2.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/Agora/Smarty/js/report.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
