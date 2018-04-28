<?php

	session_start();

	if(!$_SESSION['user']){
		Header('Location: /login');
		die;
	}

?>

<!DOCTYPE html>
<html lang="ru">
<head>

	<title>Все заказы</title>

	<?php
		require 'css_load.php';
	?>

	<style>
		#returnOrderModal .modal-content{
			padding: 15px;
		}

		
	</style>

</head>
<body><div id="bodyWrap">

	<?php
		require 'header.php';
	?>
	
	<div class="container-fluid">

	<?php

		$user = $_SESSION['user']['id'];

		if(($query = $link->query("
			SELECT 
				ord.id AS `id`,
				ord.status AS `order_status`,
				CONCAT(c_makes.name, ' ', c_models.name, ' (', c.car_number , ')') AS `car`,
				CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name, ' (', cl.birthday, ')') AS `client`
			FROM 
				`orders` AS ord
				INNER JOIN `cars` AS c ON ord.car = c.id
				INNER JOIN `car_makes` AS c_makes ON c.car_make = c_makes.id
				INNER JOIN `car_models` AS c_models ON c.car_model = c_models.id
				INNER JOIN `clients` AS cl ON ord.client = cl.id
			WHERE 
				ord.owner = $user
			ORDER BY ord.status DESC, ord.id DESC
		")) && $query->num_rows)
			$orders = $query->fetch_all(MYSQLI_ASSOC);

		require 'main/all_orders.php';

	?>

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>	

	<script src="/js/all_orders.js?<?php echo time(); ?>"></script>

</div></body>
</html>

