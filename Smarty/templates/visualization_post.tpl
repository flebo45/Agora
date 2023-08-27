<!doctype html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="eng">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>post</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/Smarty/immagini/A.png">

  <!-- stylesheet -->
  <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
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


<main>
  <div class="container">
    <!-----------------------left-------------------->
    <div class="left">
      <a class="profile">
        <div class="profile-photo">
          <img src="Img/A.png" alt=" log in">
        </div>
        <div class ="handle">
          <h4> {$personalUser->getUsername()}</h4>
          <p class="text-muted">
            {$personalUser->getName()}
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
      <button class="btn-transparent" onclick="location.href='/Agora/ManagePost/createPost'"></button>
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
              <div class="profile-photo">
                <img src="Img/A.png" alt="img">
              </div>
              <div class="ingo">
                <h3>{$feedTitle}</h3>
                <small>{$feedTime}</small>
              </div>
            </div>
            <span class="edit">
              <i class="uil uil-ellipsis-h"></i>
            </span>
          </div>

          <div class="caption ">
            <p><b>{$username}</b>
              <span class="harsh-tag">{$tag}
                {$feedContenti}
            </span></p>
          </div>

          <div class="photo">
            {foreach $feedImages as $image}
              <img src="{$image}" alt="img">
            {/foreach}
          </div>

          <div class="action-buttons">
            <div class="interaction-buttons">
              <span><i class="uil uil-heart"></i> </span>
            </div>
          </div>

          <div class="liked-by">
            {foreach $likedByUsers as $likedUser}
              <span><img src="{$likedUser}" alt=""></span>
            {/foreach}
            <p> {$likedByText} <b> {$likedByUsernames}</b> {$likedByAnd} <b> {$likeByCount} </b></p>
          </div>

          <div class="comments">
            <div class="head-comment">
              <div class=" action-buttons">
                <span><i class="uil uil-comment-dots"></i></span>
                </div>
              <h3  class="tex-bold">{$commentsLabel}</h3>
            </div>

            {foreach $comments as $comment}
              <div class="comment">
                <div class="head">
                  <div class="user">
                    <div class="profile-photo">
                      <img src="Img/A.png" alt="img">
                    </div>
                    <div class="ingo">
                      <h3> {$comment.username} </h3>
                      <small>{$comment.time}</small>
                    </div>
                  </div>

                  <div class="body-comment">
                    <b>{$comment.commentText}</b>
                  </div>
                </div>
              </div>
            {/foreach}

            <div class="send-comment">
              <form>
              <label class="left-transition ">
                <input type="text" placeholder="{$writeCommentPlaceholder}">
              </label>
                <label class="btn btn-primary left-transition">{$sendButtonLabel}
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
            <img src="Img/A.png" alt=" log in">
          </div>
          <div class ="handle">
            <h4> {$user->getUsername()} </h4>
            <p class="text-muted">
              {$user->getName()}
            </p>
          </div>
          <div>
            <h4> {$user->getFollowerNumber()}</h4>
            <p class="text-muted">Followers</p>
          </div>
          <div>
            <h4>{$user->getFollowedNumber()}</h4>
            <p class="text-muted">Followed by</p>
          </div>
        </div>


        <!----------------------DESCRIPTION-------------------->
        <div class="title">
          <h6>About me</h6>
        </div>

        <div class="bio">
          <i class="uil uil-chat-bubble-user"></i>
          <div class="bio-body">
            <h5 class="text-bold">{$user->getBio()}</h5>
            <div class="text-muted">
              <h5>Bio</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-moneybag"></i>
          <div class="bio-body">
            <h5 class="tex-bold">{$user->getWorking()}</h5>
            <div class="text-muted">
              <h5>Working</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-graduation-cap"></i>
          <div class="bio-body">
            <h5 class="tex-bold">{$user->getStudiedAt()}</h5>
            <div class="text-muted">
              <h5>Studied At</h5>
            </div>
          </div>
        </div>

        <div class="bio">
          <i class="uil uil-hourglass"></i>
          <div class="bio-body">
            <h5 class="tex-bold">{$user->getHobby()}</h5>
            <div class="text-muted">
              <h5>Hobby</h5>
            </div>
          </div>
        </div>
      </div>


      <!--------------------------TOP POST---------------------------->
      <div class="top-post">
        <div class="heading">
          <h5 class="text-muted left-transition">{$youCanAlsoReadLabel}</h5>
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
                <p class="text-muted">{$post.likes}</p>
              </div>
            </div>
          </div>
        {/foreach}

        
      </div>
      <!----------------------END OF DESCRIPTION--------------------->

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
<script src="/Agora/Smarty/js/Sidebar.js"></script>
<script src="/Agora/Smarty/js/report.js"></script>
</body>
</html>