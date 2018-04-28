<h2>Все заказы проката &laquo;<?php echo $_SESSION['user']['name']; ?>&raquo;</h2><br>

<div class="col-sm-12">
<table class="table" id="allOrdersList">

	<?php
		
		if($orders) foreach($orders as $idx => $order){
	?>
		
		<tr data-order_id="<?php echo $order['id']; ?>">
			<td><?php echo $idx+1; ?></td>
			<td><?php echo $order['client']; ?></td>
			<td><?php echo $order['car']; ?></td>
			<td>
				<a href="/order/genRentContract?id=<?php echo $order['id']; ?>&type=0" class="btn btn-primary" target="_blank">Договор (седан)</a>
				<a href="/order/genRentContract?id=<?php echo $order['id']; ?>&type=1" class="btn btn-primary" target="_blank">Договор (джип)</a>				
			</td>
			<td>

				<?php
					if($order['order_status']){
				?>
						<button type="button" class="btn btn-warning returnOrderBtn" onclick="returnOrder(event, <?php echo $order['id']; ?>)">Закрыть заказ</button>
				<?php
					}else{
				?>
						Заказ закрыт.
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
						Вы не оформили ни одного заказа. <a href="/order/new/" class="btn btn-success">Создать новый заказ</a>
					</div>
				</div>

	<?php
		}
	?>

</table>	
</div>