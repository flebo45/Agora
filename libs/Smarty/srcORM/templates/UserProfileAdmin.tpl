<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content ="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <title>Agorà-{$user->getUsername()}</title>
    <!-- icon scout cdn -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <link rel="icon" href="/Agora/libs/Smarty/immagini/A.png">
    <script src="/Agora/libs/Smarty/js/test.js"></script>
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
    <nav>
        <div class="container">
            <h2>Agorà</h2>
            <h2>{$modUsername}</h2>
            <form  action="/Agora/Moderator/reportList" method="post">
                <div>
                    <button class="btn btn-primary" type="submit">Go Back</button>
                </div>
            </form>
            <div class="profile-photo">
                <img src="/Agora/libs/Smarty/immagini/2.png" alt="">
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 6rem" >

        <!-----------------------right-------------------->
        <div class="right" style="margin-top: 4rem">
            <div class="side-profile">
                <div class="heading">
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
                        <h4> {$user->getUsername()} </h4>
                        <p class="text-muted">{$user->getName()}</p>
                    </div>
                    <div>
                        <a style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$follower}</a>
                        <p class="text-muted">
                            followers
                        </p>
                    </div>
                    <div>
                        <a style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$followed}</a>
                        <p class="text-muted">following</p>
                    </div>
                </div>
                <form id='ban' action="/Agora/Moderator/banUser/{$user->getId()}" method="post">
                    <button class="btn-primary btn">Ban</button>
                </form>
                <!----------------------DESCRIPTION-------------------->
                <div class="title">
                    <h6>About me</h6>
                </div>

                <div class="bio">
                    <i class="uil uil-chat-bubble-user"></i>
                    <div class="bio-body">
                        <h5 class="text-bold">Bio</h5>
                        <div class="text-muted">
                            <h5>{$user->getBio()}</h5>
                        </div>
                    </div>
                </div>

                <div class="bio">
                    <i class="uil uil-moneybag"></i>
                    <div class="bio-body">
                        <h5 class="tex-bold">Working </h5>
                        <div class="text-muted">
                            <h5>{$user->getWorking()}</h5>
                        </div>
                    </div>
                </div>

                <div class="bio">
                    <i class="uil uil-graduation-cap"></i>
                    <div class="bio-body">
                        <h5 class="tex-bold">Studied at</h5>
                        <div class="text-muted">
                            <h5>{$user->getStudiedAt()}</h5>
                        </div>
                    </div>
                </div>

                <div class="bio">
                    <i class="uil uil-hourglass"></i>
                    <div class="bio-body">
                        <h5 class="tex-bold">Hobby</h5>
                        <div class="text-muted">
                            <h5>{$user->getHobby()}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="middle">
            <!----------------FEEDS-------------------------------->
            <div class="feeds" style='width:50%; margin-left:25rem'>

                {foreach $arrayPostUser as $post}
                    <div class="feed">
                        <div class="head">
                            <div class="user">
                                <div class="profile-photo">
                                    <img src="/Agora/libs/Smarty/immagini/1.png" alt="">
                                </div>
                                <div class="ingo">
                                    <div>
                                        <a style="text-decoration: none; color: inherit; font-size: 1rem; font-weight : bold">{$post[0]->getTitle()}</a>
                                    </div>
                                    <small>{$post[0]->getTime()->format('Y-m-d H:i:s')}</small>
                                </div>
                            </div>
                            <div style="background: linear-gradient(45deg, violet, indigo, blue, green, yellow, orange, red);-webkit-background-clip: text;background-clip: text;color: transparent;font-weight: bold;">{$post[0]->getCategory()}</div>
                        </div>
                        <div class="caption ">
                            <!-- Smarty tag for username -->
                            <p><b>{$post[0]->getUser()->getUsername()}</b><span class="harsh-tag">
                        {$post[0]->getDescription()}</span></p>
                        </div>
                        {if count($post[0]->getImages()) === 0}

                        {else}
                            <div class="photo">
                                {foreach from=$post[0]->getImages() item=i}
                                    <img src="data:{$i->getType()};base64,{$i->getEncodedData()}" alt="Img">

                                {/foreach}
                            </div>
                        {/if}
                    </div>
                {/foreach}
                <!----------------END OF FEED------------------------------>
            </div>
            <!----------------END OF FEEDS------------------------------>
        </div>
    </div>