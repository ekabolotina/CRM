<?php

	session_start();

	$status = array();

	if(!$_SESSION['user']){
		$status['error'] = 100;
		echo json_encode($status);
		die;
	}

	require_once 'connect.php';

	$id = htmlspecialchars($_POST['id'], ENT_QUOTES);
	$user = $_SESSION['user']['id'];
	
	if(($query = $link->query("
		SELECT 
			CONCAT(c_makes.name, ' ', c_models.name, ' (', c.car_number , ')') AS `car`,
			CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name, ' (', cl.birthday, ')') AS `client`,
			ord.client AS `client_id`
		FROM 
			`orders` AS ord
			INNER JOIN `cars` AS c ON ord.car = c.id
			INNER JOIN `car_makes` AS c_makes ON c.car_make = c_makes.id
			INNER JOIN `car_models` AS c_models ON c.car_model = c_models.id
			INNER JOIN `clients` AS cl ON ord.client = cl.id
		WHERE 
			ord.owner = $user AND
			ord.id = $id
	")) && $query->num_rows){
		$status['error'] = 200;
		$status['data'] = $query->fetch_array(MYSQLI_ASSOC);
	}else
		$status['error'] = 201;

	echo json_encode($status);

?>