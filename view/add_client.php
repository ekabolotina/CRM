<?php

	session_start();

	if(!$_SESSION['user']){
		Header('Location: /login');
		die;
	}

?>

<!DOCTYPE html>
<html lang="ru">
<head>

	<title>Новый клиент</title>

	<?php
		require 'css_load.php';
	?>

	<link rel="stylesheet" href="/js/lib/datepicker/css/bootstrap-datepicker3.min.css">
	<link rel="stylesheet" href="/css/add_client.css?<?php echo time(); ?>">

</head>
<body><div id="bodyWrap">

	<?php
		require 'header.php';
	?>
	
	<div class="container-fluid">

	<?php
		require 'main/add_client.php';
	?>	

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>

	<script src="/js/lib/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="/js/lib/datepicker/locales/bootstrap-datepicker.ru.min.js"></script>	
	<script src="/js/lib/maskedinput.js"></script>
	<script src="/js/add_client.js?<?php echo time(); ?>"></script>

</div></body>
</html>

