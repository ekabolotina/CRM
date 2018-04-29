<?php

$status = [];

if (!$_SESSION['user']){
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$id = htmlspecialchars($_POST['id']);
$user = $_SESSION['user']['id'];
$access = $_SESSION['user']['access'];

if (
    $user &&
    $id
){
    $img = @($link->query("SELECT url, user FROM `imgs` WHERE id = $id")->fetch_array(MYSQLI_ASSOC));
    if (
        $img &&
        ($img['user'] == $user  || $access == 1)
    ) {
        if (unlink(constant('UPLOAD_DIR') . $img['url'])){
            if ($link->query("DELETE FROM `imgs` WHERE id = $id")) {
                $status['error'] = 200;
            } else {
                $status['error'] = 204;
            }
        } else {
            $status['error'] = 203;
        }
    } else {
        $status['error'] = 202;
    }
} else {
    $status['error'] = 201;
}

echo json_encode($status);
