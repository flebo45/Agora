<?php
<<<<<<< HEAD
/* Smarty version 3.1.33, created on 2023-08-27 12:59:39
=======
/* Smarty version 3.1.33, created on 2023-08-27 15:37:51
>>>>>>> 9d3cdf072a1d19bbb2a87381fbf97949ce3cfaab
  from 'C:\xampp\htdocs\Agora\Smarty\templates\personalProfile.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
<<<<<<< HEAD
  'unifunc' => 'content_64eb2c9bd97064_73097963',
=======
  'unifunc' => 'content_64eb51afd9bee2_40071628',
>>>>>>> 9d3cdf072a1d19bbb2a87381fbf97949ce3cfaab
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f3d23e5efbf92e1d8c199360f852bbf70e41bdb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\Smarty\\templates\\personalProfile.tpl',
<<<<<<< HEAD
      1 => 1693129623,
=======
      1 => 1693143468,
>>>>>>> 9d3cdf072a1d19bbb2a87381fbf97949ce3cfaab
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
<<<<<<< HEAD
function content_64eb2c9bd97064_73097963 (Smarty_Internal_Template $_smarty_tpl) {
=======
function content_64eb51afd9bee2_40071628 (Smarty_Internal_Template $_smarty_tpl) {
>>>>>>> 9d3cdf072a1d19bbb2a87381fbf97949ce3cfaab
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('userlogged', (($tmp = @$_smarty_tpl->tpl_vars['userlogged']->value)===null||$tmp==='' ? 'nouser' : $tmp));?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <title>personalUser</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/Smarty/immagini/A.png">

  <!-- stylesheet -->
  
  <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
  
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
            <div>
                <button class="btn btn-primary">Log out</button>
            </div>
                <div class="profile-photo">
                    <img src="/Agora/Smarty/immagini/2.png" alt="">
                </div>
        </div>
    </nav>
<!-----------------------MAIN-------------------->
<main>
    <div class="container">
        <!-----------------------left-------------------->
        <div class="left">
            <a class="profile">
                <div class="profile-photo">
                    <img src="/Agora/Smarty/immagini/A.png" alt=" log in">
                </div>
                <div class ="handle">
                    <h4><?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</h4>
                    <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>

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
       
              <label class="menu-items active tex-bold">
                <span><i class="uil uil-user-circle"></i></span> Profile
              </label>
                <label class="tex-bold theme-cust"  id="theme">
                    <span> <i class="uil uil-palette"></i></span>Theme
                </label>
              <label class="menu-items tex-bold" >
                <button class="btn-transparent" onclick="location.href='/Agora/User/settings/0'">  <i class="uil uil-setting"></i></button>Setting
              </label>
        </div>
        <!--------------------END OF SIDE BAR----------------->
        <label class="btn btn-primary">create post
          <button class="btn-transparent" onclick="location.href='/Agora/ManagePost/createPost'"></button>
        </label>
    </div>


    <!-----------------------END OF LEFT-------------------->


    <!-----------------------middle-------------------->
    <div class="middle">
      <!----------------FEEDS-------------------------------->
      <div class="feeds">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['postList']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
                <div class="feed">
                  <div class="head">
                    <div class="user">
                      <div class="profile-photo">
                        <img src="/Agora/Smarty/immagini/A.png" alt="img"> <!--IMMAGINE PROFILO UTENTE-->
                      </div>
                      <div class="ingo">
                        <h3><?php echo $_smarty_tpl->tpl_vars['post']->value->getTitle();?>
</h3>
                        <small><?php echo $_smarty_tpl->tpl_vars['post']->value->getTime()->format('Y-m-d H:i:s');?>
</small>
                      </div>
                    </div>
                      <label>
                              <button class="btn-transparent" id="edit" type="button">  <i class="uil uil-ellipsis-h"></i></button>
                      </label>
                  </div>
                    <div class="caption ">
                        <!-- Smarty tag for username -->
                        <p><b><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
</b><span class="harsh-tag">
                        <?php echo $_smarty_tpl->tpl_vars['post']->value->getDescription();?>
</span></p>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['post']->value->getImages()->count() === 0) {?>
                        
                      <?php } else { ?>
                        <div class="photo">
                          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['post']->value->getImages(), 'i');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value) {
?>
                              <img src="data:<?php echo $_smarty_tpl->tpl_vars['i']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['i']->value->getEncodedData();?>
<<<<<<< HEAD
" alt="Img">   
=======
" alt="Img">
>>>>>>> 9d3cdf072a1d19bbb2a87381fbf97949ce3cfaab
                          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                      <?php }?>

                    <div class="action-buttons">
                        <div class="interaction-buttons">
                            <span><i class="uil uil-heart"></i> </span>
                            <span><i class="uil uil-comment-dots"></i></span>
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
                        <p> liked by <b><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
</b> and <b> n user </b></p> <!-- PRENDERE L'ULTIMO UTENTE CHE HA MESSO MI PIACE -->
                    </div>

                    <div class=" comments text-muted">view all the comment</div>
                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <!----------------END OF FEED------------------------------>
            </div>
            <!----------------END OF FEEDS------------------------------>
        </div>

    <!-----------------------END OF MIDDLE---------------------------->



    <!-----------------------right-------------------->
    <div class="right">
      <div class="side-profile">
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
</main>


<!-------------------EDIT MODAL----------------------------------------->


<div class="edit">
  <div class="card">
    <label>
      <button class="btn btn-transparent"  onclick="location.href='Agora/user/creation_post'"><i class="uil uil-wrench">Modify</i></button>
    </label>
    <label>
      <button class="btn btn-transparent" id="delete"><i class="uil uil-trash-alt"></i>Delete</button>
    </label>
  </div>
</div>


<!------------------CONFIRM DELETE------------------------------>

<div class="delete">
  <div class="card">
    <h2>Are you sure you want to delete this post?</h2>
    <div>
      <label>
        <button class="btn-transparent btn">Yes</button>
      </label>
      <label>
        <button class="btn-transparent btn">No</button>
      </label>
    </div>
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
 src="/Agora/Smarty/js/Sidebar.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/Agora/smarty/js/edit.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
