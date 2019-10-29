<?php $cuenta=0; ?>
<div class="container">
	<div class="text-center"><h3>Balanza de comprobación</h3></div>
	<hr class="line_sep">

	<div class="row">
    <div class="col-12 text-right">
        <a href="<?php echo base_url();?>student/close_exercise/<?php echo $id_empresa;?>" class="btn btn-outline-danger my-2 my-sm-0" aria-label="Left Align" title="Cerrar Empresa"><i class="icon-cancel-circled"></i></a>
        <a href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Regresar a Empresas"><i class="icon-home-1"></i></a>
    </div>
	</div>
  <br>

	<h4 class="text-center"><?php echo $exercise->nombre; ?></h4>
	<br>


	<table class="table responsive-md">
		<thead>
			<tr>
				<th></th>
				<th>Cuenta</th>
				<th>Cargo</th>
				<th>Abono</th>
				<th>Saldo deudor</th>
				<th>Saldo acredor</th>
			</tr>
		</thead>
		<tbody>
			<?php $debe_total=0;$haber_total=0;$saldo_deudor_total=0;$saldo_acredor_total=0;
			foreach ($accounts as $account){
				$debe=0;$haber=0;$saldo_deudor=0;$saldo_acredor=0;?>
					<?php foreach ($registers as $register) { ?>
						<?php if ($account->nombre==$register->cuenta):
							$cuenta=$register->cuenta;
							$debe=$debe+$register->debe;
							$haber=$haber+$register->haber;
						endif ?>
				 	<?php } ?>
				 	<?php if ($cuenta): ?>
				 		<tr>
							<td></td>
							<td><?php echo $account->nombre; ?></td>
						 	<td class="text-right">$ <?php echo number_format($debe,2,'.',','); ?></td>
							<td class="text-right">$ <?php echo number_format($haber,2,'.',','); ?></td>
							<?php if ($debe>$haber)
								$saldo_deudor=$debe-$haber;
							else
								$saldo_acredor=$haber-$debe;
							?>
							<td class="text-right">$ <?php echo number_format($saldo_deudor,2,'.',','); ?></td>
							<td class="text-right">$ <?php echo number_format($saldo_acredor,2,'.',','); ?></td>
						</tr>
				 	<?php endif ?>
				<?php 
					$cuenta=0;
					$debe_total=$debe_total+$debe;
					$haber_total=$haber_total+$haber;
					$saldo_deudor_total=$saldo_deudor_total+$saldo_deudor;
					$saldo_acredor_total=$saldo_acredor_total+$saldo_acredor; ?>
			<?php } ?>
				<tr>
					<td></td>
					<th class="text-right">Total:</th>
					<th class="text-right">$ <?php echo number_format($debe_total,2,'.',',');?></th>
					<th class="text-right">$ <?php echo number_format($haber_total,2,'.',',');?></th>
					<th class="text-right">$ <?php echo number_format($saldo_deudor_total,2,'.',',');?></th>
					<th class="text-right">$ <?php echo number_format($saldo_acredor_total,2,'.',',');?></th>
				</tr>
		</tbody>
	</table>
</div>
