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
				c_makes.name AS `car_make`, 
				c_models.name AS `car_model`, 
				c.car_number AS `car_number`,
				c.year AS `car_year`,
				c.car_body AS `car_body`,
				c.car_color AS `car_color`
			FROM 
				`cars` AS c 
			INNER JOIN `car_makes` AS c_makes 
				ON c_makes.id = c.car_make 
			INNER JOIN `car_models` AS c_models 
				ON c_models.id = c.car_model 
			LEFT JOIN `users` AS u 
			    ON c.user = u.id
			WHERE
			    c.user = $user_id OR
			    $user_id IN (SELECT id FROM users WHERE role = ". constant('ROLE_BRANCH') ." AND head = u.head) OR
			    $user_role = ". constant('ROLE_COMPANY') ." AND u.head = $user_id OR
			    $user_role = ". constant('ROLE_ADMIN') ."
			ORDER BY c.id
		")) &&
    $query->num_rows
) {
    $cars = $query->fetch_all(MYSQLI_ASSOC);
}

try {
    echo $twig->render( 'auto/list.html.twig', [
        'cars' => $cars
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
