<div class="container">

	<div class="row">

		<?php 
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
		*/

		?>

		
		<?php foreach ($cuentas as $cu): ?>

			<table class="table table-hover table-responsive-md col-md-5 scheme">
				<thead class="text-center">
					<tr>
						<th colspan="2">
							<?php echo $cu->cuenta; ?>					
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

						<?php if ($regs->cuenta == $cu->cuenta and $regs->registro_id==NULL): ?>
							<tr>
								<td class="border-right">$ <?php echo number_format($regs->debe,2,'.',','); ?></td>
						    <td class="">$ <?php echo number_format($regs->haber,2,'.',','); ?></td>
							</tr>

							<?php $total_debe += $regs->debe; ?>
							<?php $total_haber += $regs->haber; ?>

						<?php endif ?>						

					<?php endforeach //registros ?>

					<?php foreach ($parciales as $parc): ?>

						<?php if ($parc->cuenta == $cu->cuenta and $parc->registro_id!=NULL): ?>
							<tr>
								<td class="border-right ">$ <?php echo number_format($parc->debe,2,'.',','); ?></td>
						    <td class="">$ <?php echo number_format($parc->haber,2,'.',','); ?></td>
							</tr>

							<?php $total_debe += $parc->debe; ?>
							<?php $total_haber += $parc->haber; ?>

						<?php endif ?>


					<?php endforeach //parciales ?>

					<tr>
						<th class="  border-right"><?php echo $total_debe; ?></th>
						<th class=" "><?php echo $total_haber; ?></th>
					</tr>

					<tr>
						<?php if ($total_debe>=$total_haber): ?>
							<th class=" border-right"><?php echo abs($total_debe-$total_haber); ?></th>
							<th class=""></th>
						<?php else: ?>
							<th class=" border-right"></th>
							<th class=""><?php echo abs($total_debe-$total_haber); ?></th>
						<?php endif ?>						
					</tr>
					
				</tbody>
			</table>
			
		<?php endforeach ?>

	</div>
</div>