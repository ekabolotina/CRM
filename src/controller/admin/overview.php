<?php

if (!$_SESSION['user']) {
    Header('Location: /login');
    die;
}

if (!in_array($_SESSION['user']['role'], [constant('ROLE_ADMIN'), constant('ROLE_COMPANY')])) {
    Header('Location: /');
    die;
}

if ($_SESSION['user']['role'] == constant('ROLE_ADMIN')) {
    if (
        ($query = $link->query("
        SELECT 
            u.id as `id`,
            u.name as `name`,
            (SELECT count(0) FROM `users` WHERE `head` = u.id) as `branches_count`
        FROM 
            `users` AS u
        WHERE u.role = " . constant('ROLE_COMPANY') . "
    ")) &&
        $query->num_rows
    ) {
        $companies = $query->fetch_all(MYSQLI_ASSOC);
    }

    try {
        echo $twig->render('admin/admin/overview.html.twig', [
            'companies' => $companies
        ]);
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}

if ($_SESSION['user']['role'] == constant('ROLE_COMPANY')) {
    if (
        ($query = $link->query("
        SELECT 
            u.id as `id`,
            u.name as `name`,
            (SELECT count(0) FROM `orders` WHERE `owner` = u.id) as `orders_count`
        FROM 
            `users` AS u
        WHERE u.role = " . constant('ROLE_BRANCH') . "
    ")) &&
        $query->num_rows
    ) {
        $branches = $query->fetch_all(MYSQLI_ASSOC);
    }

    try {
        echo $twig->render('admin/company/overview.html.twig', [
            'branches' => $branches
        ]);
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}
