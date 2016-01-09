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
          <h1><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Directory </h1>
          <p class="lead">
            See all our users with a public profile.
            <br/><br/>
            <button type="submit" class="btn btn-info btn-lg" data-toggle="modal" data-target=""><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search a user.</button>
          </p>
  </div>

  <?php if (!empty ($Users)) { ?>
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <tbody>
        <?php foreach ($Users as $i) { ?>
          <tr>
            <td>
              <a href="<?=$app->urlFor('user', array('username'=>$i));?>"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?=$i;?></a>
            </td>
            <td>
              <button type="submit" class="btn btn-info btn-xs" data-toggle="modal" data-target=""><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Save to favorites.</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php } ?>


  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
