<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>{$pageTitle}</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="Img/A.png">

  <!-- stylesheet -->
  <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
</head>
<body>


<nav>
  <div class="container">
    <h2 class="log">Agora</h2>
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
      <img src="Img/A.png" alt="">
    </div>
  </div>
</nav>


<!------------------------------------------------------
                  RESULT FOR SEARCH
----------------------------------------------------->
<main>

  <div class="result">
    <h3 class="text-muted">Result for : {$keyWord}</h3>
  </div>
  {if is_null($resultPost)}
    <div class="result" style="margin-top: 2%">There are no post with this title, try something else</div>
    {else}
  {foreach $resultPost as $post}
  <div class="result" style="margin-top: 2%">
    <div class="left">
      <h3>Post</h3>
        <div class="profile">
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
            <h4> {$post->getUser()->getUsername()} </h4>
            <p class="text-muted">
              @{$post->getuser()->getUsername()}
            </p>
          </div>
        </div>
      <div>
      <h3>Title</h3>
        <a href="/Agora/Post/visit/{$post->getId()}" class="search"> {$post->getTitle()}</a>
          </div>
        <div>
      </div>
    </div>
    {/foreach}
    {/if}
    {if is_null($resultProfile)}
    <div class="result" style="margin-top: 2%">There are no user with this username, try something else</div>
    {else}
{foreach $resultProfile as $user}
    <div class="right">
      <div class="list-profile">
        <div>
        <h3>User</h3>
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
            <a href="Agora/User/profile/{$user->getUsername()}"> {$user->getUsername()} </a>
            <p class="text-muted">
              @{$user->getName()}
            </p>
          </div>
        </div>
      </div>
    </div>
    {/foreach}
      {/if}
  </div>
</main>