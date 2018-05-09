<?php

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$term = trim(htmlspecialchars($_POST['term'], ENT_QUOTES));

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

if(
    ($query = $link->query("
		SELECT 
			cl.id AS `id`, 
			CONCAT(cl.first_name, ' ',cl.last_name) AS `name`, 
			cl.first_name AS `first_name`, 
			cl.last_name AS `last_name`, 
			cl.middle_name AS `middle_name`, 
			cl.birthday AS `birthday`, 
			cl.passport_prefix AS `passport_prefix`, 
			cl.passport_number AS `passport_number`, 
			cl.passport_emitted AS `passport_emitted`, 
			cl.passport_date AS `passport_date`, 
			cl.address_residence AS `address_residence`, 
			cl.address_real AS `address_real`, 
			cl.phone_home AS `phone_home`, 
			cl.phone_work AS `phone_work`, 
			cl.phone_mobile AS `phone_mobile`, 
			cl.license_prefix AS `license_prefix`, 
			cl.license_number AS `license_number`, 
			cl.license_emitted AS `license_emitted`, 
			cl.license_date AS `license_date`, 
			cl.blacked AS `blacked`, 
			cl.rate AS `rate`,
			if(cl.owner = $user_id OR $user_role = " . constant('ROLE_COMPANY') . " AND u.head = $user_id, 1, 0) AS `can_eidt`
		FROM 
			`clients` AS cl
		LEFT JOIN `users` as u ON cl.owner = u.id
		WHERE 
		    (
		      cl.owner = $user_id OR
		      $user_id IN (SELECT id FROM users WHERE role = ". constant('ROLE_BRANCH') ." AND head = u.head) OR
		      $user_role = " . constant('ROLE_COMPANY') . " AND u.head = $user_id OR
		      cl.blacked = 1 OR
		      $user_role = ". constant('ROLE_ADMIN') ."
		    ) AND
		    (
                CONCAT(cl.first_name, ' ', cl.middle_name, ' ', cl.last_name) LIKE '%$term%' OR
                CONCAT(cl.first_name, ' ', cl.last_name, ' ', cl.middle_name) LIKE '%$term%' OR
                CONCAT(cl.middle_name, ' ', cl.first_name, ' ', cl.last_name) LIKE '%$term%' OR
                CONCAT(cl.middle_name, ' ', cl.last_name, ' ', cl.first_name) LIKE '%$term%' OR
                CONCAT(cl.last_name, ' ', cl.middle_name, ' ', cl.first_name) LIKE '%$term%' OR
                CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name) LIKE '%$term%' OR
                CONCAT(cl.passport_prefix, cl.passport_number) LIKE '%$term%' OR
                CONCAT(cl.license_prefix, cl.license_number) LIKE '%$term%'
            )
		ORDER BY
			cl.id DESC
	")) &&
    $query->num_rows
) {
    $status['error'] = 200;
    $status['data'] = $query->fetch_all(MYSQLI_ASSOC);
} else {
    $status['error'] = 201;
}

echo json_encode($status);
