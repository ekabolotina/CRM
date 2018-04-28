<?php

	session_start();

	if($_SESSION['user']){
		Header('Location: /');
		die;
	}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Вход</title>
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/global.css">
</head>
<body>

	<section id="loginForm">
		
		<h1>Добро пожаловать</h1>
		<h3>Авторизуйтесь для продолжения</h3>

		<form class="ajaxForm" action="/login_user" callback-after="loginUserCallbackAfter">
			<input type="text" name="login" placeholder="Логин">
			<input type="password" name="password" placeholder="Пароль">
			<input type="submit" value="Войти" class="submit">
		</form>

	</section>

	<script src="/js/lib/jquery-3.1.1.min.js"></script>
	<script href="/bootstrap/js/bootstrap.min.js"></script>
	<script src="/js/global.js"></script>

</body>
</html>