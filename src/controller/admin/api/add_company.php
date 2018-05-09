<?php

use Mail\Mail;

$status = [];

if (!$_SESSION['user'] || $_SESSION['user']['role'] != constant('ROLE_ADMIN')) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$company_name = htmlspecialchars($_POST['company_name'], ENT_QUOTES);
$company_email = htmlspecialchars($_POST['company_email'], ENT_QUOTES);

$user_id = $_SESSION['user']['id'];

$password = mt_rand(1000000, 9999999);

if ($company_name && $company_email) {
    if (
        ($query = $link->query("SELECT `id` FROM `users` WHERE email = '$company_email'")) &&
        $query->num_rows
    ) {
        $status['error'] = 203;
    } else {
        if (
        $link->query("
                INSERT INTO `users` (
                  `name`, 
                  `login`, 
                  `password`, 
                  `access`, 
                  `rent_place`, 
                  `email`, 
                  `role`, 
                  `head`
                ) 
                VALUES (
                  '$company_name',
                  '$company_email',
                  SHA1('$password'),
                  5,
                  '',
                  '$company_email',
                  ". constant('ROLE_COMPANY') .",
                  $user_id
                )
            ")
        ) {
            $status['error'] = 200;
            $status['companyId'] = $link->insert_id;
        } else {
            $status['error'] = 202;
        }
    }
} else {
    $status['error'] = 201;
}

if ($status['error'] == 200) {
    $mail_body = '';
    try {
        $mail_body = $twig->render( 'mail/registration.html.twig', [
            'login' => $company_email,
            'password' => $password
        ]);
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }

    $mail = new Mail();
    $mail->send($company_email, $mail_body);
}

echo json_encode($status);
