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

function removeUploadedImg(event, id){
	event.preventDefault();
	var $target = $(event.target).closest('.uploadedImg');
	$target.addClass('loading');
	$.post('/removeFile/', {id: id}).done(function(data){
		console.log(data);
		data = JSON.parse(data);
		if(data.error == 200){
			$target.remove();
			$('#addClientForm input[name=client_photos]').val($('#addClientForm input[name=client_photos]').val().slice(0, -1));
		}
	}).always(function(){
		$target.removeClass('loading');
	});
}

function uploadFileSuccess(data){
	var file = data.file,
		id = data.id;	
	for(i = 0; i < file.length; i++)
		$('#addClientFormAddPhotoGallery').append(
			'<div class="uploadedImg">'+
				'<a href="#" class="glyphicon glyphicon-remove" onclick="removeUploadedImg(event, '+ id[i] +');"></a>'+
				'<img src="/static/img/uploads/'+ file[i] +'">'+
			'</div>'
		);
	$('#addClientForm input[name=client_photos]').val($('#addClientForm input[name=client_photos]').val() + 'i'.repeat(i));
}

function uploadFile(event){
	var files = event.target.files, 
		data = new FormData(),
		tmpId = $('#addClientFormUploader input[name=tmpId]').val();
	$.each(files, function(key, value){
	    data.append(key, value);
	});		
	$.ajax({
        url: '/uploadFile/?tmpId='+ tmpId,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'text',
        processData: false, 
        contentType: false,
        beforeSend: function(){
			$('#addClientFormAddPhotoBtn').addClass('disabled');
		},
        success: function(data, textStatus, jqXHR){
            forms_load = false;
            $('#addClientFormAddPhotoBtn').removeClass('disabled');
            console.log(data);
			data = JSON.parse(data);
           	switch(data.code){
				case 200: 
					uploadFileSuccess(data);
					break;
				case 201:
					showAlert($('#addClientForm'), 'Что-то пошло не так, перезагрузите страницу.');
					break;
				case 202:
					showAlert($('#addClientForm'), 'Не удается загрузить файл.');
					console.log(data.q);
					break;	
				case 203:
					showAlert($('#addClientForm'), 'Выберите только один файл.');
					break;
				case 204:
					showAlert($('#addClientForm'), 'Выберите файл с изображением формата JPEG размером до 3.5 Мб.');
					break;														   
			} 
        },
        error: function(jqXHR, textStatus, errorThrown){
        	$('#addClientFormAddPhotoBtn').removeClass('disabled');
            showAlert($('#addClientForm'), 'Что-то пошло не так, перезагрузите страницу.');
        }
	});			
}

$(document).ready(function(){

	$('#addAdvertMainFormAddImg').click(function(){
		$('#addAdvertAddImgForm input[type=file]').click();
	});	

	$('#addClientForm').submit(function(e){
		e.preventDefault();
		var $form = $(this),
			$submit = $form.find('[type=submit]'),
			srz = checkForm($form);
		if(!srz) showAlert($form, 'Выделенные поля необходимо заполнить!');
		if($form.is("[loading]") || !srz) return;
		$form.attr('loading', '');
		$submit.addClass('disabled');
		$.post('/clients/add/addClient', srz).fail(function(){
			showAlert($form, 'Произошла ошибка, перезагрузите страницу.');
		}).done(function(data){
			data = JSON.parse(data);
			if(data.error == 200){
				$form.trigger('reset');
				$('select').val(null).trigger('change');
				showAlert($form, 'Клиент был добавлен в базу данных. <a href="/order/new/?q='+ data.client_passport +'" class="btn btn-primary">Оформить</a>', 'success');
			}else
				showAlert($form, 'Выделенные поля необходимо заполнить!');
		}).always(function(data){
			$form.removeAttr('loading');
			$submit.removeClass('disabled');	
			console.log(JSON.parse(data));		
		});
	});

	$('input[name=client_passport_date], input[name=client_birthday], input[name=client_license_date]').datepicker({
	    todayBtn: 'linked',	
	    language: 'ru',
	    todayHighlight: true,    		
	});	

	$('[name=client_passport_prefix]').mask('9999');
	$('[name=client_passport_number]').mask('999999');
	// $('[name=client_license_prefix]').mask('9999');
	$('[name=client_license_number]').mask('999999');

});