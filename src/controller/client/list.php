<?php

if (!$_SESSION['user']) {
    Header('Location: /login');
    die;
}

$user = $_SESSION['user']['id'];

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
			WHERE cl.owner = $user			
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
