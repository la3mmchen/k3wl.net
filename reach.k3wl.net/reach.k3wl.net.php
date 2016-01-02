<?php
  require '../Slim/slim.php';
  \Slim\Slim::registerAutoloader();

  include './models/User.php'; # Load User Class
  $User = new User();
  $app = new \Slim\Slim(array(
    'templates.path' => './views',
    'log.enabled' => true,
    'log.level' => \Slim\Log::DEBUG
  ));

  # Session handling
  session_cache_limiter(false);
  session_start();

  if (!isset($_SESSION['CREATED'])) {
      $_SESSION['CREATED'] = time();
  }
  else if (time() - $_SESSION['CREATED'] > 1800) { // session started more than 30 minutes ago
      session_regenerate_id(true);
      $_SESSION['CREATED'] = time();
  }

  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
  }

  if ($_SESSION['isAuthed']) {
    $User->isAuthed = true;
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
  }



  $app->setName('reach.k3wl.net');

  $app->get('/', function () use ($app, $User) {
      $app->render('home.php', array(
        'app'=>$app,
        'User'=>$User
      ));
      if (!$User->isAuthed()) {
        $app->render('login_embedded.php');
      }
  })->name('home');

  $app->get('/p/:username', function ($username) use ($app, $User) {
    if ($User->isAuthed()) {
      $app->render('user.php', array());
    }
    else {
      $app->redirect($app->urlFor('home'));
    }
  })->name('user');

  $app->get('/profile', function () use ($app, $User) {
    if ($User->isAuthed()) {
      $User->setName($_SESSION['UserName']);
      $app->render('profile.php', array(
        'app'=>$app,
        'User'=>$User
      ));
    }
    else {
      $app->redirect($app->urlFor('home'));
    }
  })->name('profile');

  $app->get('/c/:username', function ($username) use ($app, $User) {
    if ($User->isAuthed()) {
      $User->setName($username);
      $locChannels = array();
      if (isset($User->UserChannels)) {
        $locChannels = $User->UserChannels;
      }
      elseif (file_exists('localstore/default_channels.json')) {
        $locChannels = json_decode( file_get_contents('localstore/default_channels.json'))->channels;
      }
      $app->render('channel.php', array(
        'app'=>$app,
        'User'=>$User,
        'Channels'=>$locChannels
      ));
    }
    else {
      $app->redirect($app->urlFor('home'));
    }
  })->name('channel');

  $app->get('/l', function () use ($app, $User) {
    $app->render('login.php', array(
      'app'=>$app,
      'User'=>$User
    ));
  })->name('login');

  $app->get('/logout', function () use ($app) {
    session_unset();
    session_destroy();
    $app->redirect($app->urlFor('home'));
  })->name('logout');

  $app->notFound(function () use ($app) {
      $app->redirect($app->urlFor('home'));
  });

  $app->get('/a/:username/:channel', function ($username, $channel) use ($app, $User) {
    if ($User->isAuthed()) {
      $User->setName($username);
      $User->toggleChannel($channel);
    }
    $app->redirect($app->urlFor('channel', array('username'=>$username)));
  })->name('activateChannel');

  $app->post('/l', function () use ($app, $User){
      $User->setName($app->request->post('user'));
      if ($User->auth($app->request->post('pass'))) {
        $_SESSION['UserName'] = $User->UserName;
        $_SESSION['isAuthed'] = true;
        $app->redirect($app->urlFor('home'));
      }
      $app->redirect($app->urlFor('home'));
  });

  $app->post('/update/:type', function($type) use ($app, $User){
      $User->setName($_SESSION['UserName']);
      if ($app->request->post('UserPublic')) {
        $User->UserPublic = true;
      }

      if ($app->request->post('UserPassword')&& $app->request->post('UserPassword') != "") {
        $User->UserPassword = password_hash($app->request->post('UserPassword'), PASSWORD_DEFAULT);
      }
      $User->writeChanges();
      $app->redirect($app->urlFor('profile'));
  })->name('update');

  $app->run();
?>
