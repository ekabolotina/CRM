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
	
	if(($query = $link->query("
		SELECT  
			com.comment AS `comment`,
			com.mark AS mark,
			u.name AS `user`,
			CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name) AS `client_name`,
			ord.date_from AS `date_from`,
			ord.date_till AS `date_till`,
			CONCAT(c_makes.name, ' ', c_models.name) AS `car`
		FROM 
			`comments` AS com
		INNER JOIN `users` AS u
			ON com.user = u.id
		INNER JOIN `clients` AS cl
			ON com.client = cl.id
		LeFT OUTER JOIN `orders` AS ord
			ON com.order = ord.id
		LeFT OUTER JOIN `cars` AS c
			ON ord.car = c.id
		LeFT OUTER JOIN `car_makes` AS c_makes
			ON c.car_make = c_makes.id	
		LeFT OUTER JOIN `car_models` AS c_models
			ON c.car_model = c_models.id												
		WHERE
			com.client = $id
		ORDER BY com.id DESC
	")) && $query->num_rows){
		$status['error'] = 200;
		$status['data'] = $query->fetch_all(MYSQLI_ASSOC);
	}else{
		$status['error'] = 201;
		$status['ee'] = $link->error;
	}

	echo json_encode($status);

?>