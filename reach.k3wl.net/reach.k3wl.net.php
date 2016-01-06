<?php
  require '../Slim/Slim.php';
  \Slim\Slim::registerAutoloader();

  include './models/User.php'; # Load User Class
  include './models/Channel.php'; # Load Channel Class
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

  if (isset($_SESSION['isAuthed']) && $_SESSION['isAuthed']) {
    $User->isAuthed = true;
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
  }

  $app->setName('reach.k3wl.net');

  $app->get('/', function () use ($app, $User) {
      $app->render('home.php', array(
        'app'=>$app,
        'User'=>$User
      ));
  })->name('home');

  $app->get('/p/:username', function ($username) use ($app, $User) {
    $UserToView = new User();
    if ($UserToView->setName($username) && $UserToView->UserPublic) {
      $app->render('user.php', array(
        'app'=>$app,
        'User'=>$UserToView
      ));
    }
    else {
      $app->render('userNotFound.php', array(
        'app'=>$app,
        'User'=>$User
      ));
    }
  })->name('user');

  $app->get('/profile', function () use ($app, $User) {
    if (isset($_SESSION['isAuthed']) && $_SESSION['isAuthed']) {
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

  $app->get('/channels', function () use ($app, $User) {
    if (isset($_SESSION['isAuthed']) && $_SESSION['isAuthed']) {
      $User->setName($_SESSION['UserName']);
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

  $app->get('/a/:username/:channel', function ($username, $channeluniquid) use ($app, $User) {
    if (isset($_SESSION['isAuthed']) && $_SESSION['isAuthed']) {
      $User->setName($username);
      $User->toggleChannel($channeluniquid);
    }
    $app->redirect($app->urlFor('channel', array('username'=>$username)));
  })->name('activateChannel');

  $app->post('/l', function () use ($app, $User){
    if ($app->request->post('captcha') == NULL) {
      if ($User->exists($app->request->post('user'))) {
        $User->setName($app->request->post('user'));
        if ($User->auth($app->request->post('pass'))) {
          $_SESSION['UserName'] = $User->UserName;
          $_SESSION['isAuthed'] = true;
          $app->redirect($app->urlFor('channel'));
        }
      }
      else {
        $User->UserName = $app->request->post('user');
        $User->UserPassword = password_hash($app->request->post('pass'), PASSWORD_DEFAULT);
        $User->UserId = uniqid();
        $_SESSION['UserName'] = $User->UserName;
        $_SESSION['isAuthed'] = true;
        $User->writeChanges();
        $app->redirect($app->urlFor('channel'));
      }
    }
    else {
    # Implement some action
    }
      $app->redirect($app->urlFor('home'));
  })->name('loginPost');

  $app->post('/update/:type', function($type) use ($app, $User){
      $User->setName($_SESSION['UserName']);
      if ($app->request->post('UserPublic')) {
        $User->UserPublic = true;
      }
      else {
        $User->UserPublic = false;
      }

      if ($app->request->post('UserPassword')&& $app->request->post('UserPassword') != "") {
        $User->UserPassword = password_hash($app->request->post('UserPassword'), PASSWORD_DEFAULT);
      }
      $User->writeChanges();
      $app->redirect($app->urlFor('profile'));
  })->name('update');

  $app->post('/c', function() use ($app, $User){
      $NewChannel = new Channel();
      $NewChannel->ChannelId = uniqid();
      if ($app->request->post('ChannelName')) {
        $NewChannel->ChannelName = $app->request->post('ChannelName');
      }
      if ($app->request->post('ChannelDetails')) {
        $NewChannel->ChannelDetails = $app->request->post('ChannelDetails');
      }
      $NewChannel->ChannelType = "unknown";

      $User->setName($_SESSION['UserName']);
      array_push($User->UserChannels, json_encode($NewChannel));
      $User->writeChanges();
      $app->redirect($app->urlFor('channel'));
  })->name('addChannel');

  $app->run();
?>
