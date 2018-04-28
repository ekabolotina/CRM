<?php

	session_start();

	$status = array();

	if(!$_SESSION['user']){
		$status['error'] = 100;
		echo json_encode($status);
		die;
	}

	require_once 'connect.php';
	require_once 'lib/PHPMailer/PHPMailerAutoload.php';
	
	function processPostFields($array){
		$post_fields = null; 
		foreach($array as $key => $val)
			$post_fields[$key] = htmlspecialchars($val, ENT_QUOTES);
		return $post_fields;
	}

	$user = $_SESSION['user']['id'];
	$post_fields = processPostFields($_POST);

	$mail = new PHPMailer;
	$mail->setLanguage('ru');	
	$mail->isSMTP();                                  
	$mail->Host = 'smtp.yandex.ru';  
	$mail->SMTPAuth = true;                               
	$mail->Username = 'dev@swat.one';                
	$mail->Password = 'b2Ggj2sHvwv7vvf';                           
	$mail->SMTPSecure = 'ssl';                           
	$mail->Port = 465;
	$mail->setFrom('dev@swat.one', 'Компания SWAT');
	$mail->isHTML(true);                
	$mail->CharSet = 'utf-8';
	$mail->Subject = 'YouchCRM – обратная связь.';
	$mail->addAddress('ivan.rusia@mail.ru');
	$mail->Body = '
		<b>Пользователь:</b> '. $user .'<br>
		<b>Описание проблемы: </b>'. $post_fields['question'] .'<br>
		<b>Контакт: </b>'. $post_fields['contacts'] .'<br>
		<b>Пришел со страницы: </b>'. $post_fields['referer'];	

	if($mail->send())	
		$status['error'] = 200;
	else
		$status['error'] = 201;	

	echo json_encode($status);
?>