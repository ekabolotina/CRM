<?php

	session_start();

	if(!$_SESSION['user']) die;

	require_once 'connect.php';

	$order_id = htmlspecialchars($_GET['id'], ENT_QUOTES);

	if($order_id && ($query = $link->query("
		SELECT 
			c.year AS `car_year`,
			CONCAT(c_makes.name, ' ', c_models.name) AS `car_made_model`,
			c.car_number AS `car_number`,
			CONCAT(cl.last_name, ' ', cl.first_name, ' ', cl.middle_name) AS `client_full_name`,
			cl.passport_prefix AS `client_passport_prefix`,
			cl.passport_number AS `client_passport_number`,
			cl.passport_emitted AS `client_passport_emitted`,
			cl.passport_date AS `client_passport_date`,
			cl.license_prefix AS `client_license_prefix`,
			cl.license_number AS `client_license_number`,
			cl.license_emitted AS `client_license_emitted`,
			cl.license_date AS `client_license_date`,
			cl.address_residence AS `client_address_residence`,
			cl.address_real AS `client_address_real`,
			cl.phone_home AS `client_phone_home`,
			cl.phone_work AS `client_phone_work`,
			cl.phone_mobile AS `client_phone_mobile`,
			ord.date_from AS `order_date_from`,
			ord.date_till AS `order_date_till`
		FROM 
			`orders` AS ord
		INNER JOIN `cars` AS c ON ord.car = c.id
		INNER JOIN `car_makes` AS c_makes ON c.car_make = c_makes.id
		INNER JOIN `car_models` AS c_models ON c.car_model = c_models.id
		INNER JOIN `clients` AS cl ON ord.client = cl.id
		WHERE 
			ord.id = $order_id 
	")) && $query->num_rows)
		$order_info = $query->fetch_array(MYSQLI_ASSOC);
	else{
		echo $link->error;
		die;
	}

	require_once 'lib/mpdf/mpdf.php';

	$mpdf = new mPDF('BLANK', 'A4', '10pt', 'Times', '15', '15', '20', '20');	

	$html = '
		<!DOCTYPE>
		<html>
		<header>
			<style>
				html, body{
					font-family: Times New Roman;
					color: #000;
					font-size: 6px;
				}
				.sign{
					border: 1px solid #000;
				}
			</style>
		</header>
		<body>
			<table border="0" width="100%">
				<tr>
					<td><img src="../img/contract_logo.jpg"></td>
					<td valign="top" style="padding: 0 25px; text-align: center;"><h1>КВИТАНЦИЯ ОБ ОПЛАТЕ ТРАНСПОРТНОГО СРЕДСТВА</h1></td>
				</tr>
			</table>
			<br><br>
			<table border="0" width="100%">
				<tr>
					<td>Марка, модель</td>
					<td></td>
					<td>Год выпуска</td>
					<td></td>
				</tr>
				<tr>
					<td>Цвет</td>
					<td></td>
					<td>Гос. рег. знак</td>
					<td></td>
				</tr>
				<tr>
					<td>Кузов (рама, VIN)</td>
					<td></td>
					<td>Стоимость ТС</td>
					<td></td>
				</tr>								
			</table>	
			<br>
			Договор проката транспортного средства без экипажа № 25ПК - 126547 от (число, месяц, год) 29 марта 2017 года<br>
			Арендатор: Петров Петр Семонович<br>
			Паспорт Арендатора (серия, номер): 0515 295598 выдан (день, месяц, год выдачи паспорта): 28.09.2009<br>
			Наименование орг. (кем выдан): МРО УФМС РФ по Приморскому краю в г. Владивостоке, 250-024<br>
			Водительское удостоверение (серия, номер, кем выдано): 2517 324587 МРО УСММ 24.12.2004<br>
			Адрес прописки: г. Владивосток, ул. Серая, 123, кв. 43<br>
			Адрес проживания: г. Владивосток, ул. Серая, 123, кв. 43<br>
			Телефон: домашний: +74236133801, служебный: +7423143469, мобильный: +799904005587 / +74453249612<br>
			Срок окончания договора (день, месяц, год): 01 апреля 2017 года; Время (часов, минут): 18:00<br>
			Количество суток проката Т/С: 2. Стоимость проката Т/С за сутки (рублей): 4500 рублей. Залог за Т/С (рублей): 5000 рублей<br>
			<div style="text-align:right;">Итого оплачено (рублей): <b>9500 рублей</b></div>
			<br><br><br>М.П.<br><br><br>

			<table border="0" width="100%" cellspacing="10">
				<tr><td align="center" width="50%"><b>Арендодатель:</b></td><td align="center" width="50%"><b>Арендатор:</b></td></tr>
				<tr><td class="sign"></td><td class="sign"><br><br><br></td></tr>
				<tr><td align="center">ИП Кувшинова Марина Петровна</td><td align="center">'. $order_info['client_full_name'] .'</td></tr>
			</table>
	';

	$mpdf->WriteHTML($html);
	$mpdf->SetHTMLFooter('');
	$mpdf->SetTitle('Договор проката транспортного средства');
	$mpdf->SetSubject('Договор проката транспортного средства');
	$mpdf->SetAuthor('SWAT.one');
	$mpdf->SetCreator('SWAT.one');
	$mpdf->SetProtection(array('copy', 'print'));	
	$mpdf->Output('rent_contract.pdf', 'I');

?>