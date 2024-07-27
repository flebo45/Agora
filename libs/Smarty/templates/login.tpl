<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <!-- icon scout cdn -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">

  <!-- stylesheet -->
  <link rel="stylesheet" type="text/css" href="/Agora/libs/Smarty/css/style.css">
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

  <div class="box">
    <div class="form-box">
      <div class="button-box">
        <div id="btn-log"> </div>
          <button type="button" class="toggle-btn" onclick="login()">Log In</button>
          <button type="button" class="toggle-btn" onclick="register()">Register</button>
      </div>
      <div class="tex-bold">
        <h3>Agorà</h3>
      </div>
      <!------------FORM PER IL LOG IN------------------------------>
      {if $error == true}
        <p style="color: red; margin-left: 11%">username or password incorrect</p>
        {/if}
      {if $ban == true}
        <p style="color: red; margin-left: 7%">the user you are trying to access is banned</p>
        {/if}
        {if $regErr == true}
          <p style="color: red; margin-left: 7%">email or username is already taken</p>
          {/if}
      <form id="login" class="input-group" action="/Agora/User/checkLogin" method="post">
        <label>
          <input type="text" class="input-field" placeholder="Enter Username" name="username" required>
        </label>
        <label>
          <input type="password" class="input-field" placeholder="Enter Password" name="password" required>
        </label>
        <button type="submit" class="submit-btn">Log in</button>
      </form>

      <!------------FINE FORM PER IL LOG IN------------------------------>

      <!------------FORM PER IL SING UP------------------------------>
      <form id="register" class="input-group" action="/Agora/User/registration" method="post">
        <label>
          <input type="text" class="input-field" placeholder="Name" name="name" required>
        </label>
        <label>
          <input type="text" class="input-field" placeholder="Surname" name="surname" required>
        </label>
        <label>
          <input type="number" class="input-field" placeholder="Age" name="age" min='18' max="99" required>
        </label>
        <label>
          <input type="text" class="input-field" placeholder="Username" name="username" required>
        </label>
        <label>
          <input type="email" class="input-field" placeholder="Email" name="email" required>
        </label>
        <label>
          <input type="password" class="input-field" placeholder="Enter Password" name="password" id="password" required>
        </label>
        <p id="passwordMatchError" class="error-text" style="display: none;">Password must be at least 8 characters long, containing at least 1 number, 1 uppercase letter, and 1 special character.</p>
        <button type="submit" class="submit-btn" >Register</button>
      </form>
      <!------------FINE FORM PER IL SING UP------------------------------>
    </div>

  </div>
  <script src="/Agora/libs/Smarty/js/validatePwd.js"></script>

<script> const x = document.getElementById("login");
const y = document.getElementById("register");
const z = document.getElementById("btn-log");

function register(){
  x.style.left = "-400px"
  y.style.left = "50px"
  z.style.left = "110px"
}

function login(){
  x.style.left = "50px"
  y.style.left = "550px"
  z.style.left = "0px"
}

</script>

</body>
</html>