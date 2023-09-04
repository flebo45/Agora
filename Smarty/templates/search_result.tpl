<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width-device-width, initial-scale-1.0">
  <title>Agorà</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="Img/A.png">

  <!-- stylesheet -->
  <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
</head>
<body>


<nav>
  <div class="container">
    <a href="/Agora/User/home" class="log" style="text-decoration: none; color: inherit; font-size: 1.5rem; font-weight : bold" >Agorà</a>
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
    <h3 class="text-muted">Result for : {$keyword}</h3>
  </div>
  {if count($searchedPost) === 0}
    <div class="result" style="margin-top: 2%">There are no post with this title, try something else</div>
    {else}
  {foreach $searchedPost as $post}
  <div class="result" style="margin-top: 2%">
    <div class="left">
      <h3>Post</h3>
        <div class="profile">
          {if $postUserPic[$post->getId()]->getSize() > 0}
            <div class="profile-photo">
              <img src="data:{$postUserPic[$post->getId()]->getType()};base64,{$postUserPic[$post->getId()]->getEncodedData()}" alt="Img">
            </div>
          {else}
            <div class="profile-photo">
              <img src="/Agora/Smarty/immagini/1.png" alt="">
            </div>
          {/if}
          <div class ="handle">
            <h4> {$post->getUser()->getUsername()} </h4>
            <p class="text-muted">
              @{$post->getuser()->getName()}
            </p>
          </div>
        </div>
      <div>
      <h3>Title</h3>
        <a href="/Agora/Post/visit/{$post->getId()}" class="search" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> {$post->getTitle()}</a>
          </div>
        <div>
      </div>
    </div>
  {/foreach}
  {/if}
    {if count($searchedUser) === 0}
    <div class="result" style="margin-top: 2%">There are no user with this username, try something else</div>
    {else}
{foreach $searchedUser as $user}
    <div class="right">
      <div class="list-profile">
        <div>
        <h3>User</h3>
          {if $userPic[$user->getId()]->getSize() > 0}
            <div class="profile-photo">
              <img src="data:{$userPic[$user->getId()]->getType()};base64,{$userPic[$user->getId()]->getEncodedData()}" alt="Img">
            </div>
          {else}
            <div class="profile-photo">
              <img src="/Agora/Smarty/immagini/1.png" alt="">
            </div>
          {/if}
          <div class ="handle">
            <a href="/Agora/User/profile/{$user->getUsername()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> {$user->getUsername()} </a>
            <p class="text-muted">
              @{$user->getName()}
            </p>
          </div>
        </div>
      </div>
  {/foreach}
    </div>

        {/if}
  </div>
</main>