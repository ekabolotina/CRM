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
			ord.date_till AS `order_date_till`,
			ord.id AS `order_id`
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
					color: #333;
					font-size: 8px;
				}
				h1{
					font-size: 18px;
					font-weight: bold;
					text-align: center;
				}				
				h2{
					font-size: 10px;
					font-weight: bold;
					text-align: center;
				}
				p{
					text-align: justify;
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
					<td valign="top" style="padding: 0 25px; text-align: center;"><h1>ДОГОВОР ПРОКАТА ТРАНСПОРТНОГО СРЕДСТВА БЕЗ ЭКИПАЖА<br>№ 25 ПК - 12634864</h1></td>
					<td valign="top"><h1>г. ВЛАДИВОСТОК</h1><h1>'. $order_info['order_date_from'] .'</h1></td>
				</tr>
			</table>
			<p>Индивидуальный предприниматель, <i>Кувшинова Марина Петровна</i>, именуемый в дальнейшем <b>Арендодатель</b>, действующий на основании свидетельства о государственной регистрации физического лица в качестве индивидуального предпринимателя, с одной стороны, и '. $order_info['client_full_name'] .', именуемый(-ая) в дальнейшем <b>Арендатор</b>, паспорт: серия '. $order_info['client_passport_prefix'] .', номер '. $order_info['client_passport_number'] .' выдан '. $order_info['client_passport_date'] .' '. $order_info['client_passport_emitted'] .'; водительское удостоверение: серия '. $order_info['client_license_prefix'] .', № '. $order_info['client_license_number'] .', выдано '. $order_info['client_license_emitted'] .', '. $order_info['client_license_date'] .'. Адрес прописки: '. $order_info['client_address_residence'] .'. Адрес проживания: '. $order_info['client_address_real'] .'. Телефон мобильный: '. $order_info['client_phone_mobile'] .' с другой стороны заключили настоящий договор о нижеследующем:
			</p>
			<h2>1. Предмет договора.</h2>
			<p>1.1 В соответствиями с условиями договора Арендодатель обязуется предоставить Арендатору за плату во временное владение и пользование (прокат) транспортное средство (далее по тексту ТС) без оказания услуг по управлению им и его технической эксплуатации. Транспортное средство предоставляется для некоммерческого использования Арендатором.
			</p>
			<table border="0" width="100%">
				<tr>
					<td width="25%">Марка, модель:</td>
					<td width="25%">'. $order_info['car_made_model'] .'</td>
					<td width="25%">Год выпуска:</td>
					<td width="25%">'. $order_info['car_year'] .'</td>
				</tr>
				<tr>
					<td>Цвет:</td>
					<td>Черный</td>
					<td>Гос. рег. знак:</td>
					<td>'. $order_info['car_number'] .'</td>
				</tr>
				<tr>
					<td>Кузов (рама; VIN):</td>
					<td>STRL-125355874, Рама NKL-458786665</td>
					<td>Стоимость ТС:</td>
					<td>3500000 руб.</td>
				</tr>											
			</table>		
			<h2>2. Сроки действия договора.</h2>
			<p>2.1. Договор вступает в силу с момента подписания Акта передачи транспортного средства (Приложение №3) и действует до срока указанного в пункте 2.2 настоящего Договора.</p>
			<p>2.2. Срок окончания договора: '. $order_info['order_date_till'] .'</p>
			<p>2.3. Срок действия договора может быть продлен на любой срок дополнительным соглашением сторон, изложенным в письменной форме и подписанным Сторонами. Прием-передачи ТС в этом случае не оформляется. ТС продолжает находиться во владении Арендатора без разрыва во времени. Стороны договорились, что в случае невозврата ТС Арендатором, в срок установленный в п. 2.2 настоящего договора, Арендодателю, договор будет считаться оконченным, но плата за прокат ТС будет начислятся Арендатору до фактического возврата ТС, по Акту приема ТС, Арендодателю от Арендатора, из расчета установленной платы за прокат согласно действующему Прайс-листу (Приложение №2) к настоящему договору проката.</p>
			<h2>3. Порядок приема-передачи транспортного средства.</h2>
			<p>3.1. Передача ТС Арендатору и прием от него производится на площадке Арендодателя по адресу: <i>г. Владивосток, ул. Корабельная набережная, 1</i> в рабочее время (с 09.00 до 20.00 ежедневно). Передача и (или) прием ТС может осуществляться по желанию Арендатора и за отдельную плату в соответствии с Прайс-листом в ином месте и (или) в нерабочее время.</p>
			<p>3.2.При передачи ТС Арендатору и приеме от него Стороны составляются Акты приема-передачи, в которых указываются регистрационные данные ТС, его комплектация, техническое состояние, состояние кузова и салона автомобиля, уровень заправки топлива, перечень документов передаваемых Арендатору с ТС, показания одометра на момент передачи и возврата ТС, время и место передачи ТС. Акт передачи ТС (Приложение №3) является обязательным и единственным документом, подтверждающим передачу ТС Арендодателем Арендатору. Акт приема ТС (Приложение №4) является обязательным и единственным документом, подтверждающим возврат ТС Арендатором Арендодателю.</p>
			<p>3.3. ТС передается Арендатору и возвращается Арендодателю в чистом виде с полным топливным баком, либо согласно Акта передачи ТС. При неисполнении Арендатором указанной обязанности, он оплачивает мойку ТС, чистку салона согласно действующему Прайс-листу настоящего Договора. Недостающее количество топлива в баке Арендатор оплачивает из расчета 40 рублей за литр топлива, независимо от его марки.</p>	
			<h2>4. Платежи и расчеты по договору.</h2>		
			<p>4.1. Плата за прокат устанавливается в виде фиксированной суммы в рублях за 1 сутки проката в соответствии с действующим Прайс-листом. Плата за прокат вносится Арендатором за весь срок проката не позднее времени получения транспортного средства в пользование путем внесения наличных денежных средств в кассу или перечислением на расчетный счет Арендодателя.</p>
			<p>4.2. В случае продления Арендодателем срока проката ТС по соглашению Сторон порядок оплаты аналогичен указанному в п.4.1.</p>
			<p>4.3. В случае превышения срока проката, указанного в Договоре (возврат ТС с опозданием), Арендатор оплачивает половину суточного тарифа при превышении срока проката до трех часов включительно, или полностью тариф за сутки, если фактический срок пользования ТС превышает срок проката по Договору более чем на три часа.</p>
			<p>4.4. При досрочном расторжении договора проката по инициативе Арендатора, Арендодатель возвращает остаток стоимости проката за каждые полные сутки, оставшиеся до срока возврата ТС по Договору. При этом Арендодатель оставляет за собой право произвести перерасчет ставки платы за прокат ТС с учетом фактического времени пользования ТС, определяющего тариф ставки платы за прокат.</p>
			<p>4.5. В качестве обеспечения исполнения обязательств по настоящему Договору Арендатор вносит в кассу Арендодателя Залог в виде денежной суммы в размере, зависящей от марки и модели ТС, иных обстоятельств, указанных в Прайс-листе.</p>
			<h2>5. Права и обязанности сторон.</h2>
			<p><b>5.1. Арендодатель обязан:</b></p>
			<p>5.1.1. Предоставить транспортное средство Арендатору в состоянии, соответствующем условиям Договора и назначению транспортного средства, со всей относящейся к нему документацией и принадлежностями, включая полис ОСАГО.</p>	
			<p>5.1.2. В присутствии Арендатора  проверить исправность сдаваемого в прокат транспортного средства, ознакомить Арендатора с основными техническими правилами его эксплуатации.</p>	
			<p>5.1.3. В случае неисправности ТС, возникшей по вине Арендодателя, а равно в случае проведения планового технического обслуживания (ремонта), заменить транспортное средство на аналогичное или иное по соглашению Сторон или произвести перерасчет.</p>	
			<p>5.1.4. Производить все виды необходимого ремонта транспортного средства (исключая случаи поломки транспортного средства по вине Арендатора) и его своевременное профилактическое обслуживание своими силами и за свой счет.</p>	
			<p>5.1.5. Оказывать Арендатору, в период действия договора проката, консультационную и информационную помощь, по техническим вопросам, связанным с эксплуатацией автомобиля, а также по вопросам поведения в нештатной ситуации, возникшей при пользовании ТС.</p>
			<p><b>5.2. Арендатор обязан:</b></p>	
			<p>5.2.1. Использовать транспортное средство в строгом соответствии с его назначением и особенностями. При управлении ТС соблюдать правила дорожного движения и правила эксплуатации транспортного средства. Не управлять транспортным средством в состоянии алкогольного или наркотического опьянения. Не использовать транспортное средство для буксировки других транспортных средств, поездок с прицепом или по бездорожью, участия в соревнованиях, испытаниях, а также для обучения вождению.</p>	
			<p>5.2.2. Не курить в салоне транспорного средства, не перевозить в ТС предметы, относящиеся к легковоспламеняющимся и содержащие токсические вещества, а так же иные предметы, способные нанести повреждения и порчу салона, оставляющие стойкие запахи в салоне ТС. Не размещать рекламу, надписи, рисунки, наклейки внутри и снаружи транспортного средства.</p>	
			<p>5.2.3. Не переуступать свои права и обязанности по Договору третьим лицам, не сдавать транспортное средство в субаренду, а также не заключать с третьими лицами договоры перевозки, в ходе которых используется взятое в прокат транспортное средство. Не передоверять управление ТС третьим лицам.</p>	
			<p>5.2.4. Эксплуатировать ТС только на дорогах общего пользования, имеющие твердое дорожное покрытие (асфальт, бетон).</p>	
			<p>5.2.5. Пользоваться транспортным средством в пределах границ Приморского края. Выезд за пределы Приморского края разрешается только с письменного согласия Арендодателя.</p>	
			<p>5.2.6. При эксплуатации транспортного средства использовать вид и марку топлива, которые указаны в Приложении №3 настоящего договора.</p>	
			<p>5.2.7. Бережно относиться к транспортному средству, проявляя необходимую осмотрительность и бережливость для поддержания надлежащего технического состояния и внешнего вида транспортного средства.</p>	
			<p>5.2.8. Не оставлять в ТС регистрационные документы и ключи от замка зажигания. В случае утраты регистрационных и других необходимых для эксплуатации транспортного средства документов, ключей замка зажигания независимо от вины Арендатора, последний обязан возместить все расходы Арендодателю по их восстановлению, включая упущенную выгоду от вынужденного простоя автомобиля.</p>	
			<p>5.2.9. Не оставлять ТС без присмотра. Независимо от времени суток хранить ТС исключительно на охраняемых стоянках (парковках).</p>	
			<p>5.2.10. Нести расходы, возникающие в связи с эксплуатацией транспортного средства - приобретение топлива, оплата работ по шиномонтажу, мойке автомобиля, приобретение жидкости для омывания стекол, плата за парковку ТС, буксировку неисправного транспортного средства до СТО Арендодателя, уплата штрафов за нарушение ПДД, в том числе и штрафы за тонировку передних стекол автомобиля, если ее наличие было согласованно Сторонами при передачи ТС.</p>	
			<p>5.2.11. Предоставлять Арендодателю транспортное средство, для проведения профилактического обслуживания, через 10 (десять) дней эксплуатации, либо пробега в 5000 километров с начала срока проката, в зависимости от того, что наступит ранее.</p>	
			<p>5.2.12. Проводить ежедневную проверку транспортного средства в соответствии с правилами его эксплуатации и незамедлительно сообщать Арендодателю о всех обнаруженных неисправностях.</p>	
			<p>5.2.13. При наступлении случая ДТП (дорожно-транспортного происшествия) Арендатор должен принять меры и исполнить обязанности, предусмотренные Правилами дорожного движения Российской Федерации, а также принять необходимые в сложившихся обстоятельствах меры с целью уменьшения возможных убытков от происшествия, записать фамилии и адреса очевидцев, принять меры по оформлению документов о происшествии.</p>	
			<p>5.2.14. При наступлении иных случаев повреждения, полной утраты или уничтожения взятого в прокат ТС в обязательном порядке официально обратится в соответствующие организации и получить документы, подтвердающие данное событие (Полиция, Пожарный надзор и т.п.).</p>	
			<p>5.2.15. Возместить в полном объеме ущерб, причиненный при эксплуатации взятого в прокат транспортного средства Арендатором, третьим лицам в случае возникновения обязанности владельца ТС возместить вред в части, превышающей размер ответственности, предусмотренный Федеральным законом "Об обязательном страховании гражданской ответственности владельцев транспортных средств". В случае обращения потерпевших в суд, Арендатор несет также возможные судебные расходы.</p>	
			<p>5.2.16. Не производить самостоятельно или с привлечением третьих лиц ремонт взятого в прокат транспортного средства. Немедленно обратиться в службу технической поддержки Арендодателя при возникновении любого вида неисправности транспортного средства. При невозможности продолжить движение, принять меры к буксировке ТС на СТО Арендодателя. При возникновении случаев технической неисправности ТС, за пределами города Владивостока, Арендатор обязан обратится в ближайший сертифицированный автосервис по указанию Арендодателя. Арендодатель компенсирует расходы за ремонт, при наличии Заказ-наряда и кассового чека, оформленных в установленном порядке. Компенсационная выплата за ремонт производится, только в том случае если поломка произошла не по вине Арендатора. Замена деталей, частей и агрегатов транспортного средства производится только с разрешения Арендодателя. При этом Арендатор обязан представить вышедшие из строя детали Арендодателю при возврате ТС.</p>	
			<p>5.2.17. Арендатор не вправе производить замену узлов, агрегатов или деталей взятого в прокат транспортного средства, кроме ситуации, изложенной в п. 5.2.16, вносить изменения в интерьер и экстерьер транспортного средства.</p>	
			<p>5.2.18. По окончанию срока проката возвратить ТС в том же состоянии и комплектации, в которых оно было принято у Арендодателя в соответствии с Актом передачи ТС настоящего договора. В случае невозврата ТС по окончании срока данного Договора проката, Арендатор утрачивает право на владение транспортным средством и его действия квалифицируются в соответствии со ст. 166 Уголовного кодекса РФ как неправомерное завладение автомобилем или иным транспорным средством без цели хищения.</p>	
			<p>5.2.19. В случае совершения Арендатором дорожно-транспортного происшествия или причинения ущерба транспортному средству в период проката, Арендатор обязан возместить Арендодателю расходы, связанные с устранением повреждений кузова, салона, агрегатов, механизмов, а также возместить Арендодателю убытки в виде упущенной выгоды, возникшие в связи с вынужденным простоем транспортного средства во время ремонта, из расчета суточной стоимости проката за каждый день вынужденного простоя. В случае утраты или полного уничтожения транспортного средства Арендатор возмещает Арендодателю полную стоимость транспортного средства. Арендная плата и Залог в этом случае возврату не подлежат.</p>	
			<h2>6. Ответственность сторон.</h2>
			<p>6.1. Арендодатель несет ответственность за исправное техническое состояние и комплектацию транспортного средства на момент передачи его Арендатору, соответствие документов, прилагаемых к ТС действующему законодательству.</p>	
			<p>6.2. Арендатор несет ответственность за сохранность ТС, прилагаемого к нему имущества и документов в течении всего срока Проката. В случае возврата транспортного средства по истечении срока проката или досрочно в состоянии, отличном от того, в каком оно находилось в момент передачи в пользование Арендатору или невозврата, вследствие утраты или гибели Арендатор возмещает Арендодателю ущерб:</p>				
			<p>6.2.1. В полном объеме, но не более 100 000 (сто тысяч рублей), если Арендатор добросовестно исполнял все свои обязанности по данному Договору и предоставил все необходимые документы, подтверждающие событие, в результате которого повреждено, уничтожено или утрачено транспорное средство.</p>	
			<p>6.2.2. В полном объеме в размере понесенного Арендодателем ущерба, если Арендатором нарушены требования, изложенные хотя бы в одном из пунктов 5.2.1 - 5.2.6, 5.2.8, 5.2.9, 5.2.11 - 5.2.14 настоящего Договора.</p>	
			<p>6.2.3. В полном объеме, если нанесен вред интерьеру салона, колесным дискам и шинам (за исключением естественного износа шин).</p>	
			<p>6.2.4. В двукратном размере стоимости самовольно (в нарушение пунктов 5.2.16 и 5.2.17) замененных узлов, деталей и агрегатов транспортного средства, а также стоимости работ по восстановлению транспортного средства в исходное состояние.</p>	
			<p>6.2.5. В полном объеме стоимости ремонта транспортного средства, если неисправность наступила вследствие неисполнения Арендатором требования по представлению ТС для очередного обслуживания, изложенные в пункте 5.2.11.</p>	
			<p>6.3. Кроме возмещения понесенного Арендатором ущерба (п.6.2), наступившего в результате повреждения или утраты транспортного средства, Арендатор возмещает упущенную выгоду в виде оплаты времени вынужденного простоя транспортного средства, необходимого для полного восстановления ТС в состояние, в котором оно находилось в момент передачи транспортного средства в пользование Арендатору. В случае утраты или полного уничтожения транспортного средства, временем простоя считается время со дня окончания срока проката по настоящему Договору до дня возмещения Арендатором полной (или частичной - п. 6.2.1) стоимости транспортного средства.</p>	
			<p>6.4. В случае неявки Арендатора в установленное по соглашению сторон время и отсутствия о нем какой либо информации (ложная информация является отсутствием  информации), начинается розыск ТС за счет Арендатора. Стоимость розыска ТС: по Владивостоку – 25000 рублей, по ПК – 50000 рублей, по РФ – 150000 рублей.</p>	
			<h2>7. Порядок изменения и расторжения договора.</h2>
			<p>7.1. Арендодатель вправе в одностороннем порядке расторгнуть Договор и требовать немедленного возврата транспортного средства в случае:</p>	
			<p>7.1.1. Нарушения Арендатором условий договора, которые очевидно приводят к необходимости проведения ремонта или иных действий для восстановления исходного состояния ТС и стоимость необходимых работ превышает величину Залога, указанного в п. 4.5.</p>
			<p>7.1.2. Если Арендатор не предоставляет транспортное средство для проведения планового технического обслуживания в срок, установленный настоящим договором (п. 5.2.11).</p>
			<p>7.1.3. Если, несмотря на предупреждения Арендодателя, Арендатор продолжает нарушать условия настояшего договора и создает угрозу повреждения или утраты транспортного средства.</p>
			<p>7.2. Арендатор вправе расторгнуть договор в любое время, уведомив в письменной форме Арендодателя не менее чем за сутки.</p>
			<p>7.3. Арендатор вправе немедленно возвратить транспортное средство и в одностороннем порядке расторгнуть договор в случаях если:</p>
			<p>7.3.1. Переданное Арендатору транспортное средство имеет препятствующие пользованию им недостатки, которые не были оговорены Арендодателем при заключении договора, не были заранее известны Арендатору, и их не возможно было обнаружить во время осмотра транспортного средства при заключении Договора;</p>
			<p>7.3.2. Если транспортное средство в силу независящих от Арендатора обстоятельств, окажется в состоянии, не пригодном для дальнейшего использования.</p>
			<h2>8. Форс-мажор.</h2>
			<p>8.1. Стороны освобождаются от ответственности за частичное или полное неисполнение обязательств по настоящему договору, если оно явилось следствием непреодолимой силы, включая: пожар, наводнение, землетрясение, диверсию, военные действия и другие обстоятельства, если они непосредственно повлияли на исполнение договорных обстоятельств.</p>
			<p>8.2. При наступлении обстоятельств, указанных в п. 8.1, каждая сторона должна без промедления известить о них в письменном виде другую сторону. Извещение должно содержать данные о характере обстоятельств, а так же официальные документы, удостоверяющие наличие этих обстоятельств.</p>
			<p>8.3. При наступлении обстоятельств, указанных в п. 8.1, срок выполнения обязательств по настоящему договору отодвигается соразмерено времени, в течение которого действуют эти обстоятельства и их последствия.</p>
			<p>8.4. Если обстоятельства указанные в п. 8.1., и их последствия продолжают действовать более одного месяца, стороны проводят дополнительные переговоры для выявления приемлемых альтернативных способов исполнения настоящего договора.</p>
			<h2>9. Дополнительные условия.</h2>
			<p>9.1. Настоящий договор может быть изменен или дополнен по письменному соглашению Сторон.</p>	
			<p>9.2. В части неурегулированной настоящим Договором, Стороны руководствуются действующим законодательством Российской Федерации.</p>
			<p>9.3. Договор составлен в двух экземплярах по одному для каждой стороны и имеет одинаковую юридическую силу.</p>
			<p>9.4. Условия настоящего договора являются конфиденциальными и не подлежат разглашению третьим лицам без письменного согласия другой Стороны.</p>
			<p>9.5. В случае возникновения споров Стороны будут стремиться к разрешению их путем переговоров. При невожможности урегулирования спора путем переговоров, Стороны  обращаются в Суд в соответствии с действующим законодательством РФ.</p>
			<p>9.6. С момента получения транспортного средства в пользование, до сдачи его Арендодателю, Арендатор является пользователем взятого в прокат транспортного средства и в соответствии с действующим законодательством Российской Федерации несет гражданскую ответственность перед третьими лицами за вред, причиненный источником повышенной опасности.</p>
			<p>9.7. На основании ФЗ "о персональных данных" Арендатор даёт согласие Арендодателю на обработку его персональных данных, указанных в приложению №1 настоящего договора:</p>
			<p>9.8. Все приложения к настоящему договору имеют юридическую силу, если они составлены в письменной форме и подписаны обеими Сторонами.</p>
			<p>9.9. Персональные данные Арендатора (Приложение №1), Прайс-лист (Приложение №2), Акт передачи ТС (Приложение №3), Акт приема ТС (Приложение №4) являются неотъемлемой частью настоящего Договора.</p>
			<br><br><br><br><br>
			<h2>14. Адреса, реквизиты и подписи Сторон:</h2>
			<table border="0" width="100%" cellpadding="10">
				<tr><td align="center" width="50%"><b>«Арендодатель»</b></td><td align="center" width="50%"><b>«Арендатор»</b></td></tr>
				<tr><td align="center">ИП Кувшинова Марина Петровна</td><td align="center">'. $order_info['client_full_name'] .'</td></tr>
				<tr>
					<td>
						<table border="0" width="100%">
							<tr><td>Адрес:</td><td>г.Владивосток, ул.Тунгусская, 65</td></tr>
							<tr><td>ИНН:</td><td>253600601736</td></tr>
							<tr><td>ОГРН:</td><td>308253613600054</td></tr>
							<tr><td>Р/сч</td><td>40802810445840000002</td></tr>
							<tr><td colspan="2">Дальневосточный филиал ОАО "РОСБАНК"</td></tr>
							<tr><td>Корр. счет</td><td>30101810300000000871</td></tr>
							<tr><td>БИК</td><td>040507871</td></tr>
						</table>
					</td>
					<td>
						<table border="0" width="100%">
							<tr><td>Паспорт:</td><td>серия '. $order_info['client_passport_prefix'] .' № '. $order_info['client_passport_number'] .' от '. $order_info['client_passport_date'] .'</td></tr>
							<tr><td>Зарегистрирован:</td><td>'. $order_info['client_address_residence'] .'</td></tr>
							<tr><td>Проживает</td><td>'. $order_info['client_address_real'] .'</td></tr>
							<tr><td>Телефон</td><td>'. $order_info['client_phone_mobile'] .'</td></tr>
						</table>
					</td>					
				</tr>
				<tr>
					<td><table border="0" width="100%" cellpadding="5"><tr><td>Подпись: </td><td class="sign" width="80%"></td></tr></table></td>
					<td><table border="0" width="100%" cellpadding="5"><tr><td>Подпись: </td><td class="sign" width="80%"></td></tr></table></td>
				</tr>
			</table>
		</body>
		</html>	
	';
	$mpdf->SetHTMLFooter('
		<table border="0" width="100%" cellspacing="10">
			<tr><td align="center" width="50%"><b>Арендодатель:</b></td><td align="center" width="50%"><b>Арендатор:</b></td></tr>
			<tr><td class="sign"></td><td class="sign"><br><br><br></td></tr>
			<tr><td align="center">ИП Кувшинова Марина Петровна</td><td align="center">'. $order_info['client_full_name'] .'</td></tr>
		</table>');
	$mpdf->WriteHTML($html);
	$mpdf->SetHTMLFooter('');
	$mpdf->SetTitle('Договор проката транспортного средства');
	$mpdf->SetSubject('Договор проката транспортного средства');
	$mpdf->SetAuthor('SWAT.one');
	$mpdf->SetCreator('SWAT.one');
	$mpdf->SetProtection(array('copy', 'print'));	
	$mpdf->Output('rent_contract.pdf', 'I');

?>