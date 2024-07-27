<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <title>home</title>
  <!-- icon scout cdn -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/map.css">
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

<main>
<div class="container_vi">
  <div class="container">
    <!-----------------------left-------------------->
    <div class="left">
      <a class="profile">
      {if $user !== null}
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
            <p class="text-muted">
              @{$user->getName()}
            </p>
          </div>
      {else}
        <div class="profile-photo">
              <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
        </div>
        <div class ="handle">
          <h4>Guest User</h4>
          <p class="text-muted">
            Log in
          </p>
        </div>
      {/if}
      </a>
      <!-----------------------SIDE BAR-------------------->
      <div class="sidebar">
      <label class="menu-items tex-bold">
      <button class="btn-transparent" onclick="location.href='/Agora/User/home'"> <i class="uil uil-home"></i></button> Home
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
      {if $post->getUser()->isBanned()}
        <div class="tex-bold feed" style="font-size:18px; color:red">This User is Banned!</div>
      {else}
      <div class="feed">
      <div class="head">
        <div class="user">
          <div class="profile-photo">
              <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
          </div>
          <div class="ingo">
            <div>
              <a href="/Agora/Post/visit/{$post->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post->getTitle()}</a>
            </div>
            <small>{$post->getTime()->format('Y-m-d H:i:s')}</small>
          </div>
        </div>
          <div style="background: linear-gradient(45deg, violet, indigo, blue, green, yellow, orange, red);-webkit-background-clip: text;background-clip: text;color: transparent;font-weight: bold;">{$post->getCategory()}</div>
      </div>
        <div class="caption">
            <!-- Smarty tag for username -->
            <p><b>{$post->getUser()->getUsername()}</b><span class="harsh-tag">
            {$post->getDescription()}</span></p>
        </div>
        {if count($post->getImages()) === 0}
            
          {else}
            <div class="photo">
              {foreach from=$post->getImages() item=i}
                  <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img">
              
              {/foreach}
            </div>
          {/if}
          
        <div class="action-buttons">
        {if $checkLike == true}
            <div class="interaction-buttons">
                <form id="like" action="/Agora/Post/deleteLike/{$post->getId()}" method="post">
                    <button class="like-button btn-transparent"  style="color:red; font-size:24px;width:40px;height:40px;padding:5px;"><i class="uil uil-heart"></i> </button>
                </form>
            </div>
        {else}
          <div class="interaction-buttons">
            <form id="like" action="/Agora/Post/settingLike/{$post->getId()}" method="post">
              <button class="like-button btn-transparent"  style="font-size:24px;width:40px;height:40px;padding:5px;"><i class="uil uil-heart"></i> </button>
            </form>
          </div>
        {/if}
            <div class= "interaction-buttons " id="report">
                <button type = "button" class="btn btn-transparent"><i class = "uil uil-exclamation-triangle" > </i> </button>
            </div>
        </div>

        <div class="liked-by"> <!--FARE QUERY PER PRENDERE L'IMM PROFILO DEGLI  ULTIMI 3 UTENTI CHE HANNO MESSO MI PIACE -->
            {for $i=0; $i<3;$i++}
            <span><img src="/Agora/libs/Smarty/immagini/A.png" alt=""></span>
            {/for}
            <!-- Smarty tag for username --> 
            <p> liked by <a href="/Agora/Post/like/{$post->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$numericInfo[0]} user</a> </p>
        </div>

          <div class="comments">
            <div class="head-comment">
              <div class=" action-buttons">
                <span><i class="uil uil-comment-dots"></i></span>
              </div>
              <h3  class="tex-bold">comments</h3>
            </div>

            {foreach $comments as $comment}
              <div class="comment">
                <div class="head">
                  <div class="user">
                  {if $comment[1]->getSize() > 0}
                    <div class="profile-photo">  
                        <img src="data:{$comment[1]->getType()};base64,{$comment[1]->getEncodedData()}" alt="Img">
                    </div>
                  {else}
                    <div class="profile-photo">
                        <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                    </div>
                  {/if}
                    <div class="ingo">
                    {if $comment[0]->getUser()->isVip()}
                      <a href="/Agora/User/profile/{$comment[0]->getUser()->getUsername()}"class="vip"> {$comment[0]->getUser()->getUsername()}<i class='uil uil-star' style='font-size:medium'></i> </a>
                    {else}
                      <a href="/Agora/User/profile/{$comment[0]->getUser()->getUsername()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> {$comment[0]->getUser()->getUsername()}</a>
                    {/if}
                      <small>{$comment[0]->getTime()->format('Y-m-d H:i:s')}</small>
                    </div>
                  </div>

                  <div class="body-comment">
                    <b>{$comment[0]->getBody()}</b>
                  </div>
                </div>
                <form id="report" action="/Agora/Report/reportComment/{$comment[0]->getId()}" method="post">
                      <button class="btn btn-transparent" id="delete"><i class="uil uil-exclamation-triangle" style="color:red"></i></button>
                </form>
              </div>
            {/foreach}

            <div class="send-comment">
              <form id="comment-post"  action="/Agora/Comment/createComment/{$post->getId()}"  method="post">
              <label class="left-transition ">
                <input type="text" name ='body'placeholder="write a comment" required>
              </label>
                <label class="btn btn-primary left-transition">send
                  <button type="submit" class="btn-transparent"></button>
                </label>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!----------------END OF FEEDS------------------------------>
    <!-----------------------END OF MIDDLE---------------------------->


    <!-----------------------right-------------------->
    <div class="right">
      <div class="side-profile">
        <div class="heading">
        {if $visitedUserPic->getSize() > 0}
          <div class="profile-photo">  
              <img src="data:{$visitedUserPic->getType()};base64,{$visitedUserPic->getEncodedData()}" alt="Img">
          </div>
        {else}
          <div class="profile-photo">
              <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
          </div>
        {/if}
          <div class ="handle">
          {if $post->getUser()->isVip()}
            <a href="/Agora/User/profile/{$post->getUser()->getUsername()}" class='vip'> {$post->getuser()->getUsername()} <i class='uil uil-star' style='font-size:medium'></i> </a>
          {else}
            <a href="/Agora/User/profile/{$post->getUser()->getUsername()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> {$post->getUser()->getUsername()} </a>
          {/if}
            <p class="text-muted">{$post->getUser()->getName()}</p>
          </div>
          <div>
            <a href="/Agora/User/followed/{$post->getUser()->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$numericInfo[1]}</a>
            <p class="text-muted">
              followers
            </p>
          </div>
          <div>
          <a href="/Agora/User/followers/{$post->getUser()->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$numericInfo[2]}</a>
            <p class="text-muted">following</p>
          </div>
        </div>
      {if $user !== null}
        {if $user->getId() !== $post->getUser()->getId()}
          {if $followCheck == true}
            <form id='unfollow' action="/Agora/User/unfollow/{$post->getUser()->getId()}" method="post">
              <button class="btn-primary btn">Unfollow</button>
            </form>
          {elseif $followCheck == false}
            <form id='follow' action="/Agora/User/follow/{$post->getUser()->getId()}" method="post">
              <button class="btn-primary btn">Follow</button>
            </form>
          {/if}
        {else}
        {/if}
      {else}
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
              <h5>{$post->getUser()->getBio()}</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-moneybag"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Working </h5>
            <div class="text-muted">
              <h5>{$post->getUser()->getWorking()}</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-graduation-cap"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Studied at</h5>
            <div class="text-muted">
              <h5>{$post->getUser()->getStudiedAt()}</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-hourglass"></i>
          <div class="bio-body">
            <h5 class="tex-bold">Hobby</h5>
            <div class="text-muted">
              <h5>{$post->getUser()->getHobby()}</h5>
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

<!-----------------REPORT MODAL----------------------------------->


<div class="report">
<div class="card">
    <h2>Report</h2>
    <h3 class="text-muted">Why are you reporting this post?</h3>
    <form id="report"  action="/Agora/Report/reportPost/{$post->getId()}" method="post">

        <div class="report-checkbox">
            <input type="radio" required id="violence" name='type' value="violence">
            <label for="violence">violence</label>
        </div>
        <div class="report-checkbox">
            <input type="radio"  required id="gambling" name='type' value="gambling">
            <label for="gambling">gambling</label>
        </div>
        <div class="report-checkbox">
            <input type="radio" required id="inappropriate or offending" name='type' value="inappropriate or offending">
            <label for="inappropriate or offending">inappropriate or offensive</label>
        </div>
        <div class="report-checkbox">
            <input type="radio" required id="suspicious activities" name='type' value="suspicious activities">
            <label for="suspicious activities">suspicious activities</label>
        </div>
        <div class="report-checkbox">
            <input type="radio" required id="pornography" name='type' value="pornography">
            <label for="pornography">pornography</label>
        </div>
        <div>
            <h3 class="text-muted">Write a small description why you're reporting this post</h3>
            <label>
                <textarea class="text-area" name='description'></textarea>
            </label>
        </div>
        <label>
            <button type="submit" class="btn btn-primary" style="margin-top: 1%">Send</button>
        </label>
        
    </form>
    <label>
      <button onclick="location.reload()" class="btn btn-primary" style="margin-top: 1%">cancel</button>
    </label>
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
<script src="/Agora/libs/Smarty/js/report.js"></script>
</body>
</html>