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

	if($post_fields['car'] && ctype_digit($post_fields['car']) && $query = $link->query("
		INSERT INTO `orders`(
			`car`, 
			`client`, 
			`date_from`, 
			`date_till`,
			`owner`,
			`place`,
			`price`,
			`assessed_price`,
			`rent_period`,
			`fact_return_date`,
			`fact_return_place`,
			`people_allowed`,
			`insurance_deposit`,
			`full_price`,
			`full_price_off`
		) VALUES(
			". $post_fields['car'] .",
			". $post_fields['client'] .",
			'". $post_fields['date_from'] ."',
			'". $post_fields['date_till'] ."',
			$user,
			'". $post_fields['place'] ."',
			'". $post_fields['price'] ."',
			'". $post_fields['assessed_price'] ."',
			'". $post_fields['rent_period'] ."',
			'". $post_fields['fact_return_date'] ."',
			'". $post_fields['fact_return_place'] ."',
			'". $post_fields['people_allowed'] ."',
			'". $post_fields['insurance_deposit'] ."',
			'". $post_fields['full_price'] ."',
			'". $post_fields['full_price_off'] ."'
		)
	")){
		$status['error'] = 200;
		$status['id'] = $link->insert_id;
	}else{
		$status['error'] = 201;
		$status['message'] = $link->error;
	}


	echo json_encode($status);
?>