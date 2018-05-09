<?php

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$term = htmlspecialchars($_POST['term'], ENT_QUOTES);
$car_make = htmlspecialchars($_POST['car_make'], ENT_QUOTES);

if (
    $car_make &&
    ($query = $link->query("SELECT id, name FROM `car_models` WHERE name LIKE '$term%' AND car_make = $car_make")) &&
    $query->num_rows
) {
    $status['error'] = 200;
    $status['data'] = $query->fetch_all(MYSQLI_ASSOC);
} else {
    $status['error'] = 201;
}

echo json_encode($status);
