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
			`id`,
			CONCAT(last_name, ' ', first_name, ' ', middle_name) AS `name`,
			`birthday`,
			CONCAT(passport_prefix, passport_number, ', выдан ', passport_emitted, ' ', passport_date) AS `passport`,
			CONCAT(license_prefix, license_number, ', выдано ', license_emitted, ' ', license_date) AS `license`,
			`address_residence`, 
			`address_real`, 
			`phone_home`, 
			`phone_work`, 
			`phone_mobile`, 
			`blacked`, 
			`rate` 
		FROM 
			`clients` 
		WHERE 
			id = $id
	")) && $query->num_rows){
		$status['data'] = $query->fetch_array(MYSQLI_ASSOC);
		if(($query = $link->query('SELECT url FROM `imgs` WHERE client_id = '. $status['data']['id'])) && $query->num_rows)
			$status['data']['imgs'] = $query->fetch_all(MYSQLI_ASSOC);
		$status['error'] = 200;
	}else
		$status['error'] = 201;

	echo json_encode($status);

?>