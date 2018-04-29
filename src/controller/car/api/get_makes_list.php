<?php

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$term = htmlspecialchars($_POST['term'], ENT_QUOTES);

if (
    ($query = $link->query("SELECT id, name FROM `car_makes` WHERE name LIKE '$term%'")) &&
    $query->num_rows
){
    $status['error'] = 200;
    $status['data'] = $query->fetch_all(MYSQLI_ASSOC);
} else {
    $status['error'] = 201;
}

echo json_encode($status);
