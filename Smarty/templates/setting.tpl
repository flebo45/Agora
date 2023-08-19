<!doctype html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="eng">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>$pageTitle</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="Img/A.png">

  <!-- stylesheet -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
  <div class="container">
    <h2 class="log">
      {$siteName}
    </h2>
    <div class="tex-bold">
      <h3>{$settingsTitle} <i class="uil uil-setting"></i></h3>
    </div>
    <div class="profile-photo">
      <img src="Img/2.png" alt="">
    </div>
  </div>
</nav>

<!-- START OF SETTING -->
<main>
  <form enctype="multipart/form-data" id="change-info" >
    <div class="box-setting">
      <div class="profile-photo">
        <img src="Img/A.png" alt=" log in">
      </div>
      <div>
        <label class="custom-btn btn">
          <input type="file" name="image" id="" class="image-input" accept="image/*">
          {$changeProfilePic}
        </label>
      </div>
      <div class="info-profile">
        <h4 class="tex-bold" >{$nameLabel}</h4>
        <label>
          <input type="text" class="text"  placeholder="{$namePlaceholder}">
        </label>
        <h4 class="tex-bold" >{$bioLabel}</h4>
        <label>
          <input type="text" class="text"  placeholder="{$bioPlaceholder}">
        </label>
        <h4 class="tex-bold" >{$workLabel}</h4>
        <label>
          <input type="text" class="text"  placeholder="{$workPlaceholder}">
        </label>
        <h4 class="tex-bold" >{$studyLabel}</h4>
        <label>
          <input type="text" class="text"  placeholder="{$studyPlaceholder}">
        </label>
        <h4 class="tex-bold" >{$hobbyLabel}</h4>
        <label>
          <input type="text" class="text"  placeholder="{$hobbyPlaceholder}">
        </label>
        <h4 class="tex-bold" >{$liveLabel}</h4>
        <label>
          <input type="text" class="text"  placeholder="{$livePlaceholder}">
        </label>
        <h4 class="tex-bold " >{$emailLabel}</h4>
        <label>
          <input type="text" class="text"  placeholder="{$emailPlaceholder}">
        </label>
        <h4 class="tex-bold " >{$usernameLabel}</h4>
        <label>
          <input type="text" class="text" placeholder="{$usernamePlaceholder}">
        </label>
        <h4 class="tex-bold" >{$passwordLabel}</h4>
        <label>
          <input type="password" class="text" placeholder="{$newPasswordPlaceholder}">
        </label>
        <h4 class="tex-bold" >{$passwordLabel}</h4>
        <label>
          <input type="password" class="text" placeholder="{$confirmPasswordPlaceholder}">
        </label>
        <div>

          <label class=" btn btn-primary">{$saveButtonLabel}
            <button type="submit" class="btn-transparent"></button>
          </label>
          <label>
          <button type="button" class="btn btn-primary" onclick="location.href='index.html'">{$cancelButtonLabel}</button>
          </label>
        </div>
      </div>
    </div>
  </form>
</main>
</body>
</html>