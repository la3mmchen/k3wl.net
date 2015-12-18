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
        if ($User->isAuthed()) {
            echo "home";
        }
        else {
          $app->response->redirect($app->urlFor('login'));
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

  $app->get('/c/:username', function ($username) use ($app, $User) {
    if ($User->isAuthed()) {
      $app->render('channel.php', array(
        'app'=>$app
      ));
    }
    else {
      $app->redirect($app->urlFor('login'));
    }
  })->name('channel');

  $app->get('/l', function () use ($app) {
    $app->render('login.php', array(
      'app'=>$app
    ));
  })->name('login');

  $app->get('/logout', function () use ($app) {
    $app->deleteCookie('reach.k3wl.net');
    $app->redirect($app->urlFor('login'));
  })->name('logout');

  $app->notFound(function () use ($app) {
      $app->redirect($app->urlFor('home'));
  });

  $app->post('/l', function () use ($app, $User){
      $User->setName($app->request->post('user'));
      if ($User->auth($app->request->post('pass'))) {
        $app->setCookie('reach.k3wl.net', 'authed', '2 hour', 'k3wl.net');
        $app->response->redirect($app->urlFor('channel', array(
          'username'=>$User->UserName
        )));
      }
  });

  $app->run();
?>
