<?php

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$id = htmlspecialchars($_POST['id'], ENT_QUOTES);

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

if (
    ($query = $link->query("
		SELECT 
			cl.id AS `id`,
			CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name) AS `name`,
			cl.birthday AS `birthday`,
			CONCAT(cl.passport_prefix, cl.passport_number, ', выдан ', cl.passport_emitted, ' ', cl.passport_date) AS `passport`,
			CONCAT(cl.license_prefix, cl.license_number, ', выдано ', cl.license_emitted, ' ', cl.license_date) AS `license`,
			cl.address_residence AS `address_residence`, 
			cl.address_real AS `address_real`, 
			cl.phone_home AS `phone_home`, 
			cl.phone_work AS `phone_work`, 
			cl.phone_mobile AS `phone_mobile`, 
			cl.blacked AS `blacked`, 
			cl.rate AS `rate` 
		FROM 
			`clients` AS cl
		LEFT JOIN `users` as u ON cl.owner = u.id
		WHERE 
			cl.id = $id AND
			(
			    cl.owner = $user_id OR
			    $user_id IN (SELECT id FROM users WHERE role = ". constant('ROLE_BRANCH') ." AND head = u.head) OR
                $user_role = " . constant('ROLE_COMPANY') . " AND u.head = $user_id OR
                cl.blacked = 1 OR
                $user_role = ". constant('ROLE_ADMIN') ."
		    )
	")) &&
    $query->num_rows
) {
    $status['data'] = $query->fetch_array(MYSQLI_ASSOC);
    if(
        ($query = $link->query('SELECT url FROM `imgs` WHERE client_id = '. $status['data']['id'])) &&
        $query->num_rows
    ) {
        $status['data']['imgs'] = $query->fetch_all(MYSQLI_ASSOC);
    }
    $status['error'] = 200;
} else {
    $status['error'] = 201;
}

echo json_encode($status);
