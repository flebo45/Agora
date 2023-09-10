<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>{$pageTitle}</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="Img/A.png">

    <!-- stylesheet -->
    <link rel="stylesheet" href="/Agora/Smarty/css/normalize.css">
    <link rel="stylesheet" href="../css/style.css">
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
        <h2>Agorà</h2>
        <h2>Admin</h2>
        <div class="profile-photo">
            <img src="/Agora/Img/A.png" alt="">
        </div>
    </div>
</nav>
<!---VISUALIZZATION FOR ADMIN---------------->
<div class="container" style="margin-top:10%">
    <div class="middle">
        <div class="feeds">
            <div class="feed">
                <div class="comment">
                    <div class="head">
                        <div class="user">
                            <div class="profile-photo">
                                <img src="Img/A.png" alt="img">
                            </div>
                            <div class="ingo">
                                <a href="/Agora/User/profile/{$comment->getUser()->getUsername()}" style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold"> {$comment->getUser()->getUsername()} </a>
                                <small>{$comment->getTime()->format('Y-m-d H:i:s')}</small>
                            </div>
                        </div>
                        <div class="body-comment">
                            <b>{$comment->getBody()}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <label>
            <button class="btn btn-primary "><i class="uil uil-trash-alt">Delete</i></button>
        </label>
    </div>
    <div style="margin-top:10px">
        <label >
            <button class="btn btn-primary "><i class="uil uil-eye-slash">Ignore</i></button>
        </label>
    </div>
</div>e">