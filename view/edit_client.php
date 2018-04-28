<?php

	session_start();

	if(!$_SESSION['user']){
		Header('Location: /login');
		die;
	}

	$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
	$user = $_SESSION['user']['id'];
	$user_access = $_SESSION['user']['access'];

	if(($query = $link->query("
		SELECT 
			`id`, 
			`first_name`, 
			`last_name`, 
			`middle_name`, 
			`birthday`, 
			`passport_prefix`, 
			`passport_number`, 
			`passport_emitted`, 
			`passport_date`, 
			`address_residence`, 
			`address_real`, 
			`phone_home`, 
			`phone_work`, 
			`phone_mobile`, 
			`license_prefix`, 
			`license_number`, 
			`license_emitted`, 
			`license_date`
		FROM 
			`clients`
		WHERE 
			id = $id AND
			(owner = $user OR $user_access = 1)
	")) && $query->num_rows)
		$client = $query->fetch_array(MYSQLI_ASSOC);

	if($client && ($query = $link->query("
		SELECT 
			`id`, 
			`url`
		FROM 
			`imgs`
		WHERE 
			client_id = ". $client['id']
	)) && $query->num_rows)
		$client_imgs = $query->fetch_all(MYSQLI_ASSOC);	
?>

<!DOCTYPE html>
<html lang="ru">
<head>

	<title>Редактирование клиента</title>

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
		require 'main/edit_client.php';
	?>	

	</div>

	<?php
		require 'footer.php';
		require 'js_load.php';
	?>

	<script src="/js/lib/datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="/js/lib/datepicker/locales/bootstrap-datepicker.ru.min.js"></script>	
	<script src="/js/edit_client.js?<?php echo time(); ?>"></script>

</div></body>
</html>

