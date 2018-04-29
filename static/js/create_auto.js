function checkForm(form){
	var f = form.serialize();
	form.find('input, select').each(function(i, it){
		if(!/^[а-яА-Яa-zA-Z0-9\s\-]+$/.test($(it).val()))
			f = false;
	})
	return f;
}

$(document).ready(function(){

	var currMakeId = -1;

	$('#createAutoCarMakeSelect').select2({
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

	$('#createAutoForm').submit(function(e){
		e.preventDefault();
		var $form = $(this),
			$submit = $form.find('[type=submit]'),
			srz = checkForm($form);
		if(!srz) showAlert($form, 'Все поля обязательны для заполнения!');
		if($form.is("[loading]") || !srz) return;
		$form.attr('loading', '');
		$submit.addClass('disabled');
		$.post('/car/addModel/add', srz).fail(function(){
			showAlert($form, 'Произошла ошибка, перезагрузите страницу.');
		}).done(function(data){
			data = JSON.parse(data);
			switch(data.error){
				case 200:
					$form.trigger('reset');
					$('select').val(null).trigger('change');
					showAlert($form, 'Модель добавлена в базу данных.', 'success');	
					break;
				case 204:
					showAlert($form, 'Не удалось добавить модель в базу данных.');
					break;
				case 203:
					showAlert($form, 'Модель уже есть в базе данных.');
					break;
				case 202:
					showAlert($form, 'Неизвестная марка.');
					break;
				default:
					showAlert($form, 'Все понля обязательны для заполнения!');
					break;					
			}
		}).always(function(data){
			$form.removeAttr('loading');
			$submit.removeClass('disabled');
		});
	});

});