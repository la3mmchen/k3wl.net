<?php
$app->render('webheader.php', array(
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

      <form class="form-inline" method="post" action="<?=$app->urlFor('login');?>">
        <input type="text" name="user" class="input-small" placeholder="Email">
        <input type="password" name="pass" class="input-small" placeholder="Password">
        <button type="submit" class="btn">Sign in</button>
      </form>
      <sub> demo / demo </sub>

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
