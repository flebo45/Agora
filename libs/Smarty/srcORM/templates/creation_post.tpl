<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>creation post</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">
  <script src="/Agora/libs/Smarty/js/test.js"></script>
  <!-- stylesheet -->
  <link rel="stylesheet" href="/Agora/libs/Smarty/css/normalize.css">
  <link rel="stylesheet" href="/Agora/libs/Smarty/css/style.css">
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
<div class="container_crea">
  <div class="container">
    <h2 class="log">Agorà</h2>
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
      <img src="/Agora/libs/Smarty/immagini/2.png" alt="">
    </div>
  </div>
</nav>
<!---------------------------------MAIN------------------------------------>
<main>
<div class="container_crea">
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
          <h4>{$user->getUsername()}</h4>
          <p class="text-muted">{$user->getName()}</p>
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
        <label class="menu-items  tex-bold" id="theme">
            <span> <i class="uil uil-palette"></i></span>Theme
        </label>
        <label class="menu-items tex-bold " >
            <button class="btn-transparent" onclick="location.href='/Agora/User/settings'"><i class="uil uil-setting"></i> </button>Setting
        </label>
      </div>
  </div>
  <!--------------------END OF SIDE BAR----------------->


    <!-----------------------END OF LEFT-------------------->

    <!---------------------CREATION POST------------------------>
    <div class="creation">
      <div class="form-box">
        <div class="tex-bold">
          <h3>New Post</h3>
        </div>
        <form id="creation-post"  action="/Agora/Post/createPost" enctype="multipart/form-data" method="post">
          <h4 class="tex-bold left-transition" >Title</h4>
          <label for="post-title">
            <input type="text" id="post-title" placeholder="Title" name="title" class="text" required>
          </label>
          <h4 class="tex-bold left-transition">Body</h4>
          <label for="post-body">
            <textarea id="post-body" class="text-area" placeholder="Body" name="description" required></textarea>
          </label>
          <div>
            <label class="custom-btn">
          <input type="file" name="imageFile[]" id="image-input" class="image-input" accept=".png, .jpg, .jpeg" multiple>Selec Img</label>
          </div>
          <div>
              <label for="topic">
                <h4 class="tex-bold " style="margin-left: 5%; margin-top: 1rem;">Topic</h4>
              <select name="category" id="topic" style="width: fit-content"required>
                <option></option>
                <option value="Animals">Animals</option>
                <option value="Arts">Arts</option>
                <option value="Books">Books</option>
                <option value="Cars">Cars</option>
                <option value="Cinema">Cinema</option>
                <option value="Cooking">Cooking</option>
                <option value="Gaming">Gaming</option>
                <option value="Gardening">Gardening</option>
                <option value="Home">Home</option>
                <option value="News">News</option>
                <option value="Photography">Photography</option>
                <option value="School">School</option>
                <option value="Sport">Sport</option>
                <option value="Travel">Travel</option>
                <option value="Technology">technology</option>

              </select>
            </label>
          </div>
          <div>
            <label class=" btn btn-primary">
                <button type="submit" class="btn-transparent" >Save</button>
            </label>
          </div>
        </form>

        <div>
        <button class="btn btn-primary" onclick="location.href='/Agora/User/home'">Cancel</button>
        </div>
      </div>
    </div>
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
  <script src="/Agora/libs/Smarty/js/sidebar2.js"></script>
<script src="/Agora/libs/Smarty/js/report.js"></script>
</body>
</html>