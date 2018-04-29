<?php

$status = [];

if($_SESSION['user']){
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$login = htmlspecialchars($_POST['login'], ENT_QUOTES);
$pass = htmlspecialchars($_POST['password'], ENT_QUOTES);

if($login){
    if(($query = $link->query("SELECT * FROM `users` WHERE login = '$login' AND password = sha1('$pass')")) && $query->num_rows){
        $_SESSION['user'] = $query->fetch_array(MYSQLI_ASSOC);
        $status['error'] = 200;
    }else
        $status['error'] = 202;
}else
    $status['error'] = 201;

echo json_encode($status);