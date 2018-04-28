<?php

	$queryPos = strrpos($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']);
	$URI = htmlspecialchars(trim((($queryPos) ? substr_replace($_SERVER['REQUEST_URI'], '', $queryPos) : $_SERVER['REQUEST_URI']), '/?'), ENT_QUOTES);
	$URIParams = $_SERVER['QUERY_STRING'];

	require_once 'routes/connect.php';

	if(($query = $link->query("SELECT page FROM `url` WHERE url = '$URI'")) && $query->num_rows){
		$url = $query->fetch_array(MYSQLI_ASSOC);
		require $url['page'];
	}else
		require 'view/404.php';
	
?>