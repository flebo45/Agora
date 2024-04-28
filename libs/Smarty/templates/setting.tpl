<!doctype html>
<html lang="eng">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/Smarty/immagini/A.png">
  <script src="/Agora/Smarty/js/test.js"></script>
  <!-- stylesheet -->
  <link rel="stylesheet" href="/Agora/Smarty/css/normalize.css">
  <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
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
    <div class="tex-bold">
      <h3>SETTIINGS <i class="uil uil-setting"></i></h3>
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

<!-- START OF SETTING -->
<main>
 <div class="bigContainer">
  <div class="container">
    <!-----------------------left-------------------->
    <div class="left">
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
        <label class="menu-items active tex-bold " >
          <button class="btn-transparent" onclick="location.href='/Agora/User/settings'"><i class="uil uil-setting"></i> </button>Setting
        </label>
      </div>
      <!--------------------END OF SIDE BAR----------------->
      <label class="btn btn-primary">create post
        <button class="btn-transparent" onclick="location.href='/Agora/Post/createPost'"></button>
      </label>
    </div>


    <!-----------------------END OF LEFT-------------------->


    <div class="box-setting">
    <form enctype="multipart/form-data" action="/Agora/User/setProPic" method="post" >
    {if $userPic->getSize() > 0}
      <div class="profile-photo">  
          <img src="data:{$userPic->getType()};base64,{$userPic->getEncodedData()}" alt="Img">
      </div>
    {else}
      <div class="profile-photo">
          <img src="/Agora/Smarty/immagini/1.png" alt="">
      </div>
    {/if}
      {if $errorImg == true}
        <div style="color:red; margin-left: 47%">Invalid input</div>
      {/if}
      <div class="conte">
        <label class="custom-btn btn">
          <input type="file" name="imageFile" class="image-input" accept="image/*">
          change img
        </label>
        <label class=" btn btn-primary">Save
          <button type="submit" class="btn-transparent"></button>
        </label>
      </div>

    </form>
    <form enctype="multipart/form-data" action="/Agora/User/setUserInfo" method="post" >
      <div class="info-profile">
        <h4 class="tex-bold" >Biography</h4>
        <label>
          <input type="text" class="text" name="Bio" value="{$user->getBio()}">
        </label>
        <h4 class="tex-bold" >Work at</h4>
        <label>
          <input type="text" class="text" name="Working" value="{$user->getWorking()}">
        </label>
        <h4 class="tex-bold" >Studied at</h4>
        <label>
          <input type="text" class="text" name="StudiedAt" value="{$user->getStudiedAt()}">
        </label>
        <h4 class="tex-bold" >Hobby</h4>
        <label>
          <input type="text" class="text" name="Hobby" value={$user->getHobby()}>
        </label>
        <div>

          <label class=" btn btn-primary">Save
            <button type="submit" class="btn-transparent"></button>
          </label>
          <label>
            <button type="reset" class="btn btn-primary">Delete</button>
          </label>
        </div>
        </form>
        <form enctype="multipart/form-data" action="/Agora/User/setUsername" method="post" >
        <h4 class="tex-bold" >UserName</h4>
          {if $error == true}
          <div style="color: red ; margin-left: 4%">Username already taken</div>
          {/if}
        <label>
          <input type="text" class="text" maxlength="15" minlength="3" name="username" value={$user->getUsername()} >
        </label>
        <label class=" btn btn-primary">Save
          <button type="submit" class="btn-transparent"></button>
        </label>
        <label>
          <button type="reset" class="btn btn-primary">Delete</button>
        </label>
      </form>
      <form enctype="multipart/form-data" action="/Agora/User/setPassword" method="post" >
        <h4 class="tex-bold">Password</h4>
        <label>
          <input type="password" id="password" class="text" name="password" placeholder="NewPassword">
        </label>
        <h4 class="tex-bold">Confirm Password</h4>
        <label>
          <input type="password" id="confirmPassword" class="text" name='confirmPassword' placeholder="Confirm Password">
        </label>
        <p id="passwordMatchError" class="error-text">Password Not Match</p>
        <div>
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="reset" class="btn btn-primary">Delete</button>
        </div>
      </form>
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
</main>
<script src="/Agora/Smarty/js/checkPassword.js"></script>
<script src="/Agora/Smarty/js/sidebar2.js"></script>
</body>
</html>