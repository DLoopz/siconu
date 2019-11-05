<div class="container">
	<div><h3 class="text-center">Esquemas de Mayor</h3></div>
	<hr class="line_sep">
	<div class="row">
		<div class="col-12 text-right">
      <a href="<?php echo base_url();?>student/close_exercise/<?php echo $id_empresa;?>" class="btn btn-outline-danger my-2 my-sm-0" aria-label="Left Align" title="Cerrar Empresa"><i class="icon-cancel-circled"></i></a>
      <a href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Regresar a Empresas"><i class="icon-home-1"></i></a>
  	</div>
	</div>
	<br>

	<div class="row">

		<?php 

		//no borraar
		$aux_ases = 1;
		$numero_asiento = array();
		//echo $asientos[0]->id_asiento;
		//echo 'num asientos'.count($asientos);
		for ($i=0; $i < count($asientos); $i++) { 
			$numero_asiento[$asientos[$i]->id_asiento] = $i+1;
		}
		//print_r($numero_asiento);
		//echo $numero_asiento[66];
		/*if ($regs->debe>0): ?>
				<?php echo $numero_asiento[$regs->id_asiento].')'; ?>
			<?php endif 

		<?php echo '<pre>'.print_r($,1).'</pre>'?>

		*/
		?>

		<?php //echo '<pre>'.print_r($cuentas,1).'</pre>'?>		
		<?php //echo '<pre>'.print_r($catalog,1).'</pre>'?>
		<?php //echo '<pre>'.print_r($registros,1).'</pre>'?>

		
		<?php foreach ($catalog as $cu): ?>
			
			<?php foreach ($cuentas as $accs): ?>
				<?php if ($accs->cuenta == $cu->nombre): ?>
			
				<table class="table table-hover table-responsive-md col-md-5 scheme">
					<thead class="text-center">
						<tr>
							<th colspan="2">
								<?php echo $cu->nombre; ?>
							</th>
						</tr>
						<tr>
							<th colspan="">Debe</th>
							<th colspan="">Haber</th>
						</tr>
					</thead>
					<tbody>


						
						<?php //en cada cuenta
						$total_debe = 0;
						$total_haber = 0;
						?>
					
						<?php foreach ($registros as $regs): ?>

							<?php if ($regs->cuenta == $cu->nombre and $regs->registro_id==NULL): ?>
								<tr>
									<td class="border-right text-right">$ <?php echo number_format($regs->debe,2,'.',','); ?></td>
							    <td class="text-right">$ <?php echo number_format($regs->haber,2,'.',','); ?></td>
								</tr>

								<?php $total_debe += $regs->debe; ?>
								<?php $total_haber += $regs->haber; ?>

							<?php endif ?>						

						<?php endforeach //registros ?>

						<?php foreach ($parciales as $parc): ?>

							<?php if ($parc->cuenta == $cu->nombre and $parc->registro_id!=NULL): ?>
								<tr>
									<td class="border-right text-right">$ <?php echo number_format($parc->debe,2,'.',','); ?></td>
							    <td class="text-right">$ <?php echo number_format($parc->haber,2,'.',','); ?></td>
								</tr>

								<?php $total_debe += $parc->debe; ?>
								<?php $total_haber += $parc->haber; ?>

							<?php endif ?>

						<?php endforeach //parciales ?>

						<tr>
							<th class="  border-right text-right">$ <?php echo number_format($total_debe,2,'.',','); ?></th>
							<th class=" text-right">$ <?php echo number_format($total_haber,2,'.',','); ?></th>
						</tr>

						<tr>
							<?php if ($total_debe>=$total_haber): ?>
								<th class=" border-right table-success text-right">$ <?php echo number_format(abs($total_debe-$total_haber),2,'.',','); ?></th>
								<th class="table-secondary"></th>
							<?php else: ?>
								<th class=" border-right table-secondary"></th>
								<th class="table-danger">$ <?php echo number_format(abs($total_debe-$total_haber),2,'.',','); ?></th>
							<?php endif ?>						
						</tr>
						
					</tbody>
				</table>
				
				<?php endif ?>
			<?php endforeach ?>
			
		<?php endforeach ?>

	</div>
</div>
