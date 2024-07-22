<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>Agorà</title>
  <!-- icon scout cdn -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">
  <script src="/Agora/libs/Smarty/js/test.js"></script>
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
    <a href="/Agora/User/home" class="log" style="text-decoration: none; color: inherit; font-size: 1.5rem; font-weight : bold" >Agorà</a>
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
      <img src="/Agora/libs/Smarty/immagini/A.png" alt="">
    </div>
  </div>
</nav>


<!------------------------------------------------------
                  RESULT FOR SEARCH
----------------------------------------------------->
<main>

  <div class="result">
    <h3 class="text-muted">Result for : {$keyword}</h3>
  </div>
  <div class="result" style="margin-top: 2%">
  <h3>Posts:</h3>
  {if count($searchedPost) === 0}
    <div class="result" style="margin-top: 2%">There are no post with this title, try something else</div>
    {else}
    <div class="left">
    
  {foreach $searchedPost as $post}
      <div style="padding:1.5rem">
      <div class="profile">
        {if $post[1]->getSize() > 0}
          <div class="profile-photo">
            <img src="data:{$post[1]->getType()};base64,{$post[1]->getEncodedData()}" alt="Img">
          </div>
        {else}
          <div class="profile-photo">
            <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
          </div>
        {/if}
        <div class ="handle">
        {if $post[0]->getUser()->isVip()}
          <a  href="/Agora/User/profile/{$post[0]->getUser()->getUsername()}" class="vip"> {$post[0]->getUser()->getUsername()}</a> <i class='uil uil-star vip'></i>
        {else}
          <a  href="/Agora/User/profile/{$post[0]->getUser()->getUsername()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post[0]->getUser()->getUsername()}</a>
        {/if}
          <p class="text-muted">
            @{$post[0]->getuser()->getName()}
          </p>
        </div>
      </div>
      <div>
      <h5 class="text-muted">Title:</h5>
        <a href="/Agora/Post/visit/{$post[0]->getId()}" class="search" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> {$post[0]->getTitle()}</a>
          </div>
        
    </div>
    
    {/foreach}
    </div>
    {/if}
    <h3>User: </h3>
    {if count($searchedUser) === 0}
      <div class="result" style="margin-top: 2%">There are no user with this username, try something else</div>
    {else}
      <div class="right">
      
      {foreach $searchedUser as $user}
    <div style="padding:1rem">  
      <div class="list-profile">
          
        <div class="profile">
            {if $user[1]->getSize() > 0}
              <div class="profile-photo">
                <img src="data:{$user[1]->getType()};base64,{$user[1]->getEncodedData()}" alt="Img">
              </div>
            {else}
              <div class="profile-photo">
                <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
              </div>
            {/if}
            <div class ="handle">
            {if $user[0]->isVip()}
              <a  href="/Agora/User/profile/{$user[0]->getUsername()}" class="vip"> {$user[0]->getUsername()}</a> <i class='uil uil-star vip'></i>
          {else}
              <a  href="/Agora/User/profile/{$user[0]->getUsername()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$user[0]->getUsername()}</a>
          {/if}
              <p class="text-muted">
                @{$user[0]->getName()}
              </p>
            </div>
          </div>
      </div>  
      </div>
      {/foreach}
      </div>
      {/if}
  

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
<script>
        const userId = {$user->getId()};
  </script>
  <script src="/Agora/libs/Smarty/js/websocket.js"></script>

</body>
</html>
