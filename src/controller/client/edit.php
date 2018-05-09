<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

$id = htmlspecialchars($_GET['id'], ENT_QUOTES);

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

if(
    ($query = $link->query("
		SELECT 
			cl.id AS `id`, 
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
			cl.license_date AS `license_date`
		FROM 
			`clients` AS cl
		LEFT JOIN `users` as u ON cl.owner = u.id
		WHERE 
			id = $id AND
			(
			  owner = $user_id OR
			  $user_role = ". constant('ROLE_COMPANY') ." AND u.head = $user_id
			)
	")) &&
    $query->num_rows
) {
    $client = $query->fetch_array(MYSQLI_ASSOC);
}

if(
    $client &&
    ($query = $link->query("
		SELECT 
			`id`, 
			`url`
		FROM 
			`imgs`
		WHERE 
			client_id = ". $client['id']
    ))
    && $query->num_rows
) {
    $client_imgs = $query->fetch_all(MYSQLI_ASSOC);
}


try {
    echo $twig->render( 'client/edit.html.twig', [
        'client' => $client,
        'client_imgs' => $client_imgs
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
