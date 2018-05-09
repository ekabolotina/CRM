<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

if ($_SESSION['user']['role'] != constant('ROLE_ADMIN')) {
    Header('Location: /');
    die;
}

try {
    echo $twig->render( 'admin/admin/add_company.html.twig');
} catch (Exception $exception) {
    echo $exception->getMessage();
}
