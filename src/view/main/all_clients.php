<h2>Все клиенты</h2><br>

<form id="searchClient">
	<div class="row">
		<div class="form-group col-md-4">
			<input type="text" name="clientPattern" class="form-control" placeholder="Фамилия, имя, отчество или номер документа клиента">
		</div>
		<div class="form-group col-md-8">
			<input type="submit" class="btn btn-primary" value="Найти">
		</div>		
	</div>
</form>
<br>

<div class="col-lg-8 col-md-8 col-sm-12">
	<table class="table" id="searchClientList">

		<?php
			
			if($clients) foreach($clients as $idx => $client){
		?>
			
			<tr>
				<td><?php echo $idx+1; ?></td>
				<td><?php echo $client['client_name']; ?></td>
				<td><?php echo ($client['client_blacked']) ? '<span style="font-weight:bold;color:red;">В черном списке</span>' : '<b>Рейтинг:</b> '. $client['client_rate']; ?></td>
				<td><button type="button" class="btn btn-normal" onclick="getUserInfoMore(<?php echo $client['id']; ?>);">Подробнее</button></td>
				<td><a href="/order/new/?q=<?php echo $client['client_passport']; ?>" class="btn btn-success" target="_blank">Оформить</a></td>

				<td>

				<?php
					if($client['client_owner'] == $_SESSION['user']['id'] || $_SESSION['user']['access'] == 1){
				?>

					<a href="/clients/edit/?id=<?php echo $client['id']; ?>" class="btn btn-primary" target="_blank">Изменить</a>

				<?php
					}
				?>

				</td>
			</tr>

		<?php
			}else{
		?>
			
				<div class="panel panel-warning">
					<div class="panel-heading">Сообщение</div>
					<div class="panel-body">
						Не найдено ни одного клиента. <a href="/clients/add/" class="btn btn-success">Добавить клиента</a>
					</div>
				</div>

		<?php
			}
		?>

	</table>	
</div>