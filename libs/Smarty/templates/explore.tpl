<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <title>Agorà</title>
  <!-- icon scout cdn -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">
  <script src="/Agora/libs/Smarty/js/test.js"></script>
  <script>
        const userId = {$user->getId()};
  </script>
  <script src="/Agora/libs/Smarty/js/websocket.js"></script>
  <!-- stylesheet -->
  {literal}
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/normalize.css">
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/style.css">
  {/literal}
  <script>
        function ready(){
            if (!navigator.cookieEnabled) {
                alert('Attenzione! Attivare i cookie per proseguire correttamente la navigazione');
            }
        }
        document.addEventListener("DOMContentLoaded", ready);
    </script>
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
      {if $userPic->getSize() > 0}
        <div class="profile-photo">  
            <img src="data:{$userPic->getType()};base64,{$userPic->getEncodedData()}" alt="Img">
        </div>
      {else}
        <div class="profile-photo">
            <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
        </div>
      {/if}
        <div class ="handle">
        {if $user->isVip()}
          <h4 class='vip'> {$user->getUsername()} <i class='uil uil-star'></i> </h4>
        {else}
          <h4> {$user->getUsername()}</h4>
        {/if}
          <p class="text-muted">@{$user->getName()}
          </p>
        </div>
      </a>
      <!-----------------------SIDE BAR-------------------->
      <div class="sidebar">
        <label class="menu-items tex-bold">
          <button class="btn-transparent" onclick="location.href='/Agora/User/home'"> <i class="uil uil-home"></i></button> Home
        </label>
        <label class="menu-items active tex-bold">
          <span> <i class="uil uil-compass"></i></span> Explore
        </label>
        <label class="menu-items tex-bold">
          <button class="btn-transparent" onclick="location.href='/Agora/User/personalProfile'"><i class="uil uil-user-circle"></i></button> Profile
        </label>
        <label class="tex-bold theme-cust"  id="theme">
          <span> <i class="uil uil-palette"></i></span>Theme
        </label>
        <label class="menu-items tex-bold " >
          <span> <i class="uil uil-setting"></i></span> Setting
          <button class="btn-transparent" onclick="location.href='/Agora/User/settings'"></button>
        </label>
      </div>
      <!--------------------END OF SIDE BAR----------------->
      <label
              class="btn btn-primary">Create post
        <button class="btn-transparent" onclick="location.href='/Agora/Post/postForm'"></button>
      </label>
    </div>


    <!-----------------------END OF LEFT-------------------->

    <div class="middle">
      <!----------------FEEDS-------------------------------->
      <div class="feeds">
      {if empty($posts)}
        <div class="error tex-bold">There are no Post</div>
      {else}
        {foreach $posts as $post}
          <div class="feed">
            <div class="head">
              <div class="user">
              {if $post[1] !== null && $post[1]->getSize() > 0}
                <div class="profile-photo">  
                    <img src="data:{$post[1]->getType()};base64,{$post[1]->getEncodedData()}" alt="Img">
                </div>
              {else}
                <div class="profile-photo">
                    <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                </div>
              {/if}
                <div class="ingo">
                  <div>
                    <a href="/Agora/Post/visit/{$post[0]->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post[0]->getTitle()}</a>
                  </div>
                  <small>{$post[0]->getTime()->format('Y-m-d H:i:s')}</small>
                </div>
              </div>
              <div class='vip'>{$post[0]->getCategory()}</div>
            </div>
            <div class="caption ">
              <!-- Smarty tag for username -->
              <p>
              {if $post[0]->getUser()->isVip()}
                <a  href="/Agora/User/profile/{$post[0]->getUser()->getUsername()}" class="vip"> {$post[0]->getUser()->getUsername()}</a> <i class='uil uil-star vip'></i>
              {else}
                <a  href="/Agora/User/profile/{$post[0]->getUser()->getUsername()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post[0]->getUser()->getUsername()}</a>
              {/if}
                 <span class="harsh-tag">
                        {$post[0]->getDescription()}</span></p>
            </div>
            {if count($post[0]->getImages()) === 0}
                        
              {else}
                <div class="photo">
                  {foreach from=$post[0]->getImages() item=i}
                      <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" loading="lazy" alt="Img">
                  {/foreach}
                </div>
              {/if}
          </div>
        {/foreach}
      {/if}
        <!----------------END OF FEED------------------------------>
      </div>
      <!----------------END OF FEEDS------------------------------>
    </div>
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
           {foreach $arrVip as $vip} <!-- TOP WRITERS DEVE ESSE UN ARRAY DI 3 ELEMENTI-->
           <div class="info">
           {if $vip[1]->getSize()> 0}
               <div class="profile-photo">
                       <img src="data:{$vip[1]->getType()};base64,{$vip[1]->getEncodedData()}" alt="Img">
               </div>
           {else}
               <div class="profile-photo">
                   <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
               </div>
           {/if}
               <div>
               <a  href="/Agora/User/profile/{$vip[0]->getUsername()}" class='vip'>{$vip[0]->getUsername()}</a>
                   <p class="text-muted">Followers : {$vip[2]}</p> 
               </div>
           </div>
           {/foreach}
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
<script src="/Agora/libs/Smarty/js/sidebar2.js"></script>
<script src="/Agora/libs/Smarty/js/categories.js"></script>
</body>
</html>