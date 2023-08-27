<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width = device-width, initial-scale = 1.0">
  <title>personalUser</title>
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
                    <h4>{$user->getUsername()}</h4>
                    <p class="text-muted">{$user->getName()}
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
       
              <label class="menu-items active tex-bold">
                <span><i class="uil uil-user-circle"></i></span> Profile
              </label>
                <label class="tex-bold theme-cust"  id="theme">
                    <span> <i class="uil uil-palette"></i></span>Theme
                </label>
              <label class="menu-items tex-bold" >
                <button class="btn-transparent" onclick="location.href='/Agora/User/settings/0'">  <i class="uil uil-setting"></i></button>Setting
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
                {foreach $postList as $post}
                <div class="feed">
                  <div class="head">
                    <div class="user">
                      <div class="profile-photo">
                        <img src="/Agora/Smarty/immagini/A.png" alt="img"> <!--IMMAGINE PROFILO UTENTE-->
                      </div>
                      <div class="ingo">
                        <h3>{$post->getTitle()}</h3>
                        <small>{$post->getTime()->format('Y-m-d H:i:s')}</small>
                      </div>
                    </div>
                      <label>
                              <button class="btn-transparent" id="edit" type="button">  <i class="uil uil-ellipsis-h"></i></button>
                      </label>
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
                            <span><i class="uil uil-heart"></i> </span>
                            <span><i class="uil uil-comment-dots"></i></span>
                        </div>
                    </div>

                    <div class="liked-by"> <!--FARE QUERY PER PRENDERE L'IMM PROFILO DEGLI  ULTIMI 3 UTENTI CHE HANNO MESSO MI PIACE -->
                        {for $i=0; $i<3;$i++}
                        <span><img src="/Agora/Smarty/immagini/A.png" alt=""></span>
                        {/for}
                        <!-- Smarty tag for username -->
                        <p> liked by <b>{$post->getUser()->getUsername()}</b> and <b> n user </b></p> <!-- PRENDERE L'ULTIMO UTENTE CHE HA MESSO MI PIACE -->
                    </div>

                    <div class=" comments text-muted">view all the comment</div>
                </div>
                {/foreach}
                <!----------------END OF FEED------------------------------>
            </div>
            <!----------------END OF FEEDS------------------------------>
        </div>

    <!-----------------------END OF MIDDLE---------------------------->



    <!-----------------------right-------------------->
    <div class="right">
      <div class="side-profile">
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
</main>


<!-------------------EDIT MODAL----------------------------------------->


<div class="edit">
  <div class="card">
    <label>
      <button class="btn btn-transparent"  onclick="location.href='Agora/user/creation_post'"><i class="uil uil-wrench">Modify</i></button>
    </label>
    <label>
      <button class="btn btn-transparent" id="delete"><i class="uil uil-trash-alt"></i>Delete</button>
    </label>
  </div>
</div>


<!------------------CONFIRM DELETE------------------------------>

<div class="delete">
  <div class="card">
    <h2>Are you sure you want to delete this post?</h2>
    <div>
      <label>
        <button class="btn-transparent btn">Yes</button>
      </label>
      <label>
        <button class="btn-transparent btn">No</button>
      </label>
    </div>
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
<script src="/Agora/smarty/js/edit.js"></script>
</body>
</html>