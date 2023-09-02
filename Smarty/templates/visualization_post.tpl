<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
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
  {literal}
    <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
  {/literal}
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
    <form  action="/Agora/User/logout" method="post">
      <div>
        <button class="btn btn-primary" type="submit">Log out</button>
      </div>
    </form>
    <div class="profile-photo">
      <img src="/Agora/Smarty/immagini/1.png" alt="">
    </div>
  </div>
</nav>

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
            <img src="/Agora/Smarty/immagini/1.png" alt="">
        </div>
      {/if}
        <div class ="handle">
          <h4> {$user->getUsername()}</h4>
          <p class="text-muted">
            {$user->getName()}
          </p>
        </div>
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
          <button class="btn-transparent" onclick="location.href='/Agora/User/settings/0'"><i class="uil uil-setting"></i> </button>Setting
      </label>
  </div>
  <!--------------------END OF SIDE BAR----------------->
  <label class="btn btn-primary">create post
      <button class="btn-transparent" onclick="location.href='/Agora/Post/createPost'"></button>
  </label>
</div>


    <!-----------------------END OF LEFT-------------------->


    <!-----------------------middle-------------------->
    <div class="middle">
      <!----------------FEEDS-------------------------------->
      <div class="feeds">
      <div class="feed">
      <div class="head">
        <div class="user">
        {if $userPic->getSize() > 0}
          <div class="profile-photo">  
              <img src="data:{$userPic->getType()};base64,{$userPic->getEncodedData()}" alt="Img">
          </div>
        {else}
          <div class="profile-photo">
              <img src="/Agora/Smarty/immagini/1.png" alt="">
          </div>
        {/if}
          <div class="ingo">
            <div>
              <a href="/Agora/Post/visit/{$post->getId()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post->getTitle()}</a>
            </div>
            <small>{$post->getTime()->format('Y-m-d H:i:s')}</small>
          </div>
        </div>
      </div>
        <div class="caption ">
            <!-- Smarty tag for username -->
            <p><b>{$post->getUser()->getUsername()}</b><span class="harsh-tag">
            {$post->getDescription()}</span></p>
        </div>
        {if $post->getImages()->count() === 0}
            
          {else}
            <div class="photo">
              {foreach from=$post->getImages() item=i}
                  <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img">
              
              {/foreach}
            </div>
          {/if}

        <div class="action-buttons">
            <div class="interaction-buttons">
                <span>
                    <button class="like-button btn-transparent" data-id="{$post->getId()}" style="font-size:24px;width:40px;height:40px;padding:5px;"><i class="uil uil-heart"></i> </button>
                </span>
            </div>

            <div class= "interaction-buttons " id="report">
                <button type = "button" class="btn btn-transparent"><i class = "uil uil-exclamation-triangle" > </i> </button>
            </div>
        </div>

        <div class="liked-by"> <!--FARE QUERY PER PRENDERE L'IMM PROFILO DEGLI  ULTIMI 3 UTENTI CHE HANNO MESSO MI PIACE -->
            {for $i=0; $i<3;$i++}
            <span><img src="/Agora/Smarty/immagini/A.png" alt=""></span>
            {/for}
            <!-- Smarty tag for username -->
            <p> liked by <b>{$likeNumb} user</b> </p> <!-- PRENDERE L'ULTIMO UTENTE CHE HA MESSO MI PIACE -->
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
                    <div class="profile-photo">
                      <img src="Img/A.png" alt="img">
                    </div>
                    <div class="ingo">
                      <h3> {$comment->getUser()->getUsername()} </h3>
                      <small>{$comment->getTime()->format('Y-m-d H:i:s')}</small>
                    </div>
                  </div>

                  <div class="body-comment">
                    <b>{$comment->getBody()}</b>
                  </div>
                </div>
              </div>
            {/foreach}

            <div class="send-comment">
              <form id="comment-post"  action="/Agora/Post/visit/{$post->getId()}"  method="post">
              <label class="left-transition ">
                <input type="text" name ='body'placeholder="write a comment">
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
        <div class="profile-photo">
            <img src="/Agora/Smarty/immagini/1.png" alt="">
        </div>
          <div class ="handle">
            <h4> {$post->getUser()->getUsername()} </h4>
            <p class="text-muted">{$post->getUser()->getName()}</p>
          </div>
          <div>
            <h4>{$post->getUser()->getId()}</h4>
            <p class="text-muted">
              followers
            </p>
          </div>
          <div>
            <h4>{$post->getUser()->getId()}</h4>
            <p class="text-muted">following</p>
          </div>
        </div>

        <button class="btn-primary btn" onclick="toggle(this)">follow</button>
        <script>
          function toggle(e) {
            let txt = e.innerText;
            e.innerText = txt === 'Follow' ? 'Unfollow' : 'Follow';
          }
        </script>

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
  </div>
</main>

<!-----------------REPORT MODAL----------------------------------->


<div class="report">
<div class="card">
    <h2>Report</h2>
    <h3 class="text-muted">Why are you reporting this post?</h3>
    <form id="report"  action="/Agora/Post/report/{$post->getId()}" method="post">

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
<script src="/Agora/Smarty/js/Sidebar.js"></script>
<script src="/Agora/Smarty/js/report.js"></script>
<script src="/Agora/Smarty/js/like.js"></script>
</body>
</html>