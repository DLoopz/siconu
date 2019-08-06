	<!--body-->
		<div class="container">
			<div><h3>Rayado Diario</h3></div>
			<hr class="line_sep">
			<a href="<?php echo base_url();?>daybook/add_entry/<?php echo $id_empresa; ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Asiento contable"><i class="icon-plus-2"></i></a>
			<div class="table-responsive-md">
			  <table class="table table-hover">
				  <thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">Fecha</th>
				      <th scope="col">Folio</th>
				      <th scope="col">Cuenta</th>
				      <th scope="col">Parcial</th>
				      <th scope="col">Debe</th>
				      <th scope="col">Haber</th>
				    </tr>
				  </thead>
				  <tbody>
				    <?php $i=1; foreach ($entries as $entry) {?>
				    <tr>
				    	<td><?php echo $i;?></td>
				    	<td><?php echo $entry->fecha;?></td>
				    	<td>------------</td>
				    	<td><?php echo $entry->concepto;?></td>
				    	<td></td>
				    	<td></td>
				    	<td></td>
				    </tr>
				  	<?php $i++;} ?>
				    <tr>
				    	<td colspan="3"></td>
				    	<th>SUMAS</th>
				    	<td></td>
				    	<td></td>
				    	<td></td>
				    </tr>
				  </tbody>
				</table>
			</div>
		</div>