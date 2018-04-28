<?php

	session_start();

	$status = array();

	if($_SESSION['user'])
		unset($_SESSION['user']);
	else
		die;
?>