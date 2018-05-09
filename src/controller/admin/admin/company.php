<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

if ($_SESSION['user']['role'] != constant('ROLE_ADMIN')) {
    Header('Location: /');
    die;
}

$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
$user = $_SESSION['user']['id'];

if (
    ctype_digit($id) &&
    ($query = $link->query("
        SELECT
            `id`,
            `name`
        FROM `users`
        WHERE 
            id = $id AND 
            role = ". constant('ROLE_COMPANY') ."
    ")) &&
    $query->num_rows
) {
    $company = $query->fetch_array(MYSQLI_ASSOC);
}

if (!count($company)) {
    Header('Location: /admin');
    die;
}

if (
    ctype_digit($id) &&
    ($query = $link->query("
        SELECT
            `id`,
            `name`
        FROM `users`
        WHERE 
            head = $id AND 
            role = ". constant('ROLE_BRANCH') ."
    ")) &&
    $query->num_rows
) {
    $branches = $query->fetch_all(MYSQLI_ASSOC);
}

$company_branches_ids = [];
foreach ($branches as $branch) {
    $company_branches_ids[] = $branch['id'];
}
$company_branches_ids_string = implode(',', $company_branches_ids);

if (
    ctype_digit($id) &&
    ($query = $link->query("
        SELECT
            (SELECT count(0) FROM `orders` WHERE owner IN($company_branches_ids_string)) AS `orders_count`,
            (SELECT count(0) FROM `clients` WHERE owner IN($company_branches_ids_string)) AS `clients_count`,
            (SELECT count(0) FROM `cars` WHERE user IN($company_branches_ids_string)) AS `cars_count`
    ")) &&
    $query->num_rows
) {
    $company_info = $query->fetch_array(MYSQLI_ASSOC);
}


try {
    echo $twig->render( 'admin/admin/company.html.twig', [
        'company' => $company,
        'branches' => $branches,
        'company_info' => $company_info
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
