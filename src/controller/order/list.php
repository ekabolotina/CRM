<?php

if (!$_SESSION['user']) {
    Header('Location: /login');
    die;
}

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

if(
    ($query = $link->query("
			SELECT 
				ord.id AS `id`,
				ord.status AS `order_status`,
				CONCAT(c_makes.name, ' ', c_models.name, ' (', c.car_number , ')') AS `car`,
				CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name, ' (', cl.birthday, ')') AS `client`
			FROM 
				`orders` AS ord
            INNER JOIN `cars` AS c ON ord.car = c.id
            INNER JOIN `car_makes` AS c_makes ON c.car_make = c_makes.id
            INNER JOIN `car_models` AS c_models ON c.car_model = c_models.id
            INNER JOIN `clients` AS cl ON ord.client = cl.id
            LEFT JOIN `users` AS u ON c.user = u.id
            WHERE 
				ord.owner = $user_id OR
				$user_role = ". constant('ROLE_COMPANY') ." AND u.head = $user_id OR
				$user_role = ". constant('ROLE_ADMIN') ."
			ORDER BY ord.status DESC, ord.id DESC
		")) &&
    $query->num_rows
) {
    $orders = $query->fetch_all(MYSQLI_ASSOC);
}


try {
    echo $twig->render( 'order/list.html.twig', [
        'orders' => $orders
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
