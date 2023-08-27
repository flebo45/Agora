<?php
/* Smarty version 3.1.33, created on 2023-08-27 13:03:59
  from 'C:\xampp\htdocs\Agora\Smarty\templates\setting.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_64eb2d9f6ba9f2_88839050',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34b2dd7e38c35c0a3add68c5ee1a5b96c073fc2e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\Smarty\\templates\\setting.tpl',
      1 => 1693134236,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64eb2d9f6ba9f2_88839050 (Smarty_Internal_Template $_smarty_tpl) {
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

  <!-- stylesheet -->
  <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
</head>
<body>
<nav>
  <div class="container">
    <h2 class="log">
      Agora'
    </h2>
    <div class="tex-bold">
      <h3>SETTIINGS <i class="uil uil-setting"></i></h3>
    </div>
    <div class="profile-photo">
      <img src="/Agora/Smarty/immagini/1.png" alt="">
    </div>
  </div>
</nav>

<!-- START OF SETTING -->
<main>
  <div class="box-setting" id="change-info">
    <form enctype="multipart/form-data" action="/Agora/User/settings/4" method="post" >
      <div class="profile-photo">
        <img src="/Agora/Smarty/immagini/2.png"  alt="Img">
      </div>
      <div>
        <label class="custom-btn btn">
          <input type="file" name="imageFile" id="" class="image-input" accept="image/*">
          change img
        </label>
          <label class=" btn btn-primary">Save
            <button type="submit" class="btn-transparent"></button>
          </label>
    </form>
    <form enctype="multipart/form-data" action="/Agora/User/settings/1" method="post" >
      </div>
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
      </div>
    </form>
    <form enctype="multipart/form-data" action="/Agora/User/settings/2" method="post" >
      <h4 class="tex-bold" >UserName</h4>
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
    <from enctype="multipart/form-data" action="/Agora/User/settings/3" method="post" >
      <h4 class="tex-bold" >Password</h4>
      <label>
        <input type="password" class="text" name="password" placeholder="NewPassword">
      </label>
      <h4 class="tex-bold" >Confirm Password</h4>
      <label>
        <input type="password" class="text" placeholder="Confirm Password">
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
  </div>
</main>
</body>
</html><?php }
}
