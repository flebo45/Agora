<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>userPage</title>
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
      <h2 class="log">Agorà</h2>
      <div class="search-bar">
        <i class ="uil uil-search"></i>
        <label>
          <input type ="search" placeholder="search for post or users">
        </label>
      </div>
      <div>
        <button class="btn btn-primary">Log out</button>
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
                    <h4>{$personalUser->getUsername()}</h4>
                    <p class="text-muted">{$personalUser->getName()}
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
                          </div>
                          {/foreach}
                      {/if}

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
        <div class="heading">
          <div class="profile-photo">
            <img src="/Agora/Smarty/immagini/A.png" alt=" log in">
          </div>
          <div class ="handle">
            <h4> {$user->getUsername()} </h4>
            <p class="text-muted">{$user->getName()}</p>
          </div>
          <div>
            <h4>{$user->getFollowedNumber()}</h4>
            <p class="text-muted">
              followers
            </p>
          </div>
          <div>
            <h4>{$user->getFollowerNumber()}</h4>
            <p class="text-muted">following</p>
          </div>
        </div>

        <!--<button class="btn-primary btn" onclick="toggle(this)">{$followButtonText}</button>
        <script>
          function toggle(e) {
            let txt = e.innerText;
            e.innerText = txt === 'Follow' ? 'Unfollow' : 'Follow';
          }
        </script>-->
        <button class="btn-primary btn" onclick="">follow button</button>


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


        <!--------------------------TOP POST---------------------------->
        <div class="top-post">
          <div class="heading">
            <h4>Top Post</h4>
            <i class="uil uil-award"> </i>
          </div>

          {foreach $topPosts as $post}
          <div class="post">
            <div class="info">
                <div class="first-photo">
                  <img src="Img/A.png" alt="img">
                </div>
              <div>
                <h5>{$post.title}</h5>
                <p class="text-muted">{$post.likesCount}</p>
              </div>
            </div>
          </div>
          {/foreach}
        </div>
      <!----------------------END OF DESCRIPTION--------------------->

      </div>
    </div>
</main>


<!-------------------EDIT MODAL----------------------------------------->


<div class="edit">
  <div class="card">
    <label>
      <button class="btn btn-transparent"  onclick="location.href='creation-post.html'"><i class="uil uil-wrench">Modify</i></button>
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

<!-----------------REPORT MODAL----------------------------------->


<div class="report">
  <div class="card">
    <h2>Report</h2>
    <h3 class="text-muted">Why are you reporting this post?</h3>
    <form>
        {foreach $reportReasons as $reason}
        <div class="report-checkbox">
        <input type="checkbox" id="violence" value="violence">
        <label for="violence">{$reasonName}</label>
        </div>
        {/foreach}
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
</body>
</html>