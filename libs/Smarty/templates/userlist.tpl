<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <title>home</title>
    <!-- icon scout cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">
    <script src="/Agora/libs/Smarty/js/test.js"></script>
    <script>
        const userId = {$user->getId()};
    </script>
    <script src="/Agora/libs/Smarty/js/websocket.js"></script>
    <!-- stylesheet -->
    {literal}
        <link rel="stylesheet" href="/Agora/libs/Smarty/css/normalize.css">
        <link rel="stylesheet" href="/Agora/libs/Smarty/css/style.css">
    {/literal}
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
            <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
        </div>
    </div>
</nav>


<main>
    <div class="container">
        <!-----------------------left-------------------->
        <div class="left">

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
                <label class="tex-bold theme-cust"  id="theme">
                    <span> <i class="uil uil-palette"></i></span>Theme
                </label>
                <label class="menu-items tex-bold " >
                    <button class="btn-transparent" onclick="location.href='/Agora/User/settings'"><i class="uil uil-setting"></i> </button>Setting
                </label>
            </div>
            <!--------------------END OF SIDE BAR----------------->
        </div>


        <div class="middle">
            <div class="feeds">
                <div class ="feed">
            {if count($userList) == 0}
                {if $param == 'like'}
                    <div class="tex-bold" style="font-size:18px">This post has 0 like for now</div>
                {elseif $param == 'followed'}
                    <div class="tex-bold" style="font-size:18px">No one is following this user</div>
                {elseif $param == 'followers'}
                    <div class="tex-bold" style="font-size:18px">This user is not following anyone</div>
                {/if}
            {else}
                {if $param == 'like'}
                    <div class="tex-bold" style="font-size:18px">This Post is liked by:</div>
                {elseif $param == 'followers'}
                    <div class="tex-bold" style="font-size:18px">This User is following:</div>
                {elseif $param == 'followed'}
                    <div class="tex-bold" style="font-size:18px">This User is followed by:</div>
                {/if}
                {foreach $userList as $l}
                    
                    <div style="display: flex; align-items: center; font-size:18px; margin-top:1rem">
                        {if $l[1]->getSize() > 0}
                            <div class="profile-photo">
                                <img src="data:{$l[1]->getType()};base64,{$l[1]->getEncodedData()}" alt="Img">
                            </div>
                        {else}
                            <div class="profile-photo">
                                <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                            </div>
                        {/if}
                        
                        {if $param == 'like'}
                            {if $l[0]->isVip()}
                                <i class="uil uil-heart" style="color:red; margin-left:1rem"></i><a href="/Agora/User/profile/{$l[0]->getUsername()}" class="vip">{$l[0]->getUsername()}</a>
                            {else}
                            <i class="uil uil-heart" style="color:red; margin-left:1rem"></i> <a href="/Agora/User/profile/{$l[0]->getUsername()}" class="tex-bold" style="text-decoration: none; color: inherit">{$l[0]->getUsername()}</a>
                            {/if}
                            <p class="text-muted left-transition"> {$l[0]->getName()}</p>
                        {else}
                            {if $l[0]->isVip()}
                                <i class='uil uil-star' class="vip"></i> <a href="/Agora/User/profile/{$l[0]->getUsername()}" class="vip">{$l[0]->getUsername()}</a>
                            {else}
                                <i class="uil uil-chat-bubble-user" style="color:red; margin-left:1rem"></i> <a href="/Agora/User/profile/{$l[0]->getUsername()}" class="tex-bold" style="text-decoration: none; color: inherit">{$l[0]->getUsername()}</a>
                            {/if}
                            <p class="text-muted left-transition"> {$l[0]->getName()}</p>
                        {/if}
                        
                    </div>

                {/foreach}
            {/if}
                </div>
            </div>
            <button class="btn-primary btn"  onclick="history.back()">Go Back</button>
    </div>
</main>
<script src="/Agora/libs/Smarty/js/sidebar2.js"></script>