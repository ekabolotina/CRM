<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
$user = $_SESSION['user']['id'];
$user_access = $_SESSION['user']['access'];

if(
    ($query = $link->query("
		SELECT 
			`id`, 
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
			`license_date`
		FROM 
			`clients`
		WHERE 
			id = $id AND
			(owner = $user OR $user_access = 1)
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
