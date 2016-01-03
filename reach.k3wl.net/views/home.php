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
            What's App, Facebook, Mobile, Mail, Business mobile, Twitter, and so on.
            <br/><br/>We collect lot of communication channels these days. But how do you signalize you fancy a mail over all other channels while you're sitting at hair dresser? How do you let the world know that at the moment you just want a chat message instead of a call? <br/>
            So far there is no way. This might be one solution. So give it a try.
          </p>
    </div>
    <div class="alert alert-success" role="alert">You might notice we are still very beta. To give a hint if something is broken, there is a <a href="<?=$app->urlFor('user', array('username'=>$app->getName()));?>"><?=$app->getName();?> user</a> to show you how do you can contact us. <br/>Otherwise drop us a mail.</div>

    <?php
      if (!$User->isAuthed()) {
        $app->render('login_embedded.php');
      }
    ?>

  <?php #stop changing ?>
</div>
<?php
$app->render('webfooter.php', array(
    'app' => $app,
));
?>
