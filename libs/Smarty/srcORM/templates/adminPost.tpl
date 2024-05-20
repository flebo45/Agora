<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>reportedPost</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">

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
    <div class="container">
        <h2>Agorà</h2>
        <h2>{$modUsername}</h2>
        <div class="profile-photo">
            <img src="/Agora/libs/Smarty/immagini/2.png" alt="">
        </div>
    </div>
</nav>


<!----------------------VISUALIZATION POST FOR ADMIN----------------------------------------------->
<div class="container" style="margin-top:10%">
    <div class="middle">
        <!----------------FEEDS-------------------------------->
        <div class="feeds">
            <div class="feed">
                <div class="head">
                    <div class="user">
                    {if $userPic->getSize() > 0}
                        <div class="profile-photo">  
                            <img src="data:{$userPic->getType()};base64,{$userPic->getEncodedData()}" alt="Img">
                        </div>
                    {else}
                        <div class="profile-photo">
                            <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                        </div>
                    {/if}
                        <div class="ingo">
                            <div>
                                <a  style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post->getTitle()}</a>
                            </div>
                            <small>{$post->getTime()->format('Y-m-d H:i:s')}</small>
                        </div>
                    </div>
                </div>
                <div class="caption ">
                    <!-- Smarty tag for username -->
                    <p><a href="/Agora/Moderator/visitUser/{$post->getUser()->getId()}"style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post->getUser()->getUsername()}</a><span class="harsh-tag">
            {$post->getDescription()}</span></p>
                </div>
                {if count($post->getImages()) === 0}

                {else}
                    <div class="photo">
                        {foreach from=$post->getImages() item=i}
                            <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img">

                        {/foreach}
                    </div>
                {/if}
            </div>
        </div>

        <div>
            <form id='ban' action="/Agora/Moderator/banPost/{$post->getId()}/{$post->getUser()->getId()}" method="post">
                <button class="btn btn-primary "><i class="uil uil-trash-alt">Ban</i></button>
            </form>
        </div>
        <div style="margin-top:10px">
            <label >
                <button class="btn btn-primary " onclick='location.href="/Agora/Moderator/reportList"'><i class="uil">Go Back</i></button>
            </label>
        </div>

    </div>
</div>