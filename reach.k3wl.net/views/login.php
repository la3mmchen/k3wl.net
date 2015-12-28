<?php
$app->render('webheader.php', array(
    'app' => $app,
));
?>

<div class="container">

  <form class="form-signin"  method="post" action="<?=$app->urlFor('login');?>">
    <h2 class="form-signin-heading">Please sign in</h2>
    <label for="inputUser" class="sr-only">User Name</label>
    <input type="user" id="inputUser" class="form-control" placeholder="User" name="user" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password"name="pass" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>

</div> <!-- /container -->

<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
