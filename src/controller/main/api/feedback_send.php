<?php

use Mail\Mail;

$status = [];

if (!$_SESSION['user']) {
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

function processPostFields($array){
    $post_fields = null;
    foreach($array as $key => $val)
        $post_fields[$key] = htmlspecialchars($val, ENT_QUOTES);
    return $post_fields;
}

$user = $_SESSION['user']['id'];
$post_fields = processPostFields($_POST);

$mail_body = '';
try {
    $mail_body = $twig->render( 'mail/feedback.html.twig', [
        'user' => $user,
        'question' => $post_fields['question'],
        'contacts' => $post_fields['contacts'],
        'referer' => $post_fields['referer']
    ]);
} catch (Exception $exception) {
    echo $exception->getMessage();
}

$mail = new Mail();

if ($mail->send('ivan.rusia@mail.ru', $mail_body)) {
    $status['error'] = 200;
} else {
    $status['error'] = 201;
}

echo json_encode($status);
