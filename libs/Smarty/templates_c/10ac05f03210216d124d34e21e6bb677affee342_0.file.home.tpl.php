<?php
/* Smarty version 3.1.33, created on 2024-07-27 12:39:08
  from 'C:\xampp\htdocs\Agora\libs\Smarty\templates\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_66a4ce4cd4d195_82356972',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10ac05f03210216d124d34e21e6bb677affee342' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Agora\\libs\\Smarty\\templates\\home.tpl',
      1 => 1722076733,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a4ce4cd4d195_82356972 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <title>Agorà</title>
    <!-- icon scout cdn -->
    <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">
    <?php echo '<script'; ?>
 src="/Agora/libs/Smarty/js/test.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        const userId = <?php echo $_smarty_tpl->tpl_vars['user']->value->getId();?>
;
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/Agora/libs/Smarty/js/websocket.js"><?php echo '</script'; ?>
>
    
    <!-- stylesheet -->
    
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/normalize.css">
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/style.css">
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/map.css">
    
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
                    <img src="/Agora/libs/Smarty/immagini/2.png" alt="">
            </div>
        </div>
    </nav>
<!-----------------------MAIN-------------------->
<main>
    <div class="container">
        <!-----------------------left-------------------->
        <div class="left">
            <a class="profile">
            <?php if ($_smarty_tpl->tpl_vars['userPic']->value->getSize() > 0) {?>
                <div class="profile-photo">  
                    <img src="data:<?php echo $_smarty_tpl->tpl_vars['userPic']->value->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['userPic']->value->getEncodedData();?>
" alt="Img">
                </div>
            <?php } else { ?>
                <div class="profile-photo">
                    <img src="/Agora/libs/Smarty/immagini/1.png" alt="Img">
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
                    <p class="text-muted">@<?php echo $_smarty_tpl->tpl_vars['user']->value->getName();?>
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
            <div id="online-handle" class="handle profile" style="margin-top: 1rem;">
                <h4>Online users</h4>
                <p>Online: <i class="fa-solid fa-circle" style="color: green;"></i><span id="online-count">0</span></p>
            </div>
        </div>


        <!-----------------------END OF LEFT-------------------->

        <!-----------------------middle-------------------->
        <div class="middle">
        <!----------------FEEDS-------------------------------->
            <div class="feeds">
                <?php if (empty($_smarty_tpl->tpl_vars['arrayPostInHome']->value)) {?>
                     <div class="error tex-bold">There are no Post, Start Following new User to see their post here</div>
                <?php } else { ?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrayPostInHome']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>

                <div class="feed">
                  <div class="head">
                    <div class="user">
                    <?php if ($_smarty_tpl->tpl_vars['post']->value[1] !== null && $_smarty_tpl->tpl_vars['post']->value[1]->getSize() > 0) {?>
                        <div class="profile-photo">  
                            <img src="data:<?php echo $_smarty_tpl->tpl_vars['post']->value[1]->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['post']->value[1]->getEncodedData();?>
" alt="Img">
                        </div>
                      <?php } else { ?>
                        <div class="profile-photo">
                            <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                        </div>
                      <?php }?>
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
                      <div class='vip'><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getCategory();?>
</div>
                  </div>
                    <div class="caption ">
                        <!-- Smarty tag for username -->
                        <p>
                        <?php if ($_smarty_tpl->tpl_vars['post']->value[0]->getUser()->isVip()) {?>
                            <a  href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
" class="vip"> <?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
</a> <i class='uil uil-star vip'></i>
                        <?php } else { ?>
                            <a  href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"><?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getUser()->getUsername();?>
</a>
                        <?php }?>
                            <span class="harsh-tag" style="max-width: 30rem;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;  ">
                                <?php echo $_smarty_tpl->tpl_vars['post']->value[0]->getDescription();?>

                            </span>
                        </p>
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
" loading="lazy" alt="Img">
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                          </div>
                        <?php }?>
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
                    <i class="uil uil-github"></i>
                    <div class="category-body">
                        <h5>Animals</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Animals'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>

                <div class="category">
                        <i class="uil uil-palette"></i>
                        <div class="category-body">
                            <h5>Arts</h5>
                            <div class="action">
                                <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Arts'">
                                    Select
                                </button>
                        </div>
                    </div>
                </div>

                    <div class="category">
                        <i class="uil uil-book-alt"></i>
                        <div class="category-body">
                            <h5>Books</h5>
                            <div class="action">
                                <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Books'">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="category">
                        <i class="uil uil-streering"></i>
                        <div class="category-body">
                            <h5>Cars</h5>
                            <div class="action">
                                <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Cars'">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="category">
                        <i class="uil uil-film"></i>
                        <div class="category-body">
                            <h5>Cinema</h5>
                            <div class="action">
                                <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Cinema'">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>
                <div class="category">
                    <i class="uil uil-pizza-slice"></i>
                    <div class="category-body">
                        <h5>Cooking</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Cooking'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <i class="uil uil-mouse"></i>
                    <div class="category-body">
                        <h5>Gaming</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Gaming'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <i class="uil uil-flower"></i>
                    <div class="category-body">
                        <h5>Gardening</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Gardening'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <i class="uil uil-home-alt"></i>
                    <div class="category-body">
                        <h5>Home</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Home'">
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
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Music'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <i class="uil uil-megaphone"></i>
                    <div class="category-body">
                        <h5>News</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/News'">
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
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Photography'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <i class="uil uil-books"></i>
                    <div class="category-body">
                        <h5>School</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/School'">
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
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Sport'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <i class="uil uil-plane"></i>
                    <div class="category-body">
                        <h5>Travel</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Travel'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
                <div class="category">
                    <i class="uil uil-rocket"></i>
                    <div class="category-body">
                        <h5>Technology</h5>
                        <div class="action">
                            <button class="btn btn-primary" onclick="location.href='/Agora/User/category/Technology'">
                                Select
                            </button>
                        </div>
                    </div>
                </div>

            </div>
                    <!----------------------END OF CATEGORY--------------------->


                <!----------------------START OF TOP WRITER--------------------->
               <div class="top-writer">
                   <div class="heading vip">
                    <h2>VIP Writer</h2>
                    <i class="uil uil-star"> </i>
                   </div>
                   <div class="writer">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrVip']->value, 'vip');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['vip']->value) {
?> <!-- TOP WRITERS DEVE ESSE UN ARRAY DI 3 ELEMENTI-->
                        <div class="info">
                        <?php if ($_smarty_tpl->tpl_vars['vip']->value[1]->getSize() > 0) {?>
                            <div class="profile-photo">
                                    <img src="data:<?php echo $_smarty_tpl->tpl_vars['vip']->value[1]->getType();?>
;base64,<?php echo $_smarty_tpl->tpl_vars['vip']->value[1]->getEncodedData();?>
?rand=<?php echo rand();?>
" alt="Img">
                            </div>
                        <?php } else { ?>
                            <div class="profile-photo">
                                <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                            </div>
                        <?php }?>
                            <div>
                            <a  href="/Agora/User/profile/<?php echo $_smarty_tpl->tpl_vars['vip']->value[0]->getUsername();?>
" class='vip'><?php echo $_smarty_tpl->tpl_vars['vip']->value[0]->getUsername();?>
</a>
                                <p class="text-muted">Followers : <?php echo $_smarty_tpl->tpl_vars['vip']->value[2];?>
</p> 
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
 src="/Agora/libs/Smarty/js/sidebar2.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/Agora/libs/Smarty/js/categories.js"><?php echo '</script'; ?>
>

</body>
</html><?php }
}
