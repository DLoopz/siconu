<div class="container">
	<div class="table-responsive">
		<?php //si es aqui? ?>
		<form action="<?php echo base_url();?>daybook/pdf" method='post' class="">
		  <button type="submit" id="sendcont" name="sendcont" class="btn btn-outline-primary btn-pdf" title="Generar PDF" value="1"><i class="icon-file-pdf"></i></button>
		  <input type="text" id="id_empresa" name="id_empresa" value="<?php if(isset($id_empresa)) echo $id_empresa;?>" class="invisible">
		  <input type="text" id="titulo_pdf" name="titulo_pdf" value="<?php if(isset($titulo_pdf)) echo $titulo_pdf;?>" class="invisible">
		  <input type="text" id="contpdf" name="contpdf" class="invisible">
		</form>
		<table class="table">
			<thead>

			</thead>
			<?php 
				$ventas_totales=0;
				$devolucion_venta=0;
				$descuento_venta=0;
				$inventario_inicial=0;
				$inventario_final=0;
				$compras=0;
				$gastos_compras=0;
				$devolucion_compra=0;
				$descuento_compra=0; 
			?>
			<?php foreach ($registers as $register) {
				//ventas totales
				if ($register->concepto=="Ventas"){
					$ventas_totales=$register->debe-$register->haber; 				
				}
				//devolucines sobre ventas
				if ($register->concepto=="Devoluciones sobre ventas"){
					$devolucion_venta=$register->debe-$register->haber; 				
				}
				//descuentos sobre ventas
				if ($register->concepto=="Descuentos sobre ventas"){
					$descuento_venta=$register->debe-$register->haber; 				
				}
				//ventas netas
				if ($register->concepto=="Inventario inicial"){
					$inventario_inicial=$register->debe-$register->haber; 				
				}
				//descuentos sobre compra
				if ($register->concepto=="Compras"){
					$compras=$register->debe-$register->haber; 				
				}
				//gastos sobre compra
				if ($register->concepto=="Gastos sobre compra"){
					$gastos_compras=$register->debe-$register->haber; 				
				}
				//devolucines sobre compra
				if ($register->concepto=="Devoluciones sobre compra"){
					$devolucion_compra=$register->debe-$register->haber; 				
				}
				//descuentos sobre compra
				if ($register->concepto=="Descuentos sobre compra"){
					$descuento_compra=$register->debe-$register->haber; 				
				}
				//inventario final
				if ($register->concepto=="Inventario final"){
					$inventario_inicial=$register->debe-$register->haber; 				
				}

			} ?>
			<tbody>
					<tr>
						<td>Ventas Totales</td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($ventas_totales,2,'.',',');?></td>
						<td></td>
					</tr>	
					<tr>
						<td>Devoluciones sobre venta</td>
						<td></td>
						<td>$<?php echo number_format($devolucion_venta,2,'.',',');?></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Descuentos sobre venta</td>
						<td></td>
						<td>$<?php echo number_format($descuento_venta,2,'.',',');?></td>
						<?php $op_ventas=$descuento_venta+$devolucion_venta;?>
						<td>$<?php echo number_format($op_ventas,2,'.',',');?></td>
						<td></td>
					</tr>
					<?php $ventas_netas=$ventas_totales-$op_ventas;?>
					<tr>
						<td class="bold">Ventas Netas</td>
						<td></td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($ventas_netas,2,'.',',');?></td>
					</tr>	
					<tr>
						<td>Inventario Inicial</td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($inventario_inicial,2,'.',',');?></td>
						<td></td>
					</tr>
					<tr>
						<td>Compras</td>
						<td>$<?php echo number_format($compras,2,'.',',');?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Gastos de compra</td>
						<td>$<?php echo number_format($gastos_compras,2,'.',',');?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php $compras_totales=$gastos_compras+$compras;?>
					<tr>
						<td>Compras Totales</td>
						<td></td>
						<td>$<?php echo number_format($compras_totales,2,'.',',');?></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Devoluciones sobre compras</td>
						<td>$<?php echo number_format($devolucion_compra,2,'.',',');?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>Descuentos sobre compras</td>
						<td>$<?php echo number_format($descuento_compra,2,'.',',');?></td>
						<?php $op_compras=$descuento_compra+$devolucion_compra;?>
						<td>$<?php echo number_format($op_compras,2,'.',',');?></td>
						<td></td>
						<td></td>
					</tr>
					<?php $compras_netas=$compras_totales-$op_compras; ?>
					<tr>
						<td>Compras Netas</td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($compras_netas,2,'.',',');?></td>
						<td></td>
					</tr>
					<?php $sum_mercancias=$inventario_inicial+$compras_netas; ?>
					<tr>
						<td>Suma total de mercancias</td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($sum_mercancias,2,'.',',');?></td>
						<td></td>
					</tr>
					<tr>
						<td>Inventario Final</td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($inventario_final,2,'.',',');?></td>
						<td></td>
					</tr>
					<?php $costo_vendido=$sum_mercancias-$inventario_final; ?>
					<tr>
						<td>Costo de lo vendido</td>
						<td></td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($costo_vendido,2,'.',',');?></td>
					</tr>
					<?php $utilidad=$ventas_netas-$costo_vendido; ?>
					<tr>
						<td>Utilidad/perdida bruta</td>
						<td></td>
						<td></td>
						<td></td>
						<td>$<?php echo number_format($utilidad,2,'.',',');?></td>
					</tr>
			</tbody>
		</table>
	</div>
</div>
