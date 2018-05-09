<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

if ($_SESSION['user']['role'] != constant('ROLE_COMPANY')) {
    Header('Location: /');
    die;
}

try {
    echo $twig->render( 'admin/company/add_branch.html.twig');
} catch (Exception $exception) {
    echo $exception->getMessage();
}
