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
  ?>

  <div class="jumbotron">
        <h1><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> <?=$User->UserName?></h1>
        <p>These are the settings for your account.
        <br/>
        A <b>Public Profile</b> is opposed to any visiters on this site. </p>
  </div>
  <div class="alert alert-warning" role="alert">You can only change certain values at the moment.</div>

  <div class="row channels">
    <form class="form-inline" method="post" action="<?=$app->urlFor('update');?>">
      <div class="col-xs-4">
        <h4>Set a new password</h4>
        <p>
          <div class="form-group">
            <label for="UserPassword">Password</label>
            <input type="text" class="form-control" id="UserPassword" placeholder="New Password" name="UserPassword">
          </div>
        </p>
        <h4>Public profile</h4>
        <p>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="UserPublic" value="true"
              <?php if ($User->UserPublic) { ?>
                checked
              <?php } ?>
              > Profile public accessible?
            </label>
          </div>
        </p>
      </div>

      <div class="col-xs-4">
        <?php if ($User->UserPublic) { ?>
        <h4>Link to your Public profile</h4>
        <p>
          <a href="<?=$app->urlFor('user', array('username'=>$_SESSION['UserName']));?>"><?=$app->urlFor('user', array('username'=>$_SESSION['UserName']));?></a>
        </p>
        <?php } ?>
        <h4>Actions</h4>
        <p>
          <button type="submit" class="btn btn btn-success"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save</button>
          <button type="reset" class="btn btn-default">Reset</button>
        </p>
      </div>
    </form>
  </div>

  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
