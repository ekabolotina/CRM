<h2>Новый автомобиль</h2>

<form class="form-horizontal" role="form" style="margin-top: 30px;" id="addAutoForm">

	<div class="form-group">
		<label for="car_make" class="col-sm-2 control-label">Марка</label>
		<div class="col-sm-5">
			<select name="car_make" id="addAutoCarMakeSelect">
				<option></option>
			</select>			
		</div>
	</div>

	<div class="form-group">
		<label for="car_model" class="col-sm-2 control-label">Модель</label>
		<div class="col-sm-5">
			<select name="car_model" id="addAutoCarModelSelect">
				<option></option>
			</select>
		</div>				
	</div>	

	<div class="form-group">
		<label for="car_year" class="col-sm-2 control-label">Год выпуска</label>
		<div class="col-sm-5">
			<input name="car_year" type="text" class="form-control" data-toggle="tooltip" data-placement="right" title="Пример: 2017" placeholder="2017" require>
		</div>				
	</div>				

	<div class="form-group">
		<label for="car_number" class="col-sm-2 control-label">Гос. номер</label>
		<div class="col-sm-5">
			<input name="car_number" type="text" class="form-control" data-toggle="tooltip" data-placement="right" title="Пример: с999сс125" placeholder="с999сс125" require>
		</div>				
	</div>	

	<div class="form-group">
		<label for="car_body" class="col-sm-2 control-label">Кузов</label>
		<div class="col-sm-5">
			<input name="car_body" type="text" class="form-control" data-toggle="tooltip" data-placement="right" title="Пример: СQRE-259978" placeholder="СQRE-259978" require>
		</div>				
	</div>		

	<div class="form-group">
		<label for="car_color" class="col-sm-2 control-label">Цвет:</label>
		<div class="col-sm-5">
			<input name="car_color" type="text" class="form-control" data-toggle="tooltip" data-placement="right" title="Пример: Серый" placeholder="Серый" require>
		</div>				
	</div>		

	<div class="form-group">
		<div class="col-sm-5 col-sm-push-2">
			<input type="submit" class="btn btn-primary" value="Продолжить">
		</div>				
	</div>	

</form>