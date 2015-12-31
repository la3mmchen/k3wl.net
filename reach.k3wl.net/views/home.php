<?php
$app->render('webheader.php', array(
    'app' => $app,
    'User'=>$User
));
?>

<div class="container">

  <?php
  if ($User->isAuthed()) {
    $app->render('webnav.php', array(
        'app' => $app,
        'site' => __FILE__
    ));
  }
  else { ?>
    <div class="header clearfix">
      <nav>
        <ul class="nav nav-pills pull-right">
        </ul>
      </nav>
      <h3 class="text-muted"><?=$app->getName();?></h3>
    </div>
  <?php } ?>



  <div class="jumbotron">
          <h1>Hej du.</h1>
          <p class="lead">
            This is meant as a small playground.
          </p>
    </div>
  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
