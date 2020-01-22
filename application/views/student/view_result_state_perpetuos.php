<div class="container">
	<div class="table-responsive">
	<table class="table ">
		<thead>
			<tr>
				<th colspan="100%" class="text-center text-uppercase"><?php echo $exercise->nombre; ?></th>
			</tr>
			<tr>
				<td colspan="100%" class="text-center">Estado de resultados del <?php echo $fecha_inicio; ?> al <?php echo $fecha_fin; ?></td>
			</tr>	
		</thead>
		<tbody>
			<!-- Ventas totales-->
			<?php $utilidad=0; $aux=0; ?>
			<?php foreach ($registers as $register) {?>
				<?php if ($register->folio == 4103){?>
					<tr>
						<td><?php echo $register->cuenta;?></td>
						<td></td>
						<td></td>
						<td></td>
						<?php $aux=$register->haber-$register->debe;?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
					</tr>
				<?php } ?>
			<?php } ?>
			<?php $utilidad=$utilidad+$aux; $aux=0; ?>

			<!-- costo de ventas -->
			<?php foreach ($registers as $register) {?>
				<?php if ($register->folio == 5301){?>
					<tr>
						<td><?php echo $register->cuenta;?></td>
						<td></td>
						<td></td>
						<td></td>
						<?php $aux=$register->debe-$register->haber;?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
					</tr>
				<?php } ?>
			<?php } ?>
			<?php $utilidad=$utilidad-$aux; $aux=0; ?>

			<!-- utilidad o perdida-->
			<tr>
				<td><?php if ($utilidad>0){ echo "utilidad";}else{echo "perdida";} ?> bruta</td>
				<td></td>
				<td></td>
				<td></td>
				<td class="text-right <?php if ($utilidad<0){echo 'text-danger';} ?>">$ <?php echo number_format($utilidad,2,'.',',');?></td>
			</tr>

			<!-- Gastos de operacion -->
			<tr>
				<td>Gastos de operacion</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php $perdida=0;$aux=0; ?>

			<!-- Gastos de operacion -->
			<?php foreach ($registers as $register) {?>
				<?php if ($register->folio == 5601 	){?>
					<tr>
						<td><?php echo $register->cuenta;?></td>
						<td></td>
						<td></td>
						<?php $aux=$register->debe-$register->haber;?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
						<td></td>
					</tr>
				<?php } ?>
			<?php } ?>
			<?php $perdida=$perdida+$aux; $aux=0; ?>

			<!-- gastos de administracion -->
			<?php foreach ($registers as $register) {?>
				<?php if ($register->folio == 5501 	){?>
					<tr>
						<td><?php echo $register->cuenta;?></td>
						<td></td>
						<td></td>
						<?php $aux=$register->debe-$register->haber;?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
						<?php $perdida=$perdida+$aux; $aux=0; ?>
						<td class="text-right <?php if ($perdida<0){echo 'text-danger';} ?>">$ <?php echo number_format($perdida,2,'.',',');?></td>
					</tr>
				<?php } ?>
			<?php } ?>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<?php $utilidad=$utilidad-$perdida ?>
				<td class="text-right <?php if ($utilidad<0){echo 'text-danger';} ?>">$ <?php echo number_format($utilidad,2,'.',',');?></td>
			</tr>
		</tbody>
	</table>
</div>