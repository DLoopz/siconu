<div class="container">
	<div class="text-center"><h3>Estado de Resultados</h3></div>
	<hr class="line_sep">
	<div class="">
		<form >
			<div class="row">
				<div class="form-group col-md-6">
					<label>Fecha de inicio:</label>
					<input class="form-control" type="date" name="fecha_inicio" id="fch">
				</div>
				<div class="form-group col-md-6">
					<label>Fecha de fin:</label>
					<input class="form-control" type="date" name="fecha_fin">
				</div>
			</div>
			<input class="btn btn-outline-success my-2 my-sm-0 margin_left_btn" type="submit" name="submit_generar" value="Generar" onchange="printfecha();">
			<input class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn" type="button" name="cancel" value="cancel" onClick="window.location='';" />
</form>
<hr>
<script type="text/javascript">
	function printfecha(){
		console.log(getElementsByTagName('fch').value);
	}
</script>

		</form>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th colspan="100%" class="text-center text-uppercase"><?php echo $exercise->nombre; ?></th>
			</tr>
			<tr>
				<td colspan="100%" class="text-center">Estado de resultados del 1 de enero al 31 de diciembre del</td>
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
		<?php foreach ($registers as $register): ?>
			<?php $aux=0; if ($register->folio > 5100  && $register->folio<5200):?>
			<tr>
				<td><?php echo $register->cuenta;?></td>				
				<td></td>
				<td></td>
				<?php $aux=$register->debe-$register->haber; ?>
				<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
				<td></td>								
			</tr>
			<?php $ventas_netas=$ventas_netas-$aux; ?>
			<?php endif ?>
		<?php endforeach ?>
		<tr>
			<td class="font-italic">Ventas Totales</td>
			<td></td>
			<td></td>
			<td></td>	
			<td class="text-right <?php if ($ventas_netas<0){echo 'text-danger';} ?>">$ <?php echo number_format($ventas_netas,2,'.',',');?></td>	
		</tr>

		<!-- COMPRAS + GASTOS SOBRE COMPRAS = COMPRAS TOTALES -->
		<?php $compras=0; ?>
		<?php foreach ($registers as $register): ?>
			<?php $aux=0; if ($register->folio > 5200  && $register->folio<5300):?>
			<tr>
				<td><?php echo $register->cuenta;?></td>				
				<td></td>
				<td></td>
				<?php $aux=$register->debe-$register->haber; ?>
				<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
				<td></td>								
			</tr>
			<?php $compras=$compras+$aux; ?>
			<?php endif ?>
		<?php endforeach ?>
		<tr>
			<td class="font-italic">Compras Totales</td>
			<td></td>
			<td></td>
			<td></td>	
			<td class="text-right <?php if ($compras<0){echo 'text-danger';} ?>">$ <?php echo number_format($compras,2,'.',',');?></td>	
		</tr>

		<!-- COMPRAS TOTALES - [DESCUENTOS SOBRE COMPRAS+REBAJAS SOBRE COMPRA] = COMPRAS NETAS -->
		<?php $compras_netas=$compras; ?>
		<?php foreach ($registers as $register): ?>
			<?php $aux=0; if ($register->folio > 4300  && $register->folio<4400):?>
			<tr>
				<td><?php echo $register->cuenta;?></td>				
				<td></td>
				<td></td>
				<?php $aux=$register->debe-$register->haber; ?>
				<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
				<td></td>								
			</tr>
			<?php $compras_netas=$compras_netas-$aux; ?>
			<?php endif ?>
		<?php endforeach ?>
		<tr>
			<td class="font-italic">Compras Netas</td>
			<td></td>
			<td></td>
			<td></td>	
			<td class="text-right <?php if ($compras_netas<0){echo 'text-danger';} ?>">$ <?php echo number_format($compras_netas,2,'.',',');?></td>	
		</tr>

		<!-- MERCANCIA DISPONIBLE + NVENTARIO FINAL = COSTO DE VENTA -->
		<?php $costo_venta=0; ?>
		<?php foreach ($registers as $register): ?>
			<?php $aux=0; if ($register->folio > 4300  && $register->folio < 4400):?>
			<tr>
				<td><?php echo $register->cuenta;?></td>				
				<td></td>
				<td></td>
				<?php $aux=$register->debe-$register->haber; ?>
				<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
				<td></td>								
			</tr>
			<?php $compras_netas=$compras_netas-$aux; ?>
			<?php endif ?>
		<?php endforeach ?>
		<tr>
			<td class="font-italic">Costo de venta</td>
			<td></td>
			<td></td>
			<td></td>	
			<td class="text-right <?php //if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($costo_venta,2,'.',',');?></td>	
		</tr>
		<!-- VENTAS NETAS - COSTO DE VENTAS = UTILIDAD O PERDIDA BRUTA  [ Si las ventas netas son > que el costo de ventas el resultado sera utilidad bruta. Si las ventas netas son <  que el costo de ventas el resultado sera pérdida bruta] -->
		<?php $bruta=0; ?>
		<tr>
			<td class="font-italic"><?php if(1){$estado="Utilidad";}else{$estado="Perdida";} echo $estado?> Bruta</td>
			<td></td>
			<td></td>
			<td></td>	
			<td class="text-right <?php //if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($bruta,2,'.',',');?></td>	
		</tr>
		<!-- UTILIDAD O PERDIDA BRUTA -/+ [GASTOS DE OPERACIÓN + GASTOS VENTA Y ADMINISTRACIÓN ] = UTILIDAD O PERDIDA DE LA OPERACION-->
		<?php $operacion=0; ?>
		<tr>
			<td class="font-italic"><?php echo "$estado";?> de la Operacion</td>
			<td></td>
			<td></td>
			<td></td>	
			<td class="text-right <?php //if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($operacion,2,'.',',');?></td>	
		</tr>
		<!-- UTILIDAD O PERDIDA DE LA OPERACIÓN +/- NGRESOS DE NO OPERACIÓN PRODUCTOS FINANCIEROS Y OTROS INGRESOS GASTOS DE NO OPERACIÓN GASTOS FINANCIERIOS Y OTROS GASTOS = UTILIDAD ANTES DE RESERVA LEGAL E IMPUESTO SOBRE LA RENTA O PERDIDA DEL EJERCICIO -->
		<?php $utilidad=0; ?>
		<tr>
			<td class="font-italic">Compras Totales</td>
			<td></td>
			<td></td>
			<td></td>	
			<td class="text-right <?php //if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($utilidad,2,'.',',');?></td>	
		</tr>
		</tbody>
	</table>
</div>