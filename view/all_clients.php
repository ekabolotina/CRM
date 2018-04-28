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

	<title>Все клиенты</title>

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

		if(($query = $link->query("
			SELECT 
				CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name) AS `client_name`,
				cl.rate AS `client_rate`,
				cl.blacked AS `client_blacked`,
				cl.id AS `id`,
				CONCAT(cl.passport_prefix, cl.passport_number) AS `client_passport`,
				cl.owner AS `client_owner`
			FROM 
				`clients` AS cl
			WHERE cl.owner = ". $_SESSION['user']['id'] ."			
			ORDER BY 
				id DESC
		")) && $query->num_rows)
			$clients = $query->fetch_all(MYSQLI_ASSOC);

		require 'main/all_clients.php';

	?>

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>	

	<script src="/js/all_clients.js?<?php echo time(); ?>"></script>

</div></body>
</html>

