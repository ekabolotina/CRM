<?php
	if(!$client){
?>

	<div class="panel panel-danger">
		<div class="panel-heading">Ошибка</div>
		<div class="panel-body">
			Ошибка доступа.
		</div>
	</div>

<?php
	}else{
?>

	<h2>Редактирование клиента</h2>

	<form class="form-horizontal" role="form" style="margin-top: 30px;" id="editClientForm">

        <div class="form-group">
            <label for="client_last_name" class="col-sm-2 control-label">Фамилия</label>
            <div class="col-sm-5">
                <input name="client_last_name" type="text" class="form-control" placeholder="Фамилия" require value="<?php echo $client['last_name'] ?>">
            </div>              
        </div>  

		<div class="form-group">
			<label for="client_first_name" class="col-sm-2 control-label">Имя</label>
			<div class="col-sm-5">
				<input name="client_first_name" type="text" class="form-control" placeholder="Имя" require value="<?php echo $client['first_name'] ?>">		
			</div>
		</div>

		<div class="form-group">
			<label for="client_middle_name" class="col-sm-2 control-label">Отчество</label>
			<div class="col-sm-5">
				<input name="client_middle_name" type="text" class="form-control" placeholder="Отчество" require value="<?php echo $client['middle_name'] ?>">
			</div>				
		</div>				

		<div class="form-group">
			<label for="client_birthday" class="col-sm-2 control-label">Дата рождения</label>
			<div class="col-sm-5">
				<input name="client_birthday" type="text" class="form-control" placeholder="Дата рождения" require value="<?php echo $client['birthday'] ?>">
			</div>				
		</div>	

		<hr>

		<div class="form-group">
			<label for="client_passport_prefix" class="col-sm-2 control-label">Серия паспорта</label>
			<div class="col-sm-5">
				<input name="client_passport_prefix" type="text" class="form-control" placeholder="Серия паспорта" require value="<?php echo $client['passport_prefix'] ?>">
			</div>				
		</div>	

		<div class="form-group">
			<label for="client_passport_number" class="col-sm-2 control-label">Номер паспорта</label>
			<div class="col-sm-5">
				<input name="client_passport_number" type="text" class="form-control" placeholder="Номер паспорта" require value="<?php echo $client['passport_number'] ?>">	
			</div>				
		</div>	

		<div class="form-group">
			<label for="client_passport_emitted" class="col-sm-2 control-label">Кем выдан</label>
			<div class="col-sm-5">
				<input name="client_passport_emitted" type="text" class="form-control" placeholder="Кем выдан паспорт" require value="<?php echo $client['passport_emitted'] ?>">
			</div>				
		</div>		

		<div class="form-group">
			<label for="client_passport_date" class="col-sm-2 control-label">Дата выдачи</label>
			<div class="col-sm-5">
				<input name="client_passport_date" type="text" class="form-control" placeholder="Дата выдачи паспорта" require value="<?php echo $client['passport_date'] ?>">	
			</div>				
		</div>		

		<hr>

		<div class="form-group">
			<label for="client_license_prefix" class="col-sm-2 control-label">Серия ВУ</label>
			<div class="col-sm-5">
				<input name="client_license_prefix" type="text" class="form-control" placeholder="Серия водительского удостоверения" require value="<?php echo $client['license_prefix'] ?>">	
			</div>				
		</div>		

		<div class="form-group">
			<label for="client_license_number" class="col-sm-2 control-label">Номер ВУ</label>
			<div class="col-sm-5">
				<input name="client_license_number" type="text" class="form-control" placeholder="Номер водительского удостоверения" require value="<?php echo $client['license_number'] ?>">	
			</div>				
		</div>	

		<div class="form-group">
			<label for="client_license_emitted" class="col-sm-2 control-label">Кем выдано ВУ</label>
			<div class="col-sm-5">
				<input name="client_license_emitted" type="text" class="form-control" placeholder="Кем выдано ВУ" require value="<?php echo $client['license_emitted'] ?>">	
			</div>				
		</div>	

		<div class="form-group">
			<label for="client_license_date" class="col-sm-2 control-label">Дата выдачи ВУ</label>
			<div class="col-sm-5">
				<input name="client_license_date" type="text" class="form-control" placeholder="Дата выдачи водительского удостоверения" require value="<?php echo $client['license_date'] ?>">	
			</div>				
		</div>	

		<hr>

		<div class="form-group">
			<label for="client_address_residence" class="col-sm-2 control-label">Адрес прописки</label>
			<div class="col-sm-5">
				<input name="client_address_residence" type="text" class="form-control" placeholder="Адрес прописки" require value="<?php echo $client['address_residence'] ?>">	
			</div>				
		</div>	

		<div class="form-group">
			<label for="client_address_real" class="col-sm-2 control-label">Адрес проживания</label>
			<div class="col-sm-5">
				<input name="client_address_real" type="text" class="form-control" placeholder="Адрес проживания" value="<?php echo $client['address_real'] ?>">	
			</div>				
		</div>	

		<hr>

		<div class="form-group">
			<label for="client_phone_home" class="col-sm-2 control-label">Телефон домашний</label>
			<div class="col-sm-5">
				<input name="client_phone_home" type="text" class="form-control" placeholder="Телефон домашний" value="<?php echo $client['phone_home'] ?>">	
			</div>				
		</div>		

		<div class="form-group">
			<label for="client_phone_work" class="col-sm-2 control-label">Телефон рабочий</label>
			<div class="col-sm-5">
				<input name="client_phone_work" type="text" class="form-control" placeholder="Телефон рабочий" value="<?php echo $client['phone_work'] ?>">	
			</div>				
		</div>		

		<div class="form-group">
			<label for="client_phone_mobile" class="col-sm-2 control-label">Телефон мобильный</label>
			<div class="col-sm-5">
				<input name="client_phone_mobile" type="text" class="form-control" placeholder="Телефон мобильный" require value="<?php echo $client['phone_mobile'] ?>">	
			</div>				
		</div>	

		<hr>

		<div class="form-group">
			<label for="client_photos" class="col-sm-2 control-label">Фотография и сканы документов</label>
			<div class="col-sm-5">
				<input type="hidden" name="client_photos" require value="<?php echo str_repeat('i', count($client_imgs)); ?>">
				<button type="button" class="btn btn-success" onclick="$('#editClientFormUploader input[type=file]').click();" id="editClientFormAddPhotoBtn">Добавить</button>
				<div class="row" id="editClientFormAddPhotoGallery">
				
				<?php
					if($client_imgs) foreach($client_imgs as $img){
				?>
			<div class="uploadedImg">
				<a href="#" class="glyphicon glyphicon-remove" onclick="removeUploadedImg(event, <?php echo $img['id']; ?>);"></a>
				<img src="/img/uploads/<?php echo $img['url']; ?>">
			</div>						
				<?php
					}  
				?>

				</div>
			</div>					
		</div>		

		<hr>													

		<input type="hidden" name="client_id" value="<?php echo $client['id']; ?>">

		<div class="form-group">
			<div class="col-sm-5 col-sm-push-2">
				<input type="submit" class="btn btn-primary" value="Продолжить">
			</div>				
		</div>	

	</form>

	<form id="editClientFormUploader" style="display: none;"><input type="file" name="files" onChange="uploadFile(event);" accept="image/jpeg" multiple>
		<input type="hidden" name="tmpId" value="<?php echo $client['id']; ?>">
	</form>

<?php
	}
?>