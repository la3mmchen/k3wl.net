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
  ));
  ?>
  <?php #change me ?>

  <div class="jumbotron">
          <h1><span class="glyphicon glyphicon-list" aria-hidden="true"></span> <?=$User->UserName;?></h1>
          <p class="lead">
            You can toggle your channels by clicking on them.
          </p>
  </div>

  <?php if (!empty ($User->UserChannels)) { ?>
    <div class="row channels">
          <?php foreach ($User->UserChannels as $key=>$Channel) {
              $LocChannel = new Channel($Channel);
              $app->render('embedded/Channel.php', array(
                'app'=>$app,
                'User'=>$User,
                'Channel'=>$LocChannel,
              ));
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
