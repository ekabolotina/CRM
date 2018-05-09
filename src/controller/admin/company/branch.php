<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

if ($_SESSION['user']['role'] != constant('ROLE_COMPANY')) {
    Header('Location: /');
    die;
}

$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
$user = $_SESSION['user']['id'];

if (
    ctype_digit($id) &&
    ($query = $link->query("
        SELECT
            `id`,
            `name`
        FROM `users`
        WHERE 
            id = $id AND 
            role = ". constant('ROLE_BRANCH') ."
    ")) &&
    $query->num_rows
) {
    $branch = $query->fetch_array(MYSQLI_ASSOC);
} else {
    Header('Location: /admin');
    die;
}

if(
    ctype_digit($id) &&
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
			WHERE 
				ord.owner = $id
			ORDER BY ord.status DESC, ord.id DESC
		")) &&
    $query->num_rows
) {
    $orders = $query->fetch_all(MYSQLI_ASSOC);
}

try {
    echo $twig->render( 'admin/company/branch.html.twig', [
        'branch' => $branch,
        'orders' => $orders
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
