<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

try {
    echo $twig->render( 'order/add.html.twig', [
        'query_string' => $_GET['q']
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
