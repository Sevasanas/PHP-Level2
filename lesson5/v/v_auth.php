<h3>Login</h3>
<form  method="post">
  <label for="login">Login</label>
  <input type="text" id="login" name="login">
  <label for="password">Password</label>
  <input type="password" id="password" name="password">
  <br>
  <br>
  <input type="submit" value="Log in">
</form>
<?php if ($message == 'incorrect_login') : ?>
  <div>Incorrect login and/or password!</div>
<?php elseif ($message): ?>
  <div><?= $message ?>, please login again!</div>
<?php else: ?>
  <div>Input your login and password</div>
<?php endif; ?>
<br>
<a href="/v/v_registration">Registration</a>