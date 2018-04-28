<h2>Создать заказ</h2>

<form class="form-horizontal" role="form" style="margin-top: 30px;">

	<div class="form-group">
		<label for="client" class="col-sm-2 control-label">Клиент</label>
		<div class="col-sm-5">

			<ul class="nav nav-tabs">
			  <li class="active"><a href="#newClient" data-toggle="tab">Новый</a></li>
			  <li><a href="#oldClient" data-toggle="tab">Существующий</a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane active fade in" id="newClient">
					<label for="client_first_name" class="control-label">Имя</label>
					<input name="client_first_name" type="text" class="form-control">

					<label for="client_last_name" class="control-label">Фамилия</label>
					<input name="client_last_name" type="text" class="form-control">

					<label for="client_middle_name" class="control-label">Отчество</label>
					<input name="client_middle_name" type="text" class="form-control">	

					<label for="client_birthday" class="control-label">Дата рождения</label>
					<input name="client_birthday" type="text" class="form-control">	

					<label for="client_passport_prefix" class="control-label">Серия паспорта</label>
					<input name="client_passport_prefix" type="text" class="form-control">	

					<label for="client_passport_number" class="control-label">Номер паспорта</label>
					<input name="client_passport_number" type="text" class="form-control">		

					<label for="client_passport_emitted" class="control-label">Кем выдан</label>
					<input name="client_passport_emitted" type="text" class="form-control">		

					<label for="client_passport_date" class="control-label">Дата выдачи</label>
					<input name="client_passport_date" type="text" class="form-control">	

					<button type="button" class="btn btn-success" style="margin-top: 15px;">Добавить сканы паспорта</button>
					<button type="button" class="btn btn-success" style="margin-top: 15px;">Добавить фото</button>

				</div>

				<div class="tab-pane fade" id="oldClient">
					<br>
					<select name="client" id="orderClientSelect"></select>			  	
				</div>
			</div>			
		</div>
	</div>

	<div class="form-group">
		<label for="car" class="col-sm-2 control-label">Автомобиль</label>
		<div class="col-sm-5">
			<select name="car" id="orderCarSelect"></select>
		</div>				
	</div>	

	<div class="form-group">
		<label for="date_from" class="col-sm-2 control-label">Начало срока аренды</label>
		<div class="col-sm-5">
			<input name="date_from" type="text" class="form-control">
		</div>				
	</div>				

	<div class="form-group">
		<label for="date_till" class="col-sm-2 control-label">Окончание срока аренды</label>
		<div class="col-sm-5">
			<input name="date_till" type="text" class="form-control">
		</div>				
	</div>	

	<div class="form-group">
		<div class="col-sm-5 col-sm-push-2">
			<input type="submit" class="btn btn-primary" value="Продолжить">
		</div>				
	</div>	

</form>