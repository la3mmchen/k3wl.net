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
          <h1>Hej.</h1>
          <p class="lead">
            What's App, Facebook, Mobile, Business mobile, Twitter, etc. We collect lot of communication channels these days. But how do you signalize you fancy a mail over all other channels while you're sitting at hair dresser? How do you let the world know that at the moment you just want a chat message instead of a call? <br/>
            So far there is no way. This might be one solution. So give it a try.
          </p>
    </div>
    <div class="alert alert-info" role="alert">You might notive we are still very beta. So give a hint, there is a reach.k3wl.net user to show you how do you can contact us. Otherwise drop us a mail.</div>
  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
