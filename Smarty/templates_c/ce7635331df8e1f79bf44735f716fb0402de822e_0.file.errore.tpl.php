<?php
/* Smarty version 3.1.33, created on 2023-08-27 10:58:28
  from 'C:\xampp\htdocs\Agora\Smarty\templates\errore.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_64eb1034b53616_87414135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ce7635331df8e1f79bf44735f716fb0402de822e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\Smarty\\templates\\errore.tpl',
      1 => 1693126705,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64eb1034b53616_87414135 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <?php echo $_smarty_tpl->tpl_vars['titolo']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['descrizione']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['categoria']->value;?>

    <?php echo print_r($_smarty_tpl->tpl_vars['file']->value['imageFile']['size'][0]);?>

    
</body><?php }
}
