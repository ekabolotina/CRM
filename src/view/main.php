<?php

	session_start();

	if(!$_SESSION['user']){
		Header('Location: /login');
		die;
	}

	if(($query = $link->query('SELECT count(0) AS c FROM `cars`')) && $query->num_rows)
		$cars_count = $query->fetch_array(MYSQLI_ASSOC);

	if(($query = $link->query('SELECT count(0) AS c FROM `clients`')) && $query->num_rows)
		$clients_count = $query->fetch_array(MYSQLI_ASSOC);

	if(($query = $link->query('SELECT count(0) AS c FROM `orders`')) && $query->num_rows)
		$orders_count = $query->fetch_array(MYSQLI_ASSOC);			

?>

<!DOCTYPE html>
<html lang="ru">
<head>

	<title>Главная</title>

	<?php
		require 'css_load.php';
	?>

</head>
<body><div id="bodyWrap">

	<?php
		require 'header.php';
	?>
	
	<div class="container-fluid">

		<h2>Добро пожаловать. Вы вошли как <b>&laquo;<?php echo $_SESSION['user']['name']; ?>&raquo;.</b></h2>

		<hr>

		<h3>С чего начать?</h3>
		<ul>
			<li><a href="/settings">Заполните свой профиль</a></li>
			<li><a href="/auto/add">Добавьте автомобиль</a></li>
			<li><a href="/order/new">Создайте новый заказ</a></li>
		</ul>

		<hr>

		<h3>Сейчас в системе</h3>
		<ul>
			<li>Автомобилей <b><?php echo $cars_count['c']; ?></b></li>
			<li>Клиентов <b><?php echo $clients_count['c']; ?></b></li>
			<li>Заказов <b><?php echo $orders_count['c']; ?></b></li>
		</ul>

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>	

</div></body>
</html>

