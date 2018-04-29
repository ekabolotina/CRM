<?php

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$term = trim(htmlspecialchars($_POST['term'], ENT_QUOTES));

if(
    ($query = $link->query("
		SELECT 
			`id`, 
			CONCAT(first_name, ' ',last_name) AS `name`, 
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
			`blacked`, 
			`rate`,
			if(owner = ". $_SESSION['user']['id'] ." OR ". $_SESSION['user']['access'] ." = 1, 1, 0) AS `can_eidt`
		FROM 
			`clients` 
		WHERE 
			CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE '%$term%' OR
			CONCAT(first_name, ' ', last_name, ' ', middle_name) LIKE '%$term%' OR
			CONCAT(middle_name, ' ', first_name, ' ', last_name) LIKE '%$term%' OR
			CONCAT(middle_name, ' ', last_name, ' ', first_name) LIKE '%$term%' OR
			CONCAT(last_name, ' ', middle_name, ' ', first_name) LIKE '%$term%' OR
			CONCAT(last_name, ' ', first_name, ' ', middle_name) LIKE '%$term%' OR
			CONCAT(passport_prefix, passport_number) LIKE '%$term%' OR
			CONCAT(license_prefix, license_number) LIKE '%$term%'
		ORDER BY
			id DESC
	")) &&
    $query->num_rows
) {
    $status['error'] = 200;
    $status['data'] = $query->fetch_all(MYSQLI_ASSOC);
} else {
    $status['error'] = 201;
}

echo json_encode($status);
