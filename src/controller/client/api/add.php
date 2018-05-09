<?php

$status = [];

if (!$_SESSION['user']){
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

function processPostFields ($array) {
    $post_fields = null;
    foreach($array as $key => $val)
        $post_fields[$key] = htmlspecialchars($val, ENT_QUOTES);
    return $post_fields;
}

$user = $_SESSION['user']['id'];
$post_fields = processPostFields($_POST);

if (
    $link->query("
		INSERT INTO `clients`(
			`first_name`, 
			`last_name`, 
			`middle_name`, 
			`birthday`, 
			`passport_prefix`, 
			`passport_number`, 
			`passport_emitted`, 
			`passport_date`, 
			`address_residence`, 
			`address_real`, 
			`phone_home`, 
			`phone_work`, 
			`phone_mobile`, 
			`license_prefix`, 
			`license_number`, 
			`license_emitted`, 
			`license_date`,
			`owner`
			) 
		VALUES(
			'". $post_fields['client_first_name'] ."',
			'". $post_fields['client_last_name'] ."',
			'". $post_fields['client_middle_name'] ."',
			'". $post_fields['client_birthday'] ."',
			'". $post_fields['client_passport_prefix'] ."',
			'". $post_fields['client_passport_number'] ."',
			'". $post_fields['client_passport_emitted'] ."',
			'". $post_fields['client_passport_date'] ."',
			'". $post_fields['client_address_residence'] ."',
			'". $post_fields['client_address_real'] ."',
			'". $post_fields['client_phone_home'] ."',
			'". $post_fields['client_phone_work'] ."',
			'". $post_fields['client_phone_mobile'] ."',
			'". $post_fields['client_license_prefix'] ."',
			'". $post_fields['client_license_number'] ."',
			'". $post_fields['client_license_emitted'] ."',
			'". $post_fields['client_license_date'] .".',
			$user
		)
	")
) {
    $clientId = $link->insert_id;
    if (
        $link->query("
			UPDATE
				`imgs`
			SET
				client_id = $clientId
			WHERE
				client_tmp_id = '". $post_fields['client_tmp_id'] ."' AND
				user = $user
		")
    ) {
        $status['error'] = 200;
        $status['client_passport'] = $post_fields['client_passport_prefix'] . $post_fields['client_passport_number'];
    } else {
        $status['error'] = 202;
    }
} else {
    $status['error'] = 201;
}

echo json_encode($status);
