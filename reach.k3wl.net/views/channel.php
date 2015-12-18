<?php
$app->render('webheader.php', array(
    'app' => $app,
));
?>

<?php
$app->render('webnav.php', array(
    'app' => $app,
));
?>



<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      &nbsp;
    </div>
  </div>
  <div class="row-fluid">
    <div class="span2">
    </div>
    <div class="span8">
        fill me with input
    </div>
    <div class="span2">
    </div>
  </div>

  </div>
</div>


<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
