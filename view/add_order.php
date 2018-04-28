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

	<title>Заказ</title>

	<?php
		require 'css_load.php';
	?>

	<link rel="stylesheet" href="/js/lib/select2/css/select2.min.css">
	<link rel="stylesheet" href="/js/lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

	<style>
		#orderExecuteForm a{
			margin-right: 10px;
		}
	</style>

</head>
<body><div id="bodyWrap">

	<?php
		require 'header.php';
	?>
	
	<div class="container-fluid">
	
	<?php
		require 'main/add_order.php';
	?>

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>

	<script src="/js/lib/select2/js/select2.full.min.js"></script>
	<script src="/js/lib/select2/js/i18n/ru.js"></script>
	<script src="/js/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/js/lib/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.ru.js"></script>
	<script src="/js/lib/maskedinput.js"></script>
	<script src="/js/order.js?<?php echo time(); ?>"></script>	
	<script src="/js/all_clients.js?<?php echo time(); ?>"></script>	

</div></body>
</html>

