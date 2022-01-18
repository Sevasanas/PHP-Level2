<?php if($text):?>
    <h1>Вы успешно зарегестрировались!</h1>
<?php
endif;
?>
<br>
<form method="post">
	<input type="text" name="login" placeholder="Введите логин" required>
	<input type="password" name="password" placeholder="Введите пароль" required>
	<input type="submit" name="button" value="Войти">
</form>