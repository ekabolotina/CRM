<?php

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$term = htmlspecialchars($_POST['term'], ENT_QUOTES);

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

if(
    ($query = $link->query("
        SELECT 
            c.id AS id, 
            CONCAT(c_makes.name, ' ', c_models.name, ' (', c.car_number, ')') AS name 
        FROM `cars` AS c 
        INNER JOIN `car_makes` AS c_makes ON c.car_make = c_makes.id 
        INNER JOIN `car_models` AS c_models ON c.car_model = c_models.id 
        LEFT JOIN `users` AS u ON c.user = u.id
        WHERE 
            (
                c.user = $user_id OR
			    $user_id IN (SELECT id FROM users WHERE role = ". constant('ROLE_BRANCH') ." AND head = u.head) OR
			    $user_role = ". constant('ROLE_COMPANY') ." AND u.head = $user_id OR
			    $user_role = ". constant('ROLE_ADMIN') ."
            ) AND
            (
                c.car_number LIKE '%$term%' OR
                CONCAT(c_makes.name, ' ', c_models.name) LIKE '%$term%'
            )
    ")) &&
    $query->num_rows
) {
    $status['error'] = 200;
    $status['data'] = $query->fetch_all(MYSQLI_ASSOC);
} else {
    $status['error'] = 201;
}

echo json_encode($status);
