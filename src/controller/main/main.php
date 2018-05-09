<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

if(($query = $link->query('SELECT count(0) AS c FROM `cars`')) && $query->num_rows) {
    $cars_count = $query->fetch_array(MYSQLI_ASSOC);
}

if(($query = $link->query('SELECT count(0) AS c FROM `clients`')) && $query->num_rows) {
    $clients_count = $query->fetch_array(MYSQLI_ASSOC);
}

if(($query = $link->query('SELECT count(0) AS c FROM `orders`')) && $query->num_rows) {
    $orders_count = $query->fetch_array(MYSQLI_ASSOC);
}

try {
    echo $twig->render( 'main/index.html.twig', [
        'cars_count' => $cars_count['c'],
        'clients_count' => $clients_count['c'],
        'orders_count' => $orders_count['c']
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}

