<?php
/* Smarty version 3.1.33, created on 2024-04-27 18:49:09
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\setting.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_662d2c8545b941_97417162',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90269464dbfeede0837f3f1bd948600e0e159f6f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\setting.tpl',
      1 => 1712935890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662d2c8545b941_97417162 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="eng">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
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
    <div class="tex-bold">
      <h3>SETTIINGS <i class="uil uil-setting"></i></h3>
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

<!-- START OF SETTING -->
<main>
 <div class="bigContainer">
  <div class="container">
    <!-----------------------left-------------------->
    <div class="left">
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
        <label class="menu-items active tex-bold " >
          <button class="btn-transparent" onclick="location.href='/Agora/User/settings'"><i class="uil uil-setting"></i> </button>Setting
        </label>
      </div>
      <!--------------------END OF SIDE BAR----------------->
      <label class="btn btn-primary">create post
        <button class="btn-transparent" onclick="location.href='/Agora/Post/createPost'"></button>
      </label>
    </div>


    <!-----------------------END OF LEFT-------------------->


    <div class="box-setting">
    <form enctype="multipart/form-data" action="/Agora/User/setProPic" method="post" >
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
      <?php if ($_smarty_tpl->tpl_vars['errorImg']->value == true) {?>
        <div style="color:red; margin-left: 47%">Invalid input</div>
      <?php }?>
      <div class="conte">
        <label class="custom-btn btn">
          <input type="file" name="imageFile" class="image-input" accept="image/*">
          change img
        </label>
        <label class=" btn btn-primary">Save
          <button type="submit" class="btn-transparent"></button>
        </label>
      </div>

    </form>
    <form enctype="multipart/form-data" action="/Agora/User/setUserInfo" method="post" >
      <div class="info-profile">
        <h4 class="tex-bold" >Biography</h4>
        <label>
          <input type="text" class="text" name="Bio" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getBio();?>
">
        </label>
        <h4 class="tex-bold" >Work at</h4>
        <label>
          <input type="text" class="text" name="Working" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getWorking();?>
">
        </label>
        <h4 class="tex-bold" >Studied at</h4>
        <label>
          <input type="text" class="text" name="StudiedAt" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->getStudiedAt();?>
">
        </label>
        <h4 class="tex-bold" >Hobby</h4>
        <label>
          <input type="text" class="text" name="Hobby" value=<?php echo $_smarty_tpl->tpl_vars['user']->value->getHobby();?>
>
        </label>
        <div>

          <label class=" btn btn-primary">Save
            <button type="submit" class="btn-transparent"></button>
          </label>
          <label>
            <button type="reset" class="btn btn-primary">Delete</button>
          </label>
        </div>
        </form>
        <form enctype="multipart/form-data" action="/Agora/User/setUsername" method="post" >
        <h4 class="tex-bold" >UserName</h4>
          <?php if ($_smarty_tpl->tpl_vars['error']->value == true) {?>
          <div style="color: red ; margin-left: 4%">Username already taken</div>
          <?php }?>
        <label>
          <input type="text" class="text" maxlength="15" minlength="3" name="username" value=<?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
 >
        </label>
        <label class=" btn btn-primary">Save
          <button type="submit" class="btn-transparent"></button>
        </label>
        <label>
          <button type="reset" class="btn btn-primary">Delete</button>
        </label>
      </form>
      <form enctype="multipart/form-data" action="/Agora/User/setPassword" method="post" >
        <h4 class="tex-bold">Password</h4>
        <label>
          <input type="password" id="password" class="text" name="password" placeholder="NewPassword">
        </label>
        <h4 class="tex-bold">Confirm Password</h4>
        <label>
          <input type="password" id="confirmPassword" class="text" name='confirmPassword' placeholder="Confirm Password">
        </label>
        <p id="passwordMatchError" class="error-text">Password Not Match</p>
        <div>
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="reset" class="btn btn-primary">Delete</button>
        </div>
      </form>
    </div>
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
</main>
<?php echo '<script'; ?>
 src="/Agora/Smarty/js/checkPassword.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/Agora/Smarty/js/sidebar2.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
