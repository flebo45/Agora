<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>Agorà-{$user->getUsername()}</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/Smarty/immagini/A.png">
  <script src="/Agora/Smarty/js/test.js"></script>
  <!-- stylesheet -->
  {literal}
  <link rel="stylesheet" href="/Agora/Smarty/css/normalize.css">
  <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
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
      <h2 class="log">Agorà</h2>
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
        <img src="/Agora/Smarty/immagini/2.png" alt="">
      </div>
    </div>
  </nav>
<!-----------------------MAIN-------------------->
<main>
<div class="container_pr">
    <div class="container">
        <!-----------------------left-------------------->
        <div class="left">
            <a class="profile">
            {if $personalPic->getSize() > 0}
              <div class="profile-photo">  
                  <img src="data:{$personalPic->getType()};base64,{$personalPic->getEncodedData()}" alt="Img">
              </div>
            {else}
              <div class="profile-photo">
                  <img src="/Agora/Smarty/immagini/1.png" alt="">
              </div>
            {/if}
                <div class ="handle">
                {if $personalUser->isVip()}
                  <h4 class='vip'> {$personalUser->getUsername()} <i class='uil uil-star'></i> </h4>
                {else}
                  <h4> {$personalUser->getUsername()}</h4>
                {/if}
                    <p class="text-muted">@{$personalUser->getName()}
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
              <label class="menu-items tex-bold">
                <button class="btn-transparent" onclick="location.href='/Agora/User/personalProfile'"> <i class="uil uil-user-circle"></i></button>Profile
              </label>
              <label class="tex-bold theme-cust"  id="theme">
                <span> <i class="uil uil-palette"></i></span>Theme
              </label>
              <label class="menu-items tex-bold" >
                <button class="btn-transparent" onclick="location.href='/Agora/User/settings'">  <i class="uil uil-setting"></i></button>Setting
              </label>
      </div>
      <!--------------------END OF SIDE BAR----------------->
      <label class="btn btn-primary">create post
        <button class="btn-transparent" onclick="location.href='/Agora/Post/postForm'"></button>
      </label>
    </div>


  <!-----------------------END OF LEFT-------------------->


    <!-----------------------middle-------------------->
    <div class="middle">
      <!----------------FEEDS-------------------------------->
      <div class="feeds">
                {if $user->isBanned()}
                  <div class="tex-bold feed" style="font-size:18px; color:red">This User is Banned!</div>
                {else}
                {foreach $postList as $post}
                <div class="feed">
                  <div class="head">
                    <div class="user">
                      <div class="profile-photo">
                          <img src="/Agora/Smarty/immagini/1.png" alt="">
                      </div>
                      <div class="ingo">
                        <div>
                          <a href="/Agora/Post/visit/{$post[0]->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post[0]->getTitle()}</a>
                        </div>
                        <small>{$post[0]->getTime()->format('Y-m-d H:i:s')}</small>
                      </div>
                    </div>
                    <div style="background: linear-gradient(45deg, violet, indigo, blue, green, yellow, orange, red);-webkit-background-clip: text;background-clip: text;color: transparent;font-weight: bold;">{$post[0]->getCategory()}</div>
                  </div>
                    <div class="caption ">
                        <!-- Smarty tag for username -->
                        <p><b>{$post[0]->getUser()->getUsername()}</b><span class="harsh-tag">
                        {$post[0]->getDescription()}</span></p>
                    </div>
                    {if count($post[0]->getImages()) === 0}
                        
                      {else}
                        <div class="photo">
                          {foreach from=$post[0]->getImages() item=i}
                              <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img">
                          
                          {/foreach}
                        </div>
                      {/if}

                    <div class="action-buttons">
                        <div class="interaction-buttons">
                          <a href="/Agora/Post/visit/{$post[0]->getId()}" style="text-decoration: none; color: inherit; "><i class="uil uil-comment-dots"></i></a>
                        </div>
                    </div>

                    <div class="liked-by"> <!--FARE QUERY PER PRENDERE L'IMM PROFILO DEGLI  ULTIMI 3 UTENTI CHE HANNO MESSO MI PIACE -->
                        {for $i=0; $i<3;$i++}
                        <span><img src="/Agora/Smarty/immagini/A.png" alt=""></span>
                        {/for}
                        <!-- Smarty tag for username -->
                        <p> liked by <a href="/Agora/Post/like/{$post[0]->getId()}" style="text-decoration: none; color: inherit; font-weight : bold">{$post[1]} user</a></p>
                    </div>

                </div>
                {/foreach}
              {/if}
                <!----------------END OF FEED------------------------------>
            </div>
            <!----------------END OF FEEDS------------------------------>
        </div>

    <!-----------------------END OF MIDDLE---------------------------->



    <!-----------------------right-------------------->
  <div class="right">
  {if $user->isBanned()}
  {else}
    <div class="side-profile">
      
     
        <div class="heading">
        {if $userPic->getSize() > 0}
          <div class="profile-photo">  
              <img src="data:{$userPic->getType()};base64,{$userPic->getEncodedData()}" alt="Img">
          </div>
        {else}
          <div class="profile-photo">
              <img src="/Agora/Smarty/immagini/1.png" alt="">
          </div>
        {/if}
          <div class ="handle">
          {if $user->isVip()}
            <h4 class='vip'> {$user->getUsername()} <i class='uil uil-star' style="font-size:medium"></i> </h4>
          {else}
            <h4> {$user->getUsername()}</h4>
          {/if}
            <p class="text-muted">{$user->getName()}</p>
          </div>
          <div>
              <a href="/Agora/User/followed/{$user->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$followerNumb}</a>
                  <p class="text-muted">
                      followers
                  </p>
              </div>
              <div>
              <a href="/Agora/User/followers/{$user->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$followedNumb}</a>
                  <p class="text-muted">following</p>
              </div>
        </div>
        {if $follow == true}
          <form id='unfollow' action="/Agora/User/unfollow/{$user->getId()}" method="post">
            <button class="btn-primary btn">Unfollow</button>
          </form>
        {elseif $follow == false}
          <form id='follow' action="/Agora/User/follow/{$user->getId()}" method="post">
            <button class="btn-primary btn">Follow</button>
          </form>
        {/if}
        <!----------------------DESCRIPTION-------------------->
        <div class="title">
          <h6>About me</h6>
        </div>

        <div class="bio">
          <i class="uil uil-chat-bubble-user"></i>
          <div class="bio-body">
            <h5 class="text-bold">Bio</h5>
            <div class="text-muted">
              <h5>{$user->getBio()}</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-moneybag"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Working </h5>
            <div class="text-muted">
              <h5>{$user->getWorking()}</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-graduation-cap"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Studied at</h5>
            <div class="text-muted">
              <h5>{$user->getStudiedAt()}</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-hourglass"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Hobby</h5>
            <div class="text-muted">
              <h5>{$user->getHobby()}</h5>
          </div>
          </div>
        </div>
      </div>
      
      <!----------------------END OF DESCRIPTION--------------------->
  
      </div>
    {/if}
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
  <script src="/Agora/Smarty/js/sidebar2.js"></script>
</body>
</html>