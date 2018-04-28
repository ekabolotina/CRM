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

	<title>Новый автомобиль</title>

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
		require 'main/settings.php';
	?>	

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>	

	<script src="/js/settings.js?<?php echo time(); ?>"></script>

</div></body>
</html>

