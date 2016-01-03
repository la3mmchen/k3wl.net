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
            <br/><br/>
            <button type="submit" class="btn btn btn-info btn-lg" data-toggle="modal" data-target="#addChannel"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create a new channel.</button>
          </p>
          <?php
            $app->render('modals/addChannel.php');
          ?>
  </div>

  <?php if (!empty ($User->UserChannels)) { ?>
    <div class="row channels">
          <?php foreach ($Channels as $i) {
              $LocChannel = new Channel(json_decode($i));
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
