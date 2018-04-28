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
	$user_access = $_SESSION['user']['access'];
	$post_fields = processPostFields($_POST);

	if($link->query("
		UPDATE 
			`clients`
		SET
			`first_name` = '". $post_fields['client_first_name'] ."',
			`last_name` = '". $post_fields['client_last_name'] ."',
			`middle_name` = '". $post_fields['client_middle_name'] ."',
			`birthday` = '". $post_fields['client_birthday'] ."',
			`passport_prefix` = '". $post_fields['client_passport_prefix'] ."',
			`passport_number` = '". $post_fields['client_passport_number'] ."',
			`passport_emitted` = '". $post_fields['client_passport_emitted'] ."',
			`passport_date` = '". $post_fields['client_passport_date'] ."',
			`address_residence` = '". $post_fields['client_address_residence'] ."',
			`address_real` = '". $post_fields['client_address_real'] ."',
			`phone_home` = '". $post_fields['client_phone_home'] ."',
			`phone_work` = '". $post_fields['client_phone_work'] ."',
			`phone_mobile` = '". $post_fields['client_phone_mobile'] ."',
			`license_prefix` = '". $post_fields['client_license_prefix'] ."',
			`license_number` = '". $post_fields['client_license_number'] ."',
			`license_emitted` = '". $post_fields['client_license_emitted'] ."',
			`license_date` = '". $post_fields['client_license_date'] ."'
		WHERE
			id = ". $post_fields['client_id'] ." AND
			(owner = $user OR $user_access = 1)
	")){
		if($link->query("
			UPDATE
				`imgs`
			SET
				client_id = client_tmp_id
			WHERE
				client_tmp_id = '". $post_fields['client_id'] ."' AND 
				user = $user
		"))
			$status['error'] = 200;
		else
			$status['error'] = 202;
	}else{
		$status['error'] = 201;
		$status['ee'] = $link->error;
	}

	echo json_encode($status);
?>