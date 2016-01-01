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
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">&nbsp;</div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="list-group">
          <?php if (isset($Channels)) { ?>
            <?php foreach ($Channels as $key=>$value) { ?>
              <button type="button" class="list-group-item btn btn-default
                <?php if ($value->active) echo "active"; ?>
              " data-toggle="tooltip" data-placement="top" title="Activate"><span class="badge"><?=$value->details;?></span><?=$value->name;?></button>
            <?php } ?>
          <?php } ?>

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
