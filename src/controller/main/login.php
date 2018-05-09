<?php

if($_SESSION['user']){
    Header('Location: /');
    die;
}

try {
    echo $twig->render( 'main/login.html.twig');
} catch (Exception $exception) {
    echo $exception->getMessage();
}
