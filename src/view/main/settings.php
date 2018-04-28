<h2>Настройки аккаунта</h2><br>

<form class="form-horizontal" role="form" id="settingsForm">

	<div class="form-group">
		<label for="name" class="col-sm-2 control-label">Название проката</label>
		<div class="col-sm-5">
			<input name="name" type="text" class="form-control" placeholder="Название" value="<?php echo $_SESSION['user']['name']; ?>">		
		</div>
	</div>	

	<div class="form-group">
		<label for="pass_1" class="col-sm-2 control-label">Пароль</label>
		<div class="col-sm-5">
			<div class="row">
				<div class="col-sm-6"><input name="pass_1" type="password" class="form-control" placeholder="Новый пароль">	</div>
				<div class="col-sm-6"><input name="pass_2" type="password" class="form-control" placeholder="Повторите, чтобы не ошибиться"></div>
			</div>	
		</div>
	</div>	

	<div class="form-group">
		<label for="rent_place" class="col-sm-2 control-label">Адрес передачи ТС</label>
		<div class="col-sm-5">
			<input name="rent_place" type="text" class="form-control" placeholder="Адрес" value="<?php echo $_SESSION['user']['rent_place']; ?>">		
		</div>
	</div>															

	<div class="form-group">
		<div class="col-sm-5 col-sm-push-2">
			<input type="submit" class="btn btn-primary" value="Сохранить">
		</div>				
	</div>	

</form>