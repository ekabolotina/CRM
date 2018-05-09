<?php

if (!$_SESSION['user']) {
    Header('Location: /login');
    die;
}

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

if (
    ($query = $link->query("
			SELECT 
				CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name) AS `client_name`,
				cl.rate AS `client_rate`,
				cl.blacked AS `client_blacked`,
				cl.id AS `id`,
				CONCAT(cl.passport_prefix, cl.passport_number) AS `client_passport`,
				cl.owner AS `client_owner`
			FROM 
				`clients` AS cl
			LEFT JOIN `users` AS u ON cl.owner = u.id
			WHERE 
			  cl.owner = $user_id OR
			  $user_id IN (SELECT id FROM users WHERE role = ". constant('ROLE_BRANCH') ." AND head = u.head) OR
			  $user_role = ". constant('ROLE_COMPANY') ." AND u.head = $user_id OR
			  cl.blacked = 1 OR	
			  $user_role = ". constant('ROLE_ADMIN') ."
			ORDER BY 
				id DESC
		")) &&
    $query->num_rows
) {
    $clients = $query->fetch_all(MYSQLI_ASSOC);
}

try {
    echo $twig->render( 'client/list.html.twig', [
        'clients' => $clients
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
