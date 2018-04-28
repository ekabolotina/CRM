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

	<title>Новая модель автомобиля</title>

	<?php
		require 'css_load.php';
	?>

	<link rel="stylesheet" href="../js/lib/select2/css/select2.min.css">

</head>
<body><div id="bodyWrap">

	<?php
		require 'header.php';
	?>
	
	<div class="container-fluid">

	<?php
		require 'main/create_auto.php';
	?>

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>	

	<script src="/js/lib/select2/js/select2.full.min.js"></script>
	<script src="/js/lib/select2/js/i18n/ru.js"></script>
	<script src="/js/lib/maskedinput.js"></script>
	<script src="/js/create_auto.js?<?php echo time(); ?>"></script>

</div></body>
</html>
