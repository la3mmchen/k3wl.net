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
  ));
  ?>
  <?php #change me ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">&nbsp;</div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="list-group">
          <button type="button" class="list-group-item">Channel 1</button>
          <button type="button" class="list-group-item active"> <span class="badge">current</span> Channel 2</button>
          <button type="button" class="list-group-item">Channel 3</button>
        </div>
      </div>
    </div>
  </div>
  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
