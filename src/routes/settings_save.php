<?php

	session_start();

	$status = array();

	if(!$_SESSION['user']){
		$status['error'] = 100;
		echo json_encode($status);
		die;
	}

	require_once 'connect.php';
	
	function processPostFields($array){
		$post_fields = null; 
		foreach($array as $key => $val)
			$post_fields[$key] = htmlspecialchars($val, ENT_QUOTES);
		return $post_fields;
	}

	$user = $_SESSION['user']['id'];
	$post_fields = processPostFields($_POST);

	if($link->query("
		UPDATE 
			`users` 
		SET 
			name = '". $post_fields['name'] ."',
			rent_place = '". $post_fields['rent_place'] . "'" .
			(($post_fields['pass']) ? ", password = SHA1('". $post_fields['pass'] ."')" : "") . "
		WHERE
			id = ". $user	
	)){
		$status['error'] = 200;
		$_SESSION['user']['rent_place'] = $post_fields['rent_place'];
		$_SESSION['user']['name'] = $post_fields['name'];
	}
	else
		$status['error'] = 201;

	echo json_encode($status);
?>