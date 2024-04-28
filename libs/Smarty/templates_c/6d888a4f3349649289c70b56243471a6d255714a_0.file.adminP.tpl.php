<?php
/* Smarty version 3.1.33, created on 2024-04-28 11:30:01
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\adminP.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_662e17196d3212_42269215',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d888a4f3349649289c70b56243471a6d255714a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\adminP.tpl',
      1 => 1713091273,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_662e17196d3212_42269215 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <title>Mod-Report</title>
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
      <form  action="/Agora/Moderator/logout" method="post">
                <div>
                    <button class="btn btn-primary" type="submit">Log out</button>
                </div>
      </form>
      <div class="profile-photo">
        <img src="/Agora/Smarty/immagini/2.png" alt="">
      </div>
    </div>
  </nav>

  <!----------------REPORT PAGE FOR ADMIN------------------------------->
  <main>

        <div class="admin" style="height: 60%; overflow-y:auto; margin-top: 1rem;">
          <h3 class="title">ID</h3>
          <h3 class="title">Info Posts</h3>
          <h3 class="title">Action</h3>
        </div>
      <?php if (count($_smarty_tpl->tpl_vars['reportedPost']->value) === 0) {?>
          <div class="admin" style="margin-top: 1rem;">There are no reported post</div>
      <?php } else { ?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reportedPost']->value, 'report');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['report']->value) {
?>
        <div class="admin-report" style="margin-top: 1%">
          <div class="admin">
            <div class="left">
              <h3>Id Report: <?php echo $_smarty_tpl->tpl_vars['report']->value->getId();?>
</h3>
              <h4>Type: <?php echo $_smarty_tpl->tpl_vars['report']->value->getType();?>
</h4>
              <h4>Post's creator: <a href="/Agora/Moderator/visitUser/<?php echo $_smarty_tpl->tpl_vars['report']->value->getPost()->getUser()->getId();?>
" style="text-decoration: none; color: red; font-size: 1rem; font-weight : bold;"><?php echo $_smarty_tpl->tpl_vars['report']->value->getPost()->getUser()->getUsername();?>
</a></h4>
              <h6>Id who sent the report: <?php echo $_smarty_tpl->tpl_vars['report']->value->getIdUser();?>
</h6>
            </div>
            <div class="middle">
              <div class="body-report"> <?php echo $_smarty_tpl->tpl_vars['report']->value->getDescription();?>
</div>
              <label>
                <button class="btn btn btn-primary" onclick="location.href='/Agora/Moderator/visitPost/<?php echo $_smarty_tpl->tpl_vars['report']->value->getPost()->getId();?>
'">See the post</button>
              </label>
            </div>
            <div class="right">
              <div>
              <form id='ban' action="/Agora/Moderator/banPost/<?php echo $_smarty_tpl->tpl_vars['report']->value->getPost()->getId();?>
/<?php echo $_smarty_tpl->tpl_vars['report']->value->getPost()->getUser()->getId();?>
" method="post">
                <button class="btn btn-primary "><i class="uil uil-trash-alt">Ban</i></button>
              </form>
              </div>
              <div style="margin-top: 100%">
              <form id='ignore' action="/Agora/Moderator/ignore/<?php echo $_smarty_tpl->tpl_vars['report']->value->getId();?>
" method="post">
                <button class="btn btn-primary "><i class="uil uil-eye-slash">Ignore</i></button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php }?>
        <div class="admin" style="height: 60%; overflow-y:auto; margin-top: 1rem;">
          <h3 class="title">ID</h3>
          <h3 class="title">Body Comments</h3>
          <h3 class="title">Action</h3>
        </div>
      <?php if (count($_smarty_tpl->tpl_vars['reportedComment']->value) === 0) {?>
          <div class="admin" style="margin-top: 1rem;">There are no reported comment</div>
      <?php } else { ?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reportedComment']->value, 'report');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['report']->value) {
?>
        <div class="admin-report" style="margin-top: 1%">
          <div class="admin">
            <div class="left">
              <h3>Id Report: <?php echo $_smarty_tpl->tpl_vars['report']->value->getId();?>
</h3>
              <h4>Type: <?php echo $_smarty_tpl->tpl_vars['report']->value->getType();?>
</h4>
              <h4>Comment's creator: <a href="/Agora/Moderator/visitUser/<?php echo $_smarty_tpl->tpl_vars['report']->value->getComment()->getUser()->getId();?>
" style="text-decoration: none; color: red; font-size: 1rem; font-weight : bold;"> <?php echo $_smarty_tpl->tpl_vars['report']->value->getComment()->getUser()->getUsername();?>
</a></h4>
              <h6>Id who sent the report: <?php echo $_smarty_tpl->tpl_vars['report']->value->getIdUser();?>
</h6>
            </div>
            <div class="middle">
              <div class="body-report"><?php echo $_smarty_tpl->tpl_vars['report']->value->getComment()->getBody();?>
</div>
            </div>
            <div class="right">
              <div>
              <form id='ban' action="/Agora/Moderator/banComment/<?php echo $_smarty_tpl->tpl_vars['report']->value->getComment()->getId();?>
" method="post">
                <button class="btn btn-primary "><i class="uil uil-trash-alt">Ban</i></button>
              </form>
              </div>
              <div style="margin-top: 100%">
              <form id='ignore' action="/Agora/Moderator/ignore/<?php echo $_smarty_tpl->tpl_vars['report']->value->getId();?>
" method="post">
                <button class="btn btn-primary "><i class="uil uil-eye-slash">Ignore</i></button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php }?>
  </main>
</body>
</html><?php }
}
