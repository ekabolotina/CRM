function getUserInfoMore(id){
	var msg = showMessage('Подождите, идет загрузка ...', 'getUserInfoMoreDialog', true);
	$.post('/clients/getClient', {id: id}).fail(function(){
		$(msg).find('.modal-body').html('Произошла ошибка. Попробуйте перезагрузить страницу.');
	}).done(function(data){
		data = JSON.parse(data);
		var imgs = '';
		if(data.data.imgs) for(var i = 0; i < data.data.imgs.length; i++)
			imgs += '<div class="clientPhoto"><img src="/static/img/uploads/'+ data.data.imgs[i].url +'"></div>'
		if(data.error == 200){
			var msgHTML = 
				'<b>ФИО: </b>'+ data.data.name + '<br>'+
				'<b>Дата рождения: </b>'+ data.data.birthday + '<br>'+
				'<b>Паспорт: </b>'+ data.data.passport + '<br>'+
				'<b>ВУ: </b>'+ data.data.license + '<br><hr>'+
				'<b>Адрес прописки: </b>'+ data.data.address_residence + '<br>'+
				'<b>Адрес проживания: </b>'+ data.data.address_real + '<br><hr>'+
				'<b>Телефон домашний: </b>'+ data.data.phone_home + '<br>'+
				'<b>Телефон рабочий: </b>'+ data.data.phone_work + '<br>'+
				'<b>Телефон мобильный: </b>'+ data.data.phone_mobile + '<br><hr>'+
				'<b>Рейтинг: </b>'+ ((data.data.blacked == 1) ? 'ЧС ('+ data.data.rate +')' : data.data.rate) +
				((imgs) ? '<hr><div style="overflow:hidden;">'+ imgs +'</div>' : '') +
				'<hr><button type="button" class="btn btn-primary" onclick="showFeedbackUser('+ data.data.id +');">Перейти к отзывам</button><button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Закрыть</button></div>'
			;
			$(msg).find('.modal-body').html(msgHTML);
		}
	});
}

function showFeedbackUser(id){
	var msg = showMessage('Подождите, идет загрузка ...', 'showFeedbackUserDialog', true);
	$.post('/clients/getFeedbackUser', {id: id}).fail(function(){
		$(msg).find('.modal-body').html('Произошла ошибка. Попробуйте перезагрузить страницу.');
	}).done(function(data){
		console.log(data);
		data = JSON.parse(data);
		var msgHTML = '';
		if(data.error == 200){
			msgHTML = '<h2>Отзывы о клиенте <b>'+ data.data[0].client_name +'</b></h2><br>';
			for(var i = 0; i < data.data.length; i++){
				var it = data.data[i];	
				msgHTML += 
					'<blockquote style="overflow:hidden;">'+
						'<div class="col-md-11">'+
							it.comment +
							'<br><span class="small">от &laquo;'+ it.user +'&raquo;'+ ((it.date_from && it.date_till && it.car) ? (' ('+ it.date_from +' &rarr; '+ it.date_till +', '+ it.car +')</span>') : '') +
						'</div>'+
						'<div class="col-md-1">'+
							'<b>'+ it.mark +'</b>'+
						'</div>'+							
					'</blockquote>'
			}						

		}else
			msgHTML = 'Не найдено ни одного отзыва об этом клиенте.';
		
		msgHTML += '<hr><button type="button" class="btn btn-primary" onclick="getUserInfoMore('+ id +');">Назад</button><button type="button" class="btn btn-default" data-dismiss="modal" style="margin-left: 10px;">Закрыть</button></div>';
		
		$(msg).find('.modal-body').html(msgHTML);
	});
}
	
$(document).ready(function(){

	$('form#searchClient').submit(function(e){
		e.preventDefault();

		var $form = $(this),
			$submit = $form.find('input[type=submit]'),
			$clientPattern = $form.find('input[name=clientPattern]'),
			$clientPatternVal = $clientPattern.val();

		$form.find('.form-group').removeClass('has-error');

		if($form.is('[loading]')) return;
		$submit.addClass('disabled');
		$form.attr('loading', '');
		$clientPattern.addClass('disabled');

		$.post('/clients/all/getCientsList', {term: $clientPatternVal}).fail(function(){
			document.location.reload();
		}).done(function(data){
			data = JSON.parse(data);
			console.log(data);
			var $searchClientList = $('#searchClientList tbody').empty();
			if(data.error == 200){
				current_clients = data.data;
				for(var i = 0; i < data.data.length; i++){
					var it = data.data[i];
					$searchClientList.append(
						"<tr>"+
							"<td>"+ (i+1) +"</td>"+
							"<td>"+ [it.last_name, it.first_name, it.middle_name].join(' ') +"</td>"+
							"<td>"+
								((it.blacked == '1') ? "<span style='color: red; font-weight: bold'>В черном списке!</span>" : "<b>Рейтинг:</b> "+ it.rate) +
							"</td>"+
							"<td>"+
								"<button type='button' class='btn btn-normal' onclick='getUserInfoMore("+ it.id +");'>Подробнее</button>"+	
							"</td>"+
							"<td>"+	
								"<a href='/order/new/?q="+ it.passport_prefix + it.passport_number +"' class='btn btn-success'>Оформить</button>"+
							"</td>"+
							"<td>"+
								((it.can_eidt == '1') ? ("<a href='/clients/edit/?id="+ it.id +"' class='btn btn-primary' target='_blank'>Изменить</a>") : "") +
							"</td>"+
						"</tr>"
					);
				}
			}else
				$searchClientList.append('<tr><td>Поиск не дал результатов. <a href="/clients/add" class="btn btn-success">Создать нового клиента</a></td></tr>');
		}).always(function(){
			$form.removeAttr('loading');
			$submit.removeClass('disabled');
		});

	});

});