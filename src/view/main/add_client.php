<?php
	$clientTmpId = sha1(time() * mt_rand(999, 9999));
?>

<h2>Новый клиент</h2>

<form class="form-horizontal" role="form" style="margin-top: 30px;" id="addClientForm">

	<div class="form-group">
		<label for="client_first_name" class="col-sm-2 control-label">Имя</label>
		<div class="col-sm-5">
			<input name="client_first_name" type="text" class="form-control" placeholder="Имя" require>		
		</div>
	</div>

	<div class="form-group">
		<label for="client_last_name" class="col-sm-2 control-label">Фамилия</label>
		<div class="col-sm-5">
			<input name="client_last_name" type="text" class="form-control" placeholder="Фамилия" require>
		</div>				
	</div>	

	<div class="form-group">
		<label for="client_middle_name" class="col-sm-2 control-label">Отчество</label>
		<div class="col-sm-5">
			<input name="client_middle_name" type="text" class="form-control" placeholder="Отчество" require>
		</div>				
	</div>				

	<div class="form-group">
		<label for="client_birthday" class="col-sm-2 control-label">Дата рождения</label>
		<div class="col-sm-5">
			<input name="client_birthday" type="text" class="form-control" placeholder="Дата рождения" require>
		</div>				
	</div>	

	<hr>

	<div class="form-group">
		<label for="client_passport_prefix" class="col-sm-2 control-label">Серия паспорта</label>
		<div class="col-sm-5">
			<input name="client_passport_prefix" type="text" class="form-control" placeholder="Серия паспорта" require>
		</div>				
	</div>	

	<div class="form-group">
		<label for="client_passport_number" class="col-sm-2 control-label">Номер паспорта</label>
		<div class="col-sm-5">
			<input name="client_passport_number" type="text" class="form-control" placeholder="Номер паспорта" require>	
		</div>				
	</div>	

	<div class="form-group">
		<label for="client_passport_emitted" class="col-sm-2 control-label">Кем выдан</label>
		<div class="col-sm-5">
			<input name="client_passport_emitted" type="text" class="form-control" placeholder="Кем выдан паспорт" require>
		</div>				
	</div>		

	<div class="form-group">
		<label for="client_passport_date" class="col-sm-2 control-label">Дата выдачи</label>
		<div class="col-sm-5">
			<input name="client_passport_date" type="text" class="form-control" placeholder="Дата выдачи паспорта" require>	
		</div>				
	</div>		

	<hr>

	<div class="form-group">
		<label for="client_license_prefix" class="col-sm-2 control-label">Серия ВУ</label>
		<div class="col-sm-5">
			<input name="client_license_prefix" type="text" class="form-control" placeholder="Серия водительского удостоверения" require>	
		</div>				
	</div>		

	<div class="form-group">
		<label for="client_license_number" class="col-sm-2 control-label">Номер ВУ</label>
		<div class="col-sm-5">
			<input name="client_license_number" type="text" class="form-control" placeholder="Номер водительского удостоверения" require>	
		</div>				
	</div>	

	<div class="form-group">
		<label for="client_license_emitted" class="col-sm-2 control-label">Кем выдано ВУ</label>
		<div class="col-sm-5">
			<input name="client_license_emitted" type="text" class="form-control" placeholder="Кем выдано ВУ" require>	
		</div>				
	</div>	

	<div class="form-group">
		<label for="client_license_date" class="col-sm-2 control-label">Дата выдачи ВУ</label>
		<div class="col-sm-5">
			<input name="client_license_date" type="text" class="form-control" placeholder="Дата выдачи водительского удостоверения" require>	
		</div>				
	</div>	

	<hr>

	<div class="form-group">
		<label for="client_address_residence" class="col-sm-2 control-label">Адрес прописки</label>
		<div class="col-sm-5">
			<input name="client_address_residence" type="text" class="form-control" placeholder="Адрес прописки" require>	
		</div>				
	</div>	

	<div class="form-group">
		<label for="client_address_real" class="col-sm-2 control-label">Адрес проживания</label>
		<div class="col-sm-5">
			<input name="client_address_real" type="text" class="form-control" placeholder="Адрес проживания">	
		</div>				
	</div>	

	<hr>

	<div class="form-group">
		<label for="client_phone_home" class="col-sm-2 control-label">Телефон домашний</label>
		<div class="col-sm-5">
			<input name="client_phone_home" type="text" class="form-control" placeholder="Телефон домашний">	
		</div>				
	</div>		

	<div class="form-group">
		<label for="client_phone_work" class="col-sm-2 control-label">Телефон рабочий</label>
		<div class="col-sm-5">
			<input name="client_phone_work" type="text" class="form-control" placeholder="Телефон рабочий">	
		</div>				
	</div>		

	<div class="form-group">
		<label for="client_phone_mobile" class="col-sm-2 control-label">Телефон мобильный</label>
		<div class="col-sm-5">
			<input name="client_phone_mobile" type="text" class="form-control" placeholder="Телефон мобильный" require>	
		</div>				
	</div>	

	<hr>

	<div class="form-group">
		<label for="client_photos" class="col-sm-2 control-label">Фотография и сканы документов</label>
		<div class="col-sm-5">
			<input type="hidden" name="client_photos">
			<button type="button" class="btn btn-success" onclick="$('#addClientFormUploader input[type=file]').click();" id="addClientFormAddPhotoBtn">Добавить</button>
			<div class="row" id="addClientFormAddPhotoGallery"></div>
		</div>					
	</div>		

	<hr>													

	<input type="hidden" name="client_tmp_id" value="<?php echo $clientTmpId; ?>">

	<div class="form-group">
		<div class="col-sm-5 col-sm-push-2">
			<input type="submit" class="btn btn-primary" value="Продолжить">
		</div>				
	</div>	

</form>

<form id="addClientFormUploader" style="display: none;"><input type="file" name="files" onChange="uploadFile(event);" accept="image/jpeg" multiple>
	<input type="hidden" name="tmpId" value="<?php echo $clientTmpId; ?>">
</form>