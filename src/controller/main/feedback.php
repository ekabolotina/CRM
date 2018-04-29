<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

try {
    echo $twig->render( 'main/feedback.html.twig', [
        'referer' => $_SERVER['HTTP_REFERER']
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
