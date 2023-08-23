<?php
/* Smarty version 3.1.33, created on 2023-08-23 10:27:34
  from 'C:\xampp\htdocs\Agora\Smarty\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_64e5c2f60c0890_38874768',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '67a0cc84512dc787accea659667515f0c46aec69' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\Smarty\\templates\\login.tpl',
      1 => 1692779252,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e5c2f60c0890_38874768 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<?php $_smarty_tpl->_assignInScope('error', (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('bann', (($tmp = @$_smarty_tpl->tpl_vars['bann']->value)===null||$tmp==='' ? 'false' : $tmp));
$_smarty_tpl->_assignInScope('errorSize', (($tmp = @$_smarty_tpl->tpl_vars['errorSize']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('errorType', (($tmp = @$_smarty_tpl->tpl_vars['errorType']->value)===null||$tmp==='' ? 'ok' : $tmp));
$_smarty_tpl->_assignInScope('errorEmail', (($tmp = @$_smarty_tpl->tpl_vars['errorEmail']->value)===null||$tmp==='' ? 'ok' : $tmp));?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="Img/A.png">

  <!-- stylesheet -->
  <link rel="stylesheet" type="text/css" href="/Agora/Smarty/css/style.css">
</head>
<body>

  <div class="box">
    <div class="form-box">
      <div class="button-box">
        <div id="btn-log"> </div>
          <button type="button" class="toggle-btn" onclick="login()">Log In</button>
          <button type="button" class="toggle-btn" onclick="register()">Register</button>
      </div>
      <div class="tex-bold">
        <h3><?php echo $_smarty_tpl->tpl_vars['siteName']->value;?>
</h3>
      </div>
      <!------------FORM PER IL LOG IN------------------------------>
      <form id="login" class="input-group" action="/Agora/User/login" method="post">
        <label>
          <input type="text" class="input-field" placeholder="Enter Username" name="username" required>
        </label>
        <label>
          <input type="password" class="input-field" placeholder="Enter Password" name="password" required>
        </label>
        <button type="submit" class="submit-btn">Log in</button>
      </form>
      <!------------FINE FORM PER IL LOG IN------------------------------>

      <!------------FORM PER IL SING UP------------------------------>
      <form id="register" class="input-group" action="/Agora/User/registration" method="post">
        <label>
          <input type="text" class="input-field" placeholder="Name" name="name" required>
        </label>
        <label>
          <input type="text" class="input-field" placeholder="Surname" name="surname" required>
        </label>
        <label>
          <input type="text" class="input-field" placeholder="Age" name="age" required>
        </label>
        <label>
          <input type="text" class="input-field" placeholder="Username" name="username" required>
        </label>
        <label>
          <input type="email" class="input-field" placeholder="Email" name="email" required>
        </label>
        <label>
          <input type="tel" class="input-field" placeholder="Phone" name="phone" required>
        </label>
        <label>
          <input type="password" class="input-field" placeholder="Enter Password" name="password" required>
        </label>
        <button type="submit" class="submit-btn" >Register</button>
      </form>
      <!------------FINE FORM PER IL SING UP------------------------------>
    </div>

  </div>

<?php echo '<script'; ?>
> const x = document.getElementById("login");
const y = document.getElementById("register");
const z = document.getElementById("btn-log");

function register(){
  x.style.left = "-400px"
  y.style.left = "50px"
  z.style.left = "110px"
}

function login(){
  x.style.left = "50px"
  y.style.left = "550px"
  z.style.left = "0px"
}

<?php echo '</script'; ?>
>

</body>
</html><?php }
}
