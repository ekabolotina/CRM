<?php

$status = [];

if(!$_SESSION['user'] || $_SESSION['user']['role'] != constant('ROLE_COMPANY')){
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

function processPostFields($array){
    $post_fields = null;
    foreach($array as $key => $val)
        $post_fields[$key] = htmlspecialchars($val, ENT_QUOTES);
    return $post_fields;
}

$user = $_SESSION['user']['id'];
$post_fields = processPostFields($_POST);

if ($link->query("
		UPDATE 
			`companies` 
		SET 
			`city`='". $post_fields['company_city'] ."',
			`director_name`='". $post_fields['company_director_name'] ."',
			`address`='". $post_fields['company_address'] ."',
			`bank_name`='". $post_fields['company_bank_name'] ."',
			`inn`='". $post_fields['company_inn'] ."',
			`kpp`='". $post_fields['company_kpp'] ."',
			`checking_account`='". $post_fields['company_checking_account'] ."',
			`correspondent_account`='". $post_fields['company_correspondent_account'] ."',
			`bik`='". $post_fields['company_bik'] ."',
			`form`='". $post_fields['company_form'] ."',
			`name`='". $post_fields['company_name'] ."'
		WHERE
			user = ". $user
)) {
    $status['error'] = 200;
} else {
    $status['error'] = $link->error;
}

echo json_encode($status);
