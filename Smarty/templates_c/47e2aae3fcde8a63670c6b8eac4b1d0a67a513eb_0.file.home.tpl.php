<?php
/* Smarty version 3.1.33, created on 2023-08-24 23:35:15
  from 'C:\xampp\htdocs\Agora\Smarty\templates\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_64e7cd13e79047_35418686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '47e2aae3fcde8a63670c6b8eac4b1d0a67a513eb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\Smarty\\templates\\home.tpl',
      1 => 1692912913,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64e7cd13e79047_35418686 (Smarty_Internal_Template $_smarty_tpl) {
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

    <!-- stylesheet -->
    
    <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
    
    <?php echo '<script'; ?>
 src="/Agora/Smarty/js/Sidebar.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Agora/Smarty/js/report.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Agora/Smarty/js/index.js"><?php echo '</script'; ?>
>
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
                    <h4> <?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
 </h4>
                    <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>

                    </p>
                </div>
            </a>
            <!-----------------------SIDE BAR-------------------->
            <div class="sidebar">
                <label class="menu-items active tex-bold">
                    <span> <i class="uil uil-home"></i></span> Home
                </label>
                <label class="menu-items tex-bold">
                    <button class="btn-transparent" onclick="location.href='/Agora/User/explore'"> <i class="uil uil-compass"></i></button> Explore
                </label>

                <label class="menu-items tex-bold">
                    <button class="btn-transparent" onclick="location.href='/Agora/User/personalProfile'"> <i class="uil uil-user-circle"></i></button>Profile

                </label>
                <label class="menu-items  tex-bold" id="theme">
                    <span> <i class="uil uil-palette"></i></span>Theme
                </label>
                <label class="menu-items tex-bold " >
                    <button class="btn-transparent" onclick="location.href='/Agora/User/settings'"><i class="uil uil-setting"></i> </button>Setting
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arraypostinhome']->value, 'post');
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
                  </div>
                    <div class="caption ">
                        <!-- Smarty tag for username -->
                        <p><b><?php echo $_smarty_tpl->tpl_vars['post']->value->getUser()->getUsername();?>
</b><span class="harsh-tag">
                        <?php echo $_smarty_tpl->tpl_vars['post']->value->getDescription();?>
</span></p>
                    </div>
                    <div class="photo">
                        <!--img src="Img/A.png" alt="img">
                        <img src="Img/1.png" alt="img">
                        <img src="Img/A.png" alt="img">
                        <img src="Img/1.png" alt="img"-->
                    </div>

                    <div class="action-buttons">
                        <div class="interaction-buttons">
                            <span><i class="uil uil-heart"></i> </span>
                            <span><i class="uil uil-comment-dots"></i></span>
                        </div>

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
            <div class="categories">
                <div class="heading">
                    <h4>Categories</h4>
                    <i class="uil uil-book-alt"></i>
                </div>
                <!----------------------SEARCH BAR-------------------->
                <div class="search-bar">
                    <i class="uil uil-search"></i>
                    <label for="category-search"></label>
                    <input type="search" placeholder="search" id="category-search">
                </div>
                <!----------------------CATEGORY-------------------->
                <div class="title">
                    <h6> All category</h6>
                </div>
                <!----------------------TYPE OF CATEGORIES-------------------->
                <div class="category">
                    <i class="uil uil-plane"></i>
                    <div class="category-body">
                        <h5>Trip</h5>
                        <div class="action">
                            <button class="btn btn-primary">
                                Select
                            </button>
                        </div>
                    </div>
                </div>

                <div class="category">
                        <i class="uil uil-music"></i>
                        <div class="category-body">
                            <h5>Music</h5>
                            <div class="action">
                                <button class="btn btn-primary">
                                    Select
                                </button>
                        </div>
                    </div>
                </div>

                    <div class="category">
                        <i class="uil uil-football"></i>
                        <div class="category-body">
                            <h5>Sport</h5>
                            <div class="action">
                                <button class="btn btn-primary">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="category">
                        <i class="uil uil-book-alt"></i>
                        <div class="category-body">
                            <h5>Book</h5>
                            <div class="action">
                                <button class="btn btn-primary">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="category">
                        <i class="uil uil-camera"></i>
                        <div class="category-body">
                            <h5>Photography</h5>
                            <div class="action">
                                <button class="btn btn-primary">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>
            </div>
                    <!----------------------END OF CATEGORY--------------------->


                <!----------------------START OF TOP WRITER--------------------->
               <div class="top-writer">
                   <div class="heading">
                   <h4>Top Writer</h4>
                   <i class="uil uil-award"> </i>
                   </div>
                   <div class="writer">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['topWriters']->value, 'writer');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['writer']->value) {
?> <!-- TOP WRITERS DEVE ESSE UN ARRAY DI 3 ELEMENTI-->
                        <div class="info">
                            <div class="profile-photo">
                                <img src="Img/A.png" alt="img"> <!--IMMAGINE DI PROFILO-->
                            </div>
                            <div>
                                <h5><?php echo $_smarty_tpl->tpl_vars['user']->value->getUsername();?>
</h5>
                                <p class="text-muted"><?php echo $_smarty_tpl->tpl_vars['user']->value->getTotlike();?>
</p> <!--BISOGNA FARE UN METODO PER CALCOLARE TUTTI I MI PIACE DI UN UTENTE-->
                            </div>
                        </div>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                   </div>
                </div>
        </div>
    </div>
</main>




    <!-----------------REPORT MODAL----------------------------------->


    <div class="report">
        <div class="card">
            <h2>Report</h2>
            <h3 class="text-muted">Why are you reporting this post?</h3>
            <form>

                <div class="report-checkbox">
                    <input type="checkbox" id="violence" value="violence">
                    <label for="violence">violence</label>
                </div>
                <div class="report-checkbox">
                    <input type="checkbox" id="gambling" value="gambling">
                    <label for="gambling">gambling</label>
                </div>
                <div class="report-checkbox">
                    <input type="checkbox" id="inappropriate or offending" value="inappropriate or offending">
                    <label for="inappropriate or offending">inappropriate or offensive</label>
                </div>
                <div class="report-checkbox">
                    <input type="checkbox" id="suspicious activities" value="suspicious activities">
                    <label for="suspicious activities">suspicious activities</label>
                </div>
                <div class="report-checkbox">
                    <input type="checkbox" id="pornography" value="pornography">
                    <label for="pornography">pornography</label>
                </div>
                <div>
                    <h3 class="text-muted">Write a small description why you're reporting this post</h3>
                    <label>
                        <textarea class="text-area"></textarea>
                    </label>
                </div>
                <label>
                    <button type="submit" class="btn btn-primary" style="margin-top: 1%">Send</button>
                </label>
            </form>
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
</div>
</body>
</html><?php }
}
