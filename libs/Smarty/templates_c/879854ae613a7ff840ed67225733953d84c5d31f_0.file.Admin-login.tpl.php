<?php
/* Smarty version 3.1.33, created on 2024-07-08 16:54:24
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\Admin-login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_668bfda06f4d91_54536502',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '879854ae613a7ff840ed67225733953d84c5d31f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\Admin-login.tpl',
      1 => 1716212534,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_668bfda06f4d91_54536502 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">

    <!-- stylesheet -->
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/Agora/libs/Smarty/css/style.css">
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

<div class="box">
    <div class="form-box">
        <div class="button-box">

            <div clas="tex-bold" style="margin-left: 3.5rem">ADMIN LOGIN</div>
        </div>
        <div class="tex-bold">
            <h3>Agorà</h3>
        </div>
        <!------------FORM PER IL LOG IN------------------------------>
        <?php if ($_smarty_tpl->tpl_vars['error']->value == true) {?>
            <div style="color: red; margin-left: 8%;">
                wrong username or password, try again
            </div>
        <?php }?>
        <form id="login" class="input-group" action="/Agora/Moderator/checkLogin" method="post">
            <label>
                <input type="text" class="input-field" placeholder="Enter Username" name="username" required>
            </label>
            <label>
                <input type="password" class="input-field" placeholder="Enter Password" name="password" required>
            </label>
            <button type="submit" class="submit-btn">Log in</button>
        </form>

    </div>

</div>
</body>
<?php }
}
