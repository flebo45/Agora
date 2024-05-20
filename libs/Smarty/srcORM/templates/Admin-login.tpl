<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">

    <!-- stylesheet -->
    <link rel="stylesheet" href="/Agora/libs/Smarty/css/normalize.css">
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

            <div clas="tex-bold" style="margin-left: 3.5rem">ADMIN LOGIN</div>
        </div>
        <div class="tex-bold">
            <h3>Agorà</h3>
        </div>
        <!------------FORM PER IL LOG IN------------------------------>
        {if $error == true}
            <div style="color: red; margin-left: 8%;">
                wrong username or password, try again
            </div>
        {/if}
        <form id="login" class="input-group" action="/Agora/Moderator/checkLogin" method="post">
            <label>
                <input type="text" class="input-field" placeholder="Enter Username" name="username" required>
            </label>
            <label>
                <input type="password" class="input-field" placeholder="Enter Password" name="password" required>
            </label>
            <button type="submit" class="submit-btn">Log in</button>
        </form>

    </div>

</div>
</body>
