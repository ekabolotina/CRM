<?php

require_once 'load.php';

$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
    'debug' => constant('DEV_MODE')
));
$twig->addGlobal('user', $_SESSION['user']);

$queryPos = strrpos($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']);
$URI = htmlspecialchars(trim((($queryPos) ? substr_replace($_SERVER['REQUEST_URI'], '', $queryPos) : $_SERVER['REQUEST_URI']), '/?'), ENT_QUOTES);
$URIParams = $_SERVER['QUERY_STRING'];

if(($query = $link->query("SELECT page FROM `url` WHERE url = '$URI'")) && $query->num_rows){
    $url = $query->fetch_array(MYSQLI_ASSOC);
    require constant('CONTROLLERS_PATH') . $url['page'];
}else
    require constant('CONTROLLERS_PATH') . 'error/err_404.php';
