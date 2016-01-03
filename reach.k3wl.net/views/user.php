<?php
$app->render('webheader.php', array(
    'app' => $app,
    'User'=>$User
));
?>

<div class="container">

  <?php
  $app->render('webnav.php', array(
        'app' => $app,
        'site' => __FILE__
  ));?>



  <div class="jumbotron">
          <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?=$User->UserName;?></h1>
          <p class="lead">
            Public profile.
          </p>
  </div>

  <?php if (!empty ($User->UserChannels)) { ?>
    <div class="row channels">
          <?php foreach ($User->UserChannels as $value) {
              $LocChannel = new Channel(json_decode($value));
              if ($LocChannel->ChannelActive) {
                $app->render('embedded/ChannelPublic.php', array(
                  'app'=>$app,
                  'User'=>$User,
                  'Channel'=>$LocChannel,
                ));
              }
            } ?>
    </div>
  <?php } ?>


  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
