<div class="container">

  <form class="form-signin"  method="post" action="<?=$app->urlFor('login');?>">
    <h4 class="form-signin-heading">Give it a try:</h4>
    <label for="inputUser" class="sr-only">User Name</label>
    <input type="user" id="inputUser" class="form-control" placeholder="User" name="user" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password"name="pass" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>

</div> <!-- /container -->
