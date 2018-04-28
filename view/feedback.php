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

	<title>Обратная связь</title>

	<?php
		require 'css_load.php';
	?>

</head>
<body><div id="bodyWrap">

	<?php
		require 'header.php';
	?>
	
	<div class="container-fluid">

	<?php
		require 'main/feedback.php';
	?>	

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>

</div></body>
</html>

