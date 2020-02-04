<div class="container">
	<div class="text-center"><h3>Estado de Resultados</h3></div>
	<hr class="line_sep">
	<div class="">
		<form method="post" action="<?php echo base_url();?>result_state/state/<?php echo $id_empresa;?>">
			<div class="row">
				<div class="form-group col-md-4">
					<label>Fecha de inicio:</label>
					<input class="form-control" type="date" name="fecha_inicio" value="<?php echo set_value('fecha_inicio') ?>" min="<?php echo(date('Y')-1) ?>-01-01" max="<?php echo(date('Y-m-d')) ?>">
					<?php echo form_error('fecha_inicio'); ?>
				</div>
				<div class="form-group col-md-4">
					<label>Fecha de fin:</label>
					<input class="form-control" type="date" name="fecha_fin" value="<?php echo set_value('fecha_fin') ?>" min="<?php echo(date('Y')-1) ?>-01-01" max="<?php echo(date('Y-m-d')) ?>">
					<?php echo form_error('fecha_fin'); ?>
				</div>
				<div class="form-group col-md-4">
					<label>Porcentaje de ISR:</label>
					<input class="form-control" type="text" name="isr" value="<?php echo set_value('isr') ?>">
					<?php echo form_error('isr'); ?>
				</div>
			</div>
			<div class="offset-4 col-4">
				<input class="btn btn-outline-success my-2 my-sm-0 margin_left_btn" type="submit" name="submit_generar" value="Generar">
				<input class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn" type="button" name="cancel" value="Limpiar" onClick="window.location='';" />
			</div>
		</form>
	</div>
	<hr>
<?php if (isset($registers)) {?>	
	<div class="table-responsive">
		<?php //si es aqui? ?>
		<form action="<?php echo base_url();?>daybook/pdf" method='post' class="">
		  <input type="submit" id="sendcont" name="sendcont" class="btn btn-outline-primary btn-pdf" value="Generar PDF">
		  <input type="text" id="id_empresa" name="id_empresa" value="<?php if(isset($id_empresa)) echo $id_empresa;?>" class="invisible">
		  <input type="text" id="titulo_pdf" name="titulo_pdf" value="<?php if(isset($titulo_pdf)) echo $titulo_pdf;?>" class="invisible">
		  <input type="text" id="contpdf" name="contpdf" class="invisible">
		</form>

		<table class="table">
			<thead>
				<tr>
					<th colspan="100%" class="text-center text-uppercase"><?php echo $exercise->nombre; ?></th>
				</tr>
				<tr>
					<td colspan="100%" class="text-center">Estado de resultados del <?php echo $fecha_inicio; ?> al <?php echo $fecha_fin; ?></td>
				</tr>	
			</thead>
			<tbody>
				<!-- VENTAS TOTALES - [DEVOLUCIONES SOBRE VENTAS+REBAJAS SOBRE VENTAS] = VENTAS NETAS -->
				<?php $ventas_netas=0; ?>
				<?php foreach ($registers as $register): ?>
					<?php $aux=0; if ($register->folio > 4100  && $register->folio<4200):?>
					<tr>
						<td><?php echo $register->cuenta;?></td>				
						<td></td>
						<td></td>
						<?php $aux=$register->haber-$register->debe;?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
						<td></td>								
					</tr>
					<?php $ventas_netas=$ventas_netas+$aux; ?>
				<?php endif ?>
				<?php endforeach ?>
				
				<?php $sub_vent=0; foreach ($registers as $register): ?>
					<?php $aux=0; if ($register->folio > 5100  && $register->folio<5200):?>
					<?php if ($register->folio != 5101): ?>
						<td></td>
						<td></td>								
					</tr>
					<?php endif ?>
					<tr>
						<td class="offset-1"><?php echo $register->cuenta;?></td>				
						<td></td>
						<?php $aux=$register->debe-$register->haber; ?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
					<?php $ventas_netas=$ventas_netas-$aux; $sub_vent=$sub_vent+$aux;?>
					<?php endif ?>
				<?php endforeach ?>

						<td class="text-right <?php if ($sub_vent<0){echo 'text-danger';} ?>">$ <?php echo number_format($sub_vent,2,'.',',');?> </td>
						<td></td>			
					</tr>
				<tr>
					<td class="font-weight-bold">Ventas Netas</td>
					<td></td>
					<td></td>
					<td></td>	
					<td class="text-right font-weight-bold	 <?php if ($ventas_netas<0){echo 'text-danger';} ?>">$ <?php echo number_format($ventas_netas,2,'.',',');?></td>	
				</tr>

				<!-- INVENTARIO INICIAL - [DEVOLUCIONES SOBRE VENTAS+REBAJAS SOBRE VENTAS] = VENTAS NETAS -->
				<?php $compras_totales=0;$inventario_inicial=0; ?>
				<?php foreach ($registers as $register): ?>
					<?php $aux=0; if ($register->folio == 5401):?>
						<tr>
							<td><?php echo $register->cuenta;?></td>				
							<td></td>
							<td></td>
							<?php $aux=$register->debe-$register->haber;$inventario_inicial=$aux;?>
							<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
							<td></td>								
						</tr>
						<?php $compras_totales=$compras_totales+$aux; ?>
					<?php endif ?>
				<?php endforeach ?>


				<?php $sub_comp=0; foreach ($registers as $register): ?>
					<?php $aux=0; if ($register->folio > 5200  && $register->folio<5300):?>
					<tr>
						<td class="offset-1"><?php echo $register->cuenta;?></td>				
						<?php $aux=$register->debe-$register->haber; ?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
						<td></td>
						<td></td>
						<td></td>								
					</tr>
					<?php $compras_totales=$compras_totales-$aux; $sub_comp=$sub_comp+$aux;?>
					<?php endif ?>
				<?php endforeach ?>

				<tr>
					<td class="font-weight-bold">Compras Totales</td>
					<td></td>
					<td class="text-right font-weight-bold	 <?php if ($sub_comp<0){echo 'text-danger';} ?>">$ <?php echo number_format($sub_comp,2,'.',',');?></td>	
					<td></td>
					<td></td>	
				</tr>



				<?php $sub_deb_comp=0; foreach ($registers as $register): ?>
					<?php $aux=0; if ($register->folio > 4200  && $register->folio<4400):?>
					<?php if ($register->folio != 4201): ?>
						<td></td>
						<td></td>
						<td></td>								
					</tr>
					<?php endif ?>
					<tr>
						<td class="offset-1"><?php echo $register->cuenta;?></td>				
						<?php $aux=$register->haber-$register->debe; ?>
						<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
					<?php $sub_deb_comp=$sub_deb_comp+$aux;?>
					<?php endif ?>
				<?php endforeach ?>
						<td class="text-right <?php if ($sub_deb_comp<0){echo 'text-danger';} ?>">$ <?php echo number_format($sub_deb_comp,2,'.',',');?></td>
						<td></td>
						<td></td>								
					</tr>

				<tr>
					<td class="font-weight-bold">Compras Netas</td>
					<td></td>
					<td></td>
					<?php $compras_totales=$sub_comp-$sub_deb_comp;?>
					<td class="text-right font-weight-bold	 <?php if ($compras_totales<0){echo 'text-danger';} ?>">$ <?php echo number_format($compras_totales,2,'.',',');?></td>
					<td></td>	
				</tr>

				<tr>
					<td class="font-weight-bold">Suma total de mercancias</td>
					<td></td>
					<?php $total_merca=$inventario_inicial+$compras_totales;?>
					<td></td>
					<td class="text-right font-weight-bold	 <?php if ($total_merca<0){echo 'text-danger';} ?>">$ <?php echo number_format($total_merca,2,'.',',');?></td>
					<td></td>	
				</tr>

				<?php $inventario_final=0; ?>
				<?php foreach ($registers as $register): ?>
					<?php $aux=0; if ($register->folio == 5402):?>
						<tr>
							<td><?php echo $register->cuenta;?></td>				
							<td></td>
							<td></td>
							<td></td>
							<?php $aux=$register->debe-$register->haber;?>
							<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
															
						</tr>
						<?php $inventario_final=$inventario_final+$aux; ?>
					<?php endif ?>
				<?php endforeach ?>
			
				<tr>
					<td class="font-weight-bold">Costo de lo vendido</td>
					<td></td>
					<?php $costo_vendido=$total_merca-$inventario_final;?>
					<td></td>
					<td class="text-right font-weight-bold	 <?php if ($costo_vendido<0){echo 'text-danger';} ?>">$ <?php echo number_format($costo_vendido,2,'.',',');?></td>
					<td></td>	
				</tr>

				<tr>
					<td class="font-weight-bold">Utilidad o Pérdida Bruta</td>
					<td></td>
					<?php $Utilidad=$ventas_netas-$costo_vendido;?>
					<td></td>
					<td></td>	
					<td class="text-right font-weight-bold	 <?php if ($Utilidad<0){echo 'text-danger';} ?>">$ <?php echo number_format($Utilidad,2,'.',',');?></td>
				</tr>

			</tbody>
		</table>
	</div>
<?php } ?>
</div>
