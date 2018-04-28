<h2>Создать заказ</h2>

<form id="orderSearchClient" style="margin-top: 30px;">
	<div class="row">
		<div class="form-group col-md-6">
			<input type="text" name="clientPattern" class="form-control" placeholder="Фамилия, имя, отчество или номер документа клиента" value="<?php echo $_GET['q']; ?>">
		</div>
		<div class="form-group col-md-6">
			<input type="submit" class="btn btn-primary" value="Найти">
		</div>		
	</div>
</form>
<br>

<div class="row"><div class="col-md-10" id="orderSearchClientList"></div></div>

<div id="orderExecuteForm" style="display: none;">
	<form class="form-horizontal" role="form" style="margin-top: 30px;">

			<input type="hidden" name="client">

			<div class="form-group">
				<label for="client" class="col-sm-2 control-label">Клиент</label>
				<div class="col-sm-5">
					<input name="client_name" type="text" class="form-control" disabled value="Болотин Иван">
				</div>				
			</div>				

			<div class="form-group">
				<label for="car" class="col-sm-2 control-label">Автомобиль</label>
				<div class="col-sm-5">
					<select name="car" id="orderCarSelect"></select>
				</div>				
			</div>

			<div class="form-group">
				<label for="assessed_price" class="col-sm-2 control-label">Оценочная стоимость автомобиля:</label>
				<div class="col-sm-5">
					<input name="assessed_price" type="text" class="form-control">
				</div>				
			</div>

			<div class="form-group">
				<label for="date_from" class="col-sm-2 control-label">Начало срока аренды</label>
				<div class="col-sm-5">
					<input name="date_from" type="text" class="form-control" require>
				</div>				
			</div>				

			<div class="form-group">
				<label for="date_till" class="col-sm-2 control-label">Окончание срока аренды</label>
				<div class="col-sm-5">
					<input name="date_till" type="text" class="form-control" require>
				</div>				
			</div>	

			<div class="form-group">
				<label for="rent_period" class="col-sm-2 control-label">Срок аренды:</label>
				<div class="col-sm-5">
					<input name="rent_period" type="text" class="form-control" placeholder="24 часа">
				</div>				
			</div>

			<div class="form-group">
				<label for="place" class="col-sm-2 control-label">Место выдачи:</label>
				<div class="col-sm-5">
					<input name="place" type="text" class="form-control" value="<?php echo $_SESSION['user']['rent_place']; ?>">
				</div>				
			</div>	

			<div class="form-group">
				<label for="fact_return_date" class="col-sm-2 control-label">Фактическая дата, время и место возврата автомобиля:</label>
				<div class="col-sm-2">
					<input name="fact_return_date" type="text" class="form-control">
				</div>	
				<div class="col-sm-3">
					<input name="fact_return_place" type="text" class="form-control" placeholder="Место">
				</div>												
			</div>	

			<div class="form-group">
				<label for="people_allowed" class="col-sm-2 control-label">Лица допущенные к управлению ТС:</label>
				<div class="col-sm-5">
					<textarea name="people_allowed" type="text" class="form-control" placeholder="Вводите через запятую"></textarea>
				</div>				
			</div>	

			<div class="form-group">
				<label for="insurance_deposit" class="col-sm-2 control-label">Увеличенный/уменьшенный страховой депозит:</label>
				<div class="col-sm-5">
					<input name="insurance_deposit" type="text" class="form-control">
				</div>				
			</div>	

			<div class="form-group">
				<label for="price" class="col-sm-2 control-label">Стоимость суток проката (руб.):</label>
				<div class="col-sm-5">
					<input name="price" type="text" class="form-control">
				</div>				
			</div>		

			<div class="form-group">
				<label for="full_price" class="col-sm-2 control-label">Общая стоимость субаренды (руб.):</label>
				<div class="col-sm-5">
					<input name="full_price" type="text" class="form-control">
				</div>				
			</div>	

			<div class="form-group">
				<label for="full_price_off" class="col-sm-2 control-label">Стоимость субаренды со скидкой (руб.):</label>
				<div class="col-sm-5">
					<input name="full_price_off" type="text" class="form-control">
				</div>				
			</div>	

			<div class="form-group">
				<div class="col-sm-5 col-sm-push-2">
					<input type="submit" class="btn btn-primary" value="Продолжить">
					<a href="/order/new/" class="btn btn-warning">Отмена</a>
				</div>				
			</div>	
		
	</form>
</div>