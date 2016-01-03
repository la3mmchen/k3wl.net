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
        <h2>Your profile settings:</h2>
  </div>
  <div class="alert alert-warning" role="alert">You can only change certain values at the moment.</div>
  <div class="table-responsive">
    <form class="form-inline" method="post" action="<?=$app->urlFor('update');?>">
      <table class="table table-hover table-striped table-bordered">
        <tr>
          <td> UserId </td>
          <td> <?=$User->UserId;?> </td>
        </tr>
        <tr>
          <td> UserName: </td>
          <td> <?=$User->UserName;?> </td>
        </tr>
        <tr class="warning">
          <td colspan="2">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="UserPublic" value="true"
                <?php if ($User->UserPublic) { ?>
                  checked
                <?php } ?>
                > Profile public accessible?
              </label>
            </div>
          </td>
        </tr>
        <tr class="warning">
          <td colspan="2">
            <div class="form-group">
              <label for="UserPassword">Password</label>
              <input type="text" class="form-control" id="UserPassword" placeholder="New Password" name="UserPassword">
            </div>
          </td>
        </tr>
        <?php if (isset($User->UserChannels)) { ?>
          <tr>
            <td colspan="2">
              <?php foreach ($User->UserChannels as $key=>$value) {?>

                    <?php
                      $LocChannel = new Channel($value);
                      $app->render('embedded/Channel.php', array(
                        'app'=>$app,
                        'User'=>$User,
                        'Channel'=>$LocChannel,
                      ));
                    ?>
              <?php } ?>
            </td>
          </tr>
        <?php }?>
        <tr>
          <td colspan="2">
            <button type="submit" class="btn btn-default">Save</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </td>
        </tr>
        <?php if ($User->UserPublic) { ?>
          <tr>
            <td colspan="2">Link to your Public profile:
              <a href="<?=$app->urlFor('user', array('username'=>$_SESSION['UserName']));?>"><?=$app->urlFor('user', array('username'=>$_SESSION['UserName']));?></a>
            </td>
          </tr>
        <?php } ?>


      </table>
    </form>
  </div>

  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
