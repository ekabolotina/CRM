<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

try {
    echo $twig->render( 'main/settings.html.twig');
} catch (Exception $exception) {
    echo $exception->getMessage();
}
