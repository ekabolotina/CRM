<?php

if (!$_SESSION['user']) {
    Header('Location: /login');
    die;
}

if ($_SESSION['user']['role'] != constant('ROLE_ADMIN')) {
    Header('Location: /');
    die;
}

if (
    ($query = $link->query("
        SELECT 
            u.id as `id`,
            u.name as `name`,
            (SELECT count(0) FROM `users` WHERE `head` = u.id) as `branches_count`
        FROM 
            `users` AS u
        WHERE u.role = ". constant('ROLE_COMPANY') ."
    ")) &&
    $query->num_rows
) {
    $companies = $query->fetch_all(MYSQLI_ASSOC);
}

try {
    echo $twig->render( 'admin/overview.html.twig', [
        'companies' => $companies
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
