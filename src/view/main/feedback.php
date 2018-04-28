<h2>Обратная связь</h2><br>

<form class="ajaxForm form-horizontal" action="/feedback/process" callback-after="feedbackFormCallbackAfter" id="feedbackForm">

	<div class="form-group">
		<div class="col-sm-7">
			<textarea name="question" cols="30" rows="10" placeholder="Опишите Ваш вопрос или проблему" class="form-control" require></textarea>	
		</div>
	</div>	
	<div class="form-group">
		<div class="col-sm-7">
			<input name="contacts" placeholder="Напишите E-mail для свази с Вами" class="form-control" require>
		</div>
	</div>		

	<input type="hidden" name="referer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">

	<div class="form-group">
		<div class="col-sm-7">
			<input type="submit" class="btn btn-primary submit" value="Отправить">
		</div>				
	</div>	

</form>

<script>
	function feedbackFormCallbackAfter(data){
		console.log(data);
		data = JSON.parse(data);
		var $form = $('#feedbackForm');
		if(data.error == 200){
			showAlert($form, 'Ваша заявка отправлена специалистам.', 'success');
			$form.trigger('reset');
		}else
			showAlert($form, 'Не удалось отправить заявку. Свяжитесь с нами по электронной почте <a href="mailto:dev@swat.one">dev@swat.one</a>');
	}
</script>