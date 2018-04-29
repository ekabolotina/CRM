<?php

if (!$_SESSION['user']) {
    Header('Location: /login');
    die;
}

if (
    ($query = $link->query('
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
			ORDER BY c.id
		')) &&
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
