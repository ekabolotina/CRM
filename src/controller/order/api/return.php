<?php

$status = [];

if(!$_SESSION['user']){
    $status['error'] = 100;
    echo json_encode($status);
    die;
}

$orderId = htmlspecialchars($_POST['order_id'], ENT_QUOTES);
$mark = htmlspecialchars($_POST['mark'], ENT_QUOTES);
$comment = htmlspecialchars($_POST['comment'], ENT_QUOTES);
$blacked = htmlspecialchars($_POST['blacked'], ENT_QUOTES);

$user = $_SESSION['user']['id'];

if (
    ($query = $link->query("SELECT client FROM `orders` WHERE id = $orderId AND owner = $user")) &&
    $query->num_rows
) {
    $client = $query->fetch_array(MYSQLI_ASSOC);
    $link->multi_query("
        UPDATE `orders` SET status = 0 WHERE id = $orderId AND owner = $user; 
        UPDATE `clients` SET rate = ((rate + $mark)/if(rate = 0, 1, 2)), blacked = $blacked WHERE id = ". $client['client'] .";
        INSERT INTO `comments`(`user`, `client`, `comment`, `mark`, `order`) VALUES($user, ". $client['client'] .", '$comment', $mark, $orderId);
	");
    $status['error'] = 200;
} else {
    $status['error'] = 201;
}

echo json_encode($status);
