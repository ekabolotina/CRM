function checkForm(form){
	var f = form.serialize();
	form.find('.form-group').removeClass('has-error');
	form.find('input:not([type=submit]), select, textarea').each(function(i, it){
		if($(it).is('[require]') && $(it).val() == ''){
			f = false;
			$(it).closest('.form-group').addClass('has-error');
		}
	})
	return f;
}

$(document).ready(function(){

	$('[name=price], [name=assessed_price], [name=insurance_deposit], [name=full_price], [name=full_price_off]').mask('999?999');

	$('#orderCarSelect').select2({
		ajax: {
			url: "/auto/all/getAutoList",
			dataType: 'json',
			type: 'POST',
			delay: 0,
			data: function(params){
				return {
					term: params.term
				};
			},			
			processResults: function(data){
				return { 
					results: $.map(data.data, function(it){
						return {
							id: it.id, 
							text: it.name
						}
					})
				}
			},	
			cache: true
		},
		minimumInputLength: 1,
		width: '100%',
		placeholder: 'Выберите автомобиль'
	});

	$('input[name=date_from], input[name=date_till], input[name=client_birthday], input[name=client_passport_date], input[name=fact_return_date]').datetimepicker({
	    format: "dd.mm.yyyy. Время: hh:ii",
	    autoclose: true,
        todayBtn: true,
        minuteStep: 10,
        language: 'ru'		
	});	

	$('form#orderSearchClient').submit(function(e){
		e.preventDefault();

		var $form = $(this),
			$submit = $form.find('input[type=submit]'),
			$clientPattern = $form.find('input[name=clientPattern]'),
			$clientPatternVal = $clientPattern.val();

		$form.find('.form-group').removeClass('has-error');

		if($clientPatternVal == '' || /^\s+$/.test($clientPatternVal)){
			$clientPattern.closest('.form-group').addClass('has-error');
			return;
		}

		if($form.is('[loading]')) return;
		$submit.addClass('disabled');
		$form.attr('loading', '');
		$clientPattern.addClass('disabled');

		history.replaceState({}, '', '/order/new/?q='+ $clientPatternVal);

		$.post('/clients/all/getCientsList', {term: $clientPatternVal}).fail(function(){
			document.location.reload();
		}).done(function(data){
			data = JSON.parse(data);
			console.log(data);
			var $orderSearchClientList = $('#orderSearchClientList').empty();
			if(data.error == 200){
				current_clients = data.data;
				for(var i = 0; i < data.data.length; i++){
					var it = data.data[i];
					$orderSearchClientList.append(
						"<div class='well well-lg' style='overflow:hidden;'>"+
							"<div class='col-md-5'>"+
								"<b>"+ (i+1) +". "+ [it.last_name, it.first_name, it.middle_name].join(' ') +"</b><br>"+
								"<small>Дата рождения: "+ it.birthday +", Паспорт: "+ it.passport_prefix + it.passport_number +", ВУ: "+ it.license_prefix + it.license_number +"</small>"+
							"</div>"+
							"<div class='col-md-3'>"+
								((it.blacked == '1') ? "<span style='color: red; font-weight: bold'>Клиент находится в черном списке!</span>" : "<b>Рейтинг:</b> "+ it.rate) +
							"</div>"+
							"<div class='col-md-4'>"+
								"<button type='button' class='btn btn-primary' onclick='getUserInfoMore("+ it.id +");'>Подробнее</button>"+	
								((it.can_eidt == '1') ? ("<a href='/clients/edit/?id="+ it.id +"' class='btn btn-primary' style='margin-left:15px;' target='_blank'>Изменить</a>") : "") +								
								"<button type='button' class='btn btn-success' onclick='makeOrder("+ JSON.stringify(it) +");' style='margin-left:15px;'>Оформить</button>"+
							"</div>"+
						"</div>"
					);
				}
			}else
				$orderSearchClientList.append('<div style="margin: 20px 0 30px 0;">Поиск не дал результатов. <a href="/clients/add" class="btn btn-success">Создать нового клиента</a></div>');
		}).always(function(){
			$form.removeAttr('loading');
			$submit.removeClass('disabled');
		});

	});

	$('#orderExecuteForm form').submit(function(e){
		e.preventDefault();

		var $form = $(this),
			$submit = $form.find('input[type=submit]'),
			srz = checkForm($form);

		if(!srz) showAlert($form, 'Выделенные поля необходимо заполнить!');
		if($form.is('[loading]') || !srz) return;

		$form.attr('loading', '');
		$submit.addClass('disabled');

		$.post('/order/process', srz).fail(function(){
			document.location.reload();
		}).done(function(data){
			console.log(data);
			data = JSON.parse(data);
			console.log(data);
			if(data.error == 200){
				$form.remove();
				$('#orderExecuteForm').html('<div class="alert alert-success fade in">Заказ создан.<br><br><a href="/order/genRentContract?id='+ data.id +'&type=0" class="btn btn-success" target="blank" role="button">Открыть договор (седан)</a><a href="/order/genRentContract?id='+ data.id +'&type=1" class="btn btn-success" target="blank" role="button">Открыть договор (джип)</a><a href="/order/all" class="btn btn-info" role="button">Все заказы</a><a href="/order/new" class="btn btn-info" role="button">Создать новый заказ</a></div>');
			}else{
				showAlert($form, 'Проверьте правильность заполнения поля &laquo;Автомобиль&raquo;!');
			}
		}).always(function(){
			$form.removeAttr('loading');
			$submit.removeClass('disabled');			
		});

	});

	if($('form#orderSearchClient input[name=clientPattern]').val() != '') $('form#orderSearchClient').submit();

});

function makeOrder(client){
	$('#orderSearchClientList, #orderSearchClient').hide();
	var $form = $('#orderExecuteForm').show().find('form');
	$form.find('input[name=client_name]').val([client.last_name, client.first_name, client.middle_name].join(' '));
	$form.find('input[name=client]').val(client.id);
}