<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-compatible" content ="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <title>Mod-Report</title>
  <!-- icon scout cdn -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
  <link rel="icon" href="/Agora/Smarty/immagini/A.png">

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
      <h2>Agorà</h2>
      <h2>{$modUsername}</h2>
      <form  action="/Agora/Moderator/logout" method="post">
                <div>
                    <button class="btn btn-primary" type="submit">Log out</button>
                </div>
      </form>
      <div class="profile-photo">
        <img src="/Agora/Smarty/immagini/2.png" alt="">
      </div>
    </div>
  </nav>

  <!----------------REPORT PAGE FOR ADMIN------------------------------->
  <main>

        <div class="admin" style="height: 60%; overflow-y:auto; margin-top: 1rem;">
          <h3 class="title">ID</h3>
          <h3 class="title">Info Posts</h3>
          <h3 class="title">Action</h3>
        </div>
      {if count($reportedPost) === 0}
          <div class="admin" style="margin-top: 1rem;">There are no reported post</div>
      {else}
        {foreach $reportedPost as $report}
        <div class="admin-report" style="margin-top: 1%">
          <div class="admin">
            <div class="left">
              <h3>Id Report: {$report->getId()}</h3>
              <h4>Type: {$report->getType()}</h4>
              <h4>Post's creator: <a href="/Agora/Moderator/visitUser/{$report->getPost()->getUser()->getId()}" style="text-decoration: none; color: red; font-size: 1rem; font-weight : bold;">{$report->getPost()->getUser()->getUsername()}</a></h4>
              <h6>Id who sent the report: {$report->getIdUser()}</h6>
            </div>
            <div class="middle">
              <div class="body-report"> {$report->getDescription()}</div>
              <label>
                <button class="btn btn btn-primary" onclick="location.href='/Agora/Moderator/visitPost/{$report->getPost()->getId()}'">See the post</button>
              </label>
            </div>
            <div class="right">
              <div>
              <form id='ban' action="/Agora/Moderator/banPost/{$report->getPost()->getId()}/{$report->getPost()->getUser()->getId()}" method="post">
                <button class="btn btn-primary "><i class="uil uil-trash-alt">Ban</i></button>
              </form>
              </div>
              <div style="margin-top: 100%">
              <form id='ignore' action="/Agora/Moderator/ignore/{$report->getId()}" method="post">
                <button class="btn btn-primary "><i class="uil uil-eye-slash">Ignore</i></button>
              </form>
              </div>
            </div>
          </div>
        </div>
        {/foreach}
      {/if}
        <div class="admin" style="height: 60%; overflow-y:auto; margin-top: 1rem;">
          <h3 class="title">ID</h3>
          <h3 class="title">Body Comments</h3>
          <h3 class="title">Action</h3>
        </div>
      {if count($reportedComment) === 0}
          <div class="admin" style="margin-top: 1rem;">There are no reported comment</div>
      {else}
        {foreach $reportedComment as $report}
        <div class="admin-report" style="margin-top: 1%">
          <div class="admin">
            <div class="left">
              <h3>Id Report: {$report->getId()}</h3>
              <h4>Type: {$report->getType()}</h4>
              <h4>Comment's creator: <a href="/Agora/Moderator/visitUser/{$report->getComment()->getUser()->getId()}" style="text-decoration: none; color: red; font-size: 1rem; font-weight : bold;"> {$report->getComment()->getUser()->getUsername()}</a></h4>
              <h6>Id who sent the report: {$report->getIdUser()}</h6>
            </div>
            <div class="middle">
              <div class="body-report">{$report->getComment()->getBody()}</div>
            </div>
            <div class="right">
              <div>
              <form id='ban' action="/Agora/Moderator/banComment/{$report->getComment()->getId()}" method="post">
                <button class="btn btn-primary "><i class="uil uil-trash-alt">Ban</i></button>
              </form>
              </div>
              <div style="margin-top: 100%">
              <form id='ignore' action="/Agora/Moderator/ignore/{$report->getId()}" method="post">
                <button class="btn btn-primary "><i class="uil uil-eye-slash">Ignore</i></button>
              </form>
              </div>
            </div>
          </div>
        </div>
        {/foreach}
      {/if}
  </main>
</body>
</html>