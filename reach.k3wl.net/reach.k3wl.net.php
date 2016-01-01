<?php
  require '../Slim/slim.php';
  \Slim\Slim::registerAutoloader();

  include './models/User.php'; # Load User Class
  $User = new User();
  $app = new \Slim\Slim(array(
    'templates.path' => './views',
    'log.enabled' => true,
    'log.level' => \Slim\Log::DEBUG,
    'cookies.encrypt' => true,
    'cookies.secret_key' => 'i391hr8934223rowjsjbfuiw',
    'cookies.cipher' => MCRYPT_RIJNDAEL_256,
    'cookies.cipher_mode' => MCRYPT_MODE_CBC
  ));
  $app->setName('reach.k3wl.net');

  if ($app->getCookie('reach.k3wl.net')) {
    $User->isAuthed = true;
  }

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
      $app->redirect($app->urlFor('login'));
    }
  })->name('user');

  $app->get('/profile', function () use ($app, $User) {
    if ($User->isAuthed()) {
      $app->render('profile.php', array(
        'app'=>$app,
        'User'=>$User
      ));
    }
    else {
      $app->redirect($app->urlFor('login'));
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
      $app->redirect($app->urlFor('login'));
    }
  })->name('channel');

  $app->get('/l', function () use ($app, $User) {
    $app->render('login.php', array(
      'app'=>$app,
      'User'=>$User
    ));
  })->name('login');

  $app->get('/logout', function () use ($app) {
    $app->deleteCookie('reach.k3wl.net');
    $app->redirect($app->urlFor('login'));
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
        $app->setCookie('reach.k3wl.net', 'authed', '2 hour', 'k3wl.net');
        session_cache_limiter(false);
        session_start();
        $app->redirect($app->urlFor('home'));
      }
      $app->redirect($app->urlFor('home'));
  });

  $app->run();
?>
