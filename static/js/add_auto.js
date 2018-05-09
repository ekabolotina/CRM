function checkForm(form){
	var f = form.serialize();
	form.find('input, select, textarea').each(function(i, it){
		if(!/^[а-яА-Яa-zA-Z0-9\s\-]+$/.test($(it).val()))
			f = false;
	})
	return f;
}

$(document).ready(function(){

	var currMakeId = -1;

	$('#addAutoCarMakeSelect').select2({
		ajax: {
			url: "/auto/add/getCarMakes",
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
		placeholder: 'Выберите марку'
	});

	$('#addAutoCarMakeSelect').on('select2:select', function(e){
		currMakeId = e.params.data.id;
		$('#addAutoCarModelSelect').prop('disabled', false).val(null).trigger('change');
	});	

	$('#addAutoCarModelSelect').select2({
		disabled: true,
		ajax: {
			url: "/auto/add/getCarModels",
			dataType: 'json',
			type: 'POST',
			delay: 0,
			data: function(params){
				return {
					term: params.term,
					car_make: currMakeId
				};
			},			
			processResults: function(data, params){
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
		placeholder: 'Выберите модель'
	});	

	$('#addAutoForm').submit(function(e){
		e.preventDefault();
		var $form = $(this),
			$submit = $form.find('[type=submit]'),
			srz = checkForm($form);
		if(!srz) showAlert($form, 'Все поля обязательны для заполнения!');
		if($form.is("[loading]") || !srz) return;
		$form.attr('loading', '');
		$submit.addClass('disabled');
		$.post('/auto/add/addCar', srz).fail(function(){
			showAlert($form, 'Произошла ошибка, перезагрузите страницу.');
		}).done(function(data){
			data = JSON.parse(data);
			if(data.error == 200){
				$form.trigger('reset');
				$('select').val(null).trigger('change');
				showAlert($form, 'Автомобиль был добавлен в базу данных.', 'success');
			}else
				showAlert($form, 'Все поля обязательны для заполнения!');
		}).always(function(data){
			$form.removeAttr('loading');
			$submit.removeClass('disabled');	
			console.log(data);		
		});
	});

	$.mask.definitions['а']='[а-яА-Я]';
	$('[name=car_number]').mask('а999аа99?9');
	$('[name=car_year]').mask('9999');
	$('[data-toggle="tooltip"]').tooltip()

});