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
