<h2>Все автомобили</h2><br>

<div class="col-lg-8 col-md-8 col-sm-12">
<table class="table">

	<?php
		
		if($cars) foreach($cars as $idx => $car){
	?>
		
		<tr>
			<td><?php echo $idx+1; ?></td>
			<td><?php echo $car['car_make'] .' '. $car['car_model']; ?></td>
			<td><?php echo $car['car_number']; ?></td>
			<td><?php echo $car['car_year']; ?></td>
			<td><?php echo $car['car_color']; ?></td>
			<td><?php echo $car['car_body']; ?></td>
		</tr>

	<?php
		}
	?>

</table>	
</div>