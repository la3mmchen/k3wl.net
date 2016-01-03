<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <form class="form-signin"  method="post" action="<?=$app->urlFor('login');?>">
        <h4 class="form-signin-heading">Give it a try:</h4>
        <label for="inputUser" class="sr-only">User Name</label>
        <input type="user" id="inputUser" class="form-control" placeholder="User" name="user" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password"name="pass" required>
        <label> <input type="checkbox" id="captcha" name="captcha"> I'm a robot.
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Start now</button>
      </form>
      <em>Just fill the upper fields, we create automatically an user if there is no one with that name. </em>
    </div>
  </div>
</div>
