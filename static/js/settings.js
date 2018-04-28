$(document).ready(function(){

	$('form#settingsForm').submit(function(e){
		e.preventDefault();
		var $form = $(this),
			$name = $form.find('input[name=name]'),
			$pass_1 = $form.find('input[name=pass_1]'),
			$pass_2 = $form.find('input[name=pass_2]'),
			$rent_place = $form.find('input[name=rent_place]'),
			$btn = $form.find('input[type=submit]'),
			mustReturn = false;

		$form.find('.form-group').removeClass('has-error');
		if($name.val() == '' || $name.val().length < 3){
			$name.closest('.form-group').addClass('has-error');
			mustReturn = true;
		}
		if($rent_place.val() == '' || $rent_place.val().length < 3){
			$rent_place.closest('.form-group').addClass('has-error');
			mustReturn = true;
		}
		if($pass_1.val() != '' && $pass_1.val() != $pass_2.val()){
			$pass_1.closest('.form-group').addClass('has-error');
			mustReturn = true;
		}
		if(mustReturn || $form.is('[loading]')) return;

		$btn.addClass('disabled');
		$form.attr('loading', '');
		$('.alert').remove();

		$.post('/settings/save/', {
			name: $name.val(), 
			pass: $pass_1.val(), 
			rent_place: $rent_place.val()
		}).done(function(data){
			console.log(data);
			data = JSON.parse(data);
			if(data.error == 200){
				$pass_1.val('');
				$pass_2.val('');
				showAlert($form, 'Изменения сохранены.', 'success');
			}else
				showAlert($form, 'Ошибка. Изменения не были сохранены.'+ data.error);				
		}).always(function(){
			$btn.removeClass('disabled');
			$form.removeAttr('loading');			
		}).fail(function(){
			showAlert($form, 'Ошибка. Изменения не были сохранены.'+ data.error);
		});

	});

});