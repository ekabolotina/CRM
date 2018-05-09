<?php

use \Mpdf\Mpdf;

if(!$_SESSION['user']){
    Header('Location: /login');
    die;
}

$order_id = htmlspecialchars($_GET['id'], ENT_QUOTES);
$order_type = htmlspecialchars($_GET['type'], ENT_QUOTES);
$order_type = $order_type == 1 ? 1 : 0;

$user_id = $_SESSION['user']['id'];
$user_role = $_SESSION['user']['role'];

if(
    $order_id &&
    ($query = $link->query("
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
			ord.date_till AS `order_date_till`,
			ord.id AS `order_id`,
			c.car_body AS `car_body`,
			c.car_color AS `car_color`,
			ord.place AS `order_place`,
			ord.price AS `order_price`,
			cl.id AS `client_id`,
            ord.assessed_price AS `assessed_price`,
            ord.rent_period AS `rent_period`,
            ord.fact_return_date AS `fact_return_date`,
            ord.fact_return_place AS `fact_return_place`,
            ord.people_allowed AS `people_allowed`,
            ord.insurance_deposit AS `insurance_deposit`,
            ord.full_price AS `full_price`,
            ord.full_price_off AS `full_price_off`
		FROM 
			`orders` AS ord
		INNER JOIN `cars` AS c ON ord.car = c.id
		INNER JOIN `car_makes` AS c_makes ON c.car_make = c_makes.id
		INNER JOIN `car_models` AS c_models ON c.car_model = c_models.id
		INNER JOIN `clients` AS cl ON ord.client = cl.id
		LEFT JOIN `users` as u ON ord.owner = u.id
		WHERE 
			ord.id = $order_id AND
			(
			  ord.owner = $user_id OR
			  $user_role = ". constant('ROLE_ADMIN') ." OR
			  $user_role = ". constant('ROLE_COMPANY') ." AND u.head = $user_id
			)
	")) &&
    $query->num_rows
) {
    $order_info = $query->fetch_array(MYSQLI_ASSOC);
} else {
    Header('Location: /order/all');
    die;
}

function getDateFormatted($style = 'long') {
    $c_d = time();
    $c_d_d = date('d', $c_d);
    $c_d_m = date('n', $c_d);
    $c_d_y = date('Y', $c_d);
    $months_ru = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];

    return ($style == 'short') ? date('d.m.Y', $c_d) : '«'. $c_d_d .'» '. $months_ru[$c_d_m-1] .' '. $c_d_y .' г.';
}

try {
    $html = $twig->render( 'order/contract/contract.html.twig', [
        'order' => $order_info,
        'date_formatted' => getDateFormatted(),
        'order_type' => $order_type
    ]);
    $footer = $twig->render('order/contract/footer.html.twig');
} catch (Exception $exception) {
    echo $exception->getMessage();
    die;
}

$mpdf = new mPDF([
    'mode' => 'BLANK',
    'format' => 'A4',
    'default_font_size' => '10pt',
    'default_font' => 'Times',
    'margin_left' => '15',
    'margin_right' => '15',
    'margin_top' => '20',
    'margin_bottom' => '20']
);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($html);
$mpdf->SetTitle('Договор проката транспортного средства');
$mpdf->SetSubject('Договор проката транспортного средства');
$mpdf->SetAuthor('SWAT.one');
$mpdf->SetCreator('SWAT.one');
$mpdf->SetProtection(['copy', 'print']);
$mpdf->Output('rent_contract.pdf', 'I');
