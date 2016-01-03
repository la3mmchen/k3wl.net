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
          <h1><span class="glyphicon glyphicon-user" aria-hidden="true"></span> ???</h1>
  </div>
  <div class="alert alert-danger" role="alert">Sorry, we can't find this user.</div>



  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
