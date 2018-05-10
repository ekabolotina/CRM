<?php

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

$user_id = $_SESSION['user']['id'];

if (
    $_SESSION['user']['role'] == constant('ROLE_COMPANY') &&
    ($query = $link->query("
        SELECT
          c.city AS `city`, 
          c.director_name AS `director_name`, 
          c.address AS `address`, 
          c.bank_name AS `bank_name`, 
          c.inn AS `inn`, 
          c.kpp AS `kpp`, 
          c.checking_account AS `checking_account`, 
          c.correspondent_account AS `correspondent_account`, 
          c.bik AS `bik`,
          c.form AS `form`,
          c.name AS `name`
        FROM `users` AS u
        INNER JOIN `companies` AS c ON u.id = c.user
        WHERE u.id = $user_id
    ")) &&
    $query->num_rows
) {
    $company = $query->fetch_array(MYSQLI_ASSOC);
}

try {
    echo $twig->render( 'main/settings.html.twig', [
        'company' => $company
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}
