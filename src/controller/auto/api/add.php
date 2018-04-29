<?php

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$car_make = htmlspecialchars($_POST['car_make'], ENT_QUOTES);
$car_model = htmlspecialchars($_POST['car_model'], ENT_QUOTES);
$car_year = htmlspecialchars($_POST['car_year'], ENT_QUOTES);
$car_number = htmlspecialchars($_POST['car_number'], ENT_QUOTES);
$car_body = htmlspecialchars($_POST['car_body'], ENT_QUOTES);
$car_color = htmlspecialchars($_POST['car_color'], ENT_QUOTES);

$user = $_SESSION['user']['id'];

if(
    $car_make &&
    $car_model &&
    $car_year &&
    $car_number &&
    ($query = $link->query("INSERT INTO `cars`(`car_make`, `car_model`, `year`, `car_number`, `user`, `car_body`, `car_color`) VALUES($car_make, $car_model, $car_year, '$car_number', $user, '$car_body', '$car_color')"))
) {
    $status['error'] = 200;
} else {
    $status['error'] = 201;
}

echo json_encode($status);
