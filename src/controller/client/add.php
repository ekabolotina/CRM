<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

try {
    echo $twig->render( 'client/add.html.twig', [
        'client_tmp_id' => sha1(time() * mt_rand(999, 9999))
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
