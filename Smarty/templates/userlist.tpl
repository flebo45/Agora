<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0">
    <title>home</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/Smarty/immagini/A.png">

    <!-- stylesheet -->
    {literal}
        <link rel="stylesheet" href="/Agora/Smarty/css/style.css">
    {/literal}
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
            <img src="/Agora/Smarty/immagini/1.png" alt="">
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
                    <button class="btn-transparent" onclick="location.href='/Agora/User/settings/0'"><i class="uil uil-setting"></i> </button>Setting
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
                {elseif $param == 'followers'}
                    <div class="tex-bold" style="font-size:18px">No one is following this user</div>
                {elseif $param == 'followed'}
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
                        {if $userPic[$l->getId()]->getSize() > 0}
                            <div class="profile-photo">
                                <img src="data:{$userPic[$l->getId()]->getType()};base64,{$userPic[$l->getId()]->getEncodedData()}" alt="Img">
                            </div>
                        {else}
                            <div class="profile-photo">
                                <img src="/Agora/Smarty/immagini/1.png" alt="">
                            </div>
                        {/if}
                        
                        {if $param == 'like'}
                            <i class="uil uil-heart" style="color:red; margin-left:1rem"></i> <a href="/Agora/User/profile/{$l->getUsername()}" class="tex-bold" style="text-decoration: none; color: inherit">{$l->getUsername()}</a>
                            <p class="text-muted left-transition"> {$l->getName()}</p>
                        {else}
                            <i class="uil uil-accessible-icon-alt" style="color:red; margin-left:1rem"></i> <a href="/Agora/User/profile/{$l->getUsername()}" class="tex-bold" style="text-decoration: none; color: inherit">{$l->getUsername()}</a>
                            <p class="text-muted left-transition"> {$l->getName()}</p>
                        {/if}
                        
                    </div>

                {/foreach}
            {/if}
                </div>
            </div>
            <button class="btn-primary btn"  onclick="history.back()">Go Back</button>
    </div>
</main>