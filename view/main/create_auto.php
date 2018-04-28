<h2>Новая модель автомобиля</h2>

<form class="form-horizontal" role="form" style="margin-top: 30px;" id="createAutoForm">

	<div class="form-group">
		<label for="car_make" class="col-sm-2 control-label">Марка</label>
		<div class="col-sm-5">
			<select name="car_make" id="createAutoCarMakeSelect">
				<option></option>
			</select>			
		</div>
	</div>

	<div class="form-group">
		<label for="car_model" class="col-sm-2 control-label">Модель</label>
		<div class="col-sm-5">
			<input type="text" name="car_model" placeholder="Lancer Evo X" class="form-control" require>
		</div>				
	</div>	

	<div class="form-group">
		<div class="col-sm-5 col-sm-push-2">
			<input type="submit" class="btn btn-primary" value="Продолжить">
		</div>				
	</div>	

</form>