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
	if(!confirm('Изображение будет удалено безвозвратно. Продолжить?')) return;
	$target.addClass('loading');
	$.post('/removeFile/', {id: id}).done(function(data){
		console.log(data);
		data = JSON.parse(data);
		if(data.error == 200){
			$target.remove();
			$('#editClientForm input[name=client_photos]').val($('#editClientForm input[name=client_photos]').val().slice(0, -1));
		}
	}).always(function(){
		$target.removeClass('loading');
	});
}

function uploadFileSuccess(data){
	var file = data.file,
		id = data.id;	
	for(i = 0; i < file.length; i++)
		$('#editClientFormAddPhotoGallery').append(
			'<div class="uploadedImg">'+
				'<a href="#" class="glyphicon glyphicon-remove" onclick="removeUploadedImg(event, '+ id[i] +');"></a>'+
				'<img src="/static/img/uploads/'+ file[i] +'">'+
			'</div>'
		);
	$('#editClientForm input[name=client_photos]').val($('#editClientForm input[name=client_photos]').val() + 'i'.repeat(i));
}

function uploadFile(event){
	var files = event.target.files, 
		data = new FormData(),
		tmpId = $('#editClientFormUploader input[name=tmpId]').val();
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
			$('#editClientFormAddPhotoBtn').addClass('disabled');
		},
        success: function(data, textStatus, jqXHR){
            forms_load = false;
            $('#editClientFormAddPhotoBtn').removeClass('disabled');
            console.log(data);
			data = JSON.parse(data);
           	switch(data.code){
				case 200: 
					uploadFileSuccess(data);
					break;
				case 201:
					showAlert($('#editClientForm'), 'Что-то пошло не так, перезагрузите страницу.');
					break;
				case 202:
					showAlert($('#editClientForm'), 'Не удается загрузить файл.');
					console.log(data.q);
					break;	
				case 203:
					showAlert($('#editClientForm'), 'Выберите только один файл.');
					break;
				case 204:
					showAlert($('#editClientForm'), 'Выберите файл с изображением формата JPEG размером до 3.5 Мб.');
					break;														   
			} 
        },
        error: function(jqXHR, textStatus, errorThrown){
        	$('#editClientFormAddPhotoBtn').removeClass('disabled');
            showAlert($('#editClientForm'), 'Что-то пошло не так, перезагрузите страницу.');
        }
	});			
}

$(document).ready(function(){

	$('#editAdvertMainFormAddImg').click(function(){
		$('#editAdvertAddImgForm input[type=file]').click();
	});	

	$('#editClientForm').submit(function(e){
		e.preventDefault();
		var $form = $(this),
			$submit = $form.find('[type=submit]'),
			srz = checkForm($form);
		if(!srz) showAlert($form, 'Выделенные поля необходимо заполнить!');
		if($form.is("[loading]") || !srz) return;
		$form.attr('loading', '');
		$submit.addClass('disabled');
		$.post('/clients/edit/updateClient', srz).fail(function(){
			showAlert($form, 'Произошла ошибка, перезагрузите страницу.');
		}).done(function(data){
			data = JSON.parse(data);
			if(data.error == 200)
				showAlert($form, 'Изменения сохранены.', 'success');
			else
				showAlert($form, 'Внутренняя ошибка. Обратитесь в службу поддержки. Код: '+ data.error +'.');
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

});