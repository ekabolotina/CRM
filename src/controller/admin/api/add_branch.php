<?php

use Mail\Mail;

$status = [];

if (
    !$_SESSION['user'] ||
    !in_array($_SESSION['user']['role'], [constant('ROLE_ADMIN'), constant('ROLE_COMPANY')])
) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$company_id = htmlspecialchars($_POST['company_id'], ENT_QUOTES);
$branch_name = htmlspecialchars($_POST['branch_name'], ENT_QUOTES);
$branch_email = htmlspecialchars($_POST['branch_email'], ENT_QUOTES);

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

$password = mt_rand(1000000, 9999999);

if (
    $branch_name &&
    $branch_email &&
    (
        ($user_role == constant('ROLE_ADMIN') && $company_id && ctype_digit($company_id)) ||
        $user_role == constant('ROLE_COMPANY')
    )
) {
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
              '$branch_name',
              '$branch_email',
              SHA1('$password'),
              5,
              '',
              '$branch_email',
              ". constant('ROLE_BRANCH') .",
              IF ($user_role = ". constant('ROLE_ADMIN') .", $company_id, $user_id)
            )
        ")
    ) {
        $status['error'] = 200;
        $status['branchName'] = $branch_name;
    } else {
        $status['error'] = 202;
    }
} else {
    $status['error'] = 201;
}

if ($status['error'] == 200) {
    $mail_body = '';
    try {
        $mail_body = $twig->render( 'mail/registration.html.twig', [
            'login' => $branch_email,
            'password' => $password
        ]);
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }

    $mail = new Mail();
    $mail->send($branch_email, $mail_body);
}

echo json_encode($status);
