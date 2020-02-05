<div class="container">
	<form action="<?php echo base_url();?>daybook/pdf" method='post' class="">
	  <button type="submit" id="sendcont" name="sendcont" class="btn btn-outline-primary btn-pdf" title="Generar PDF" value="1"><i class="icon-file-pdf"></i></button>
	  <input type="text" id="id_empresa" name="id_empresa" value="<?php if(isset($id_empresa)) echo $id_empresa;?>" class="invisible">
	  <input type="text" id="titulo_pdf" name="titulo_pdf" value="<?php if(isset($titulo_pdf)) echo $titulo_pdf;?>" class="invisible">
	  <input type="text" id="contpdf" name="contpdf" class="invisible">
	</form>
	<div><h3 class="text-center">Esquemas de Mayor</h3></div>
	<hr class="line_sep">
	<div class="row">
	</div>
	<br>

	<div class="row">

		
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
									<td class="border-right text-right"><?php if($regs->debe > 0){echo '$ '.number_format($regs->debe,2,'.',',');} ?></td>
							    <td class="text-right"><?php if($regs->haber > 0){echo '$ '.number_format($regs->haber,2,'.',',');} ?></td>
								</tr>

								<?php $total_debe += $regs->debe; ?>
								<?php $total_haber += $regs->haber; ?>

							<?php endif ?>						

						<?php endforeach //registros ?>

						<?php foreach ($parciales as $parc): ?>

							<?php if ($parc->cuenta == $cu->nombre and $parc->registro_id!=NULL): ?>
								<tr>
									<td class="border-right text-right"><?php if($parc->debe > 0){echo '$ '.number_format($parc->debe,2,'.',',');} ?></td>
							    <td class="text-right"><?php if($parc->haber > 0){echo '$ '.number_format($parc->haber,2,'.',',');} ?></td>
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
								<th class=" border-right table-secondary text-right"></th>
								<th class="table-danger text-right">$ <?php echo number_format(abs($total_debe-$total_haber),2,'.',','); ?></th>
							<?php endif ?>						
						</tr>
						
					</tbody>
				</table>
			
				<?php endif ?>
			<?php endforeach ?>
			
		<?php endforeach ?>

	</div>
</div>
