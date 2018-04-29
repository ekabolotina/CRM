<?php

if (!$_SESSION['user']) {
    Header('Location: /login');
    die;
}

try {
    echo $twig->render( 'car/add_model.html.twig');
} catch (Exception $exception) {
    echo $exception->getMessage();
}
