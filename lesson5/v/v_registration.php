<h4>Registration</h4>
<form method="post">
  <label for="new_login">Login</label>
  <input type="text" id="new_login" name="new_login">
  <br>
  <label for="new_pass">Password</label>
  <input type="text" id="new_pass" name="new_pass">
  <br>
  <label for="new_name">Name</label>
  <input type="text" id="new_name" name="new_name">
  <br>
  <label for="new_phone">Phone</label>
  <input type="tel" id="new_phone" name="new_phone">
  <br>
  <label for="new_mail">Email</label>
  <!--  <input type="email" id="new_mail" name="new_mail">-->
  <input type="text" id="new_mail" name="new_mail">
  <br>
  <input type="submit" value="Submit" name="new_registration">
</form>
<?php if ($login) : ?>
  <div> User <?= $login ?> already exists!</div>
<?php endif; ?>