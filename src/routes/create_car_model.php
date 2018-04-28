<?php

	session_start();

	$status = array();

	if(!$_SESSION['user']){
		$status['error'] = 100;
		echo json_encode($status);
		die;
	}

	require_once 'connect.php';
	
	$car_make = htmlspecialchars($_POST['car_make'], ENT_QUOTES);
	$car_model = trim(htmlspecialchars($_POST['car_model'], ENT_QUOTES));

	$user = $_SESSION['user']['id'];

	if($car_make && $car_model && ctype_digit($car_make)){
		if(($query = $link->query("SELECT id FROM `car_makes` WHERE id = $car_make")) && $query->num_rows){
			if(($query = $link->query("SELECT id FROM `car_models` WHERE name = '$car_model' AND car_make = $car_make")) && !$query->num_rows){
				if($query = $link->query("INSERT INTO `car_models`(`car_make`, `name`) VALUES($car_make, '$car_model')"))
					$status['error'] = 200;
				else
					$status['error'] = 204;
			}else{
				$status['error'] = 203;
			}
		}else{
			$status['error'] = 202;
		}
	}else{
		$status['error'] = 201;
	}


	echo json_encode($status);
?>