<?php

	session_start();

	$status = array();

	if(!$_SESSION['user']){
		$status['error'] = 100;
		echo json_encode($status);
		die;
	}

	require_once 'connect.php';

	$term = htmlspecialchars($_POST['term'], ENT_QUOTES);
	
	if(($query = $link->query("SELECT id, name FROM `car_makes` WHERE name LIKE '$term%'")) && $query->num_rows){
		$status['error'] = 200;
		$status['data'] = $query->fetch_all(MYSQLI_ASSOC);
	}else
		$status['error'] = 201;

	echo json_encode($status);

?>