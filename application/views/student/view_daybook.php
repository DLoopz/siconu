	<!--body-->
		<div class="container">
			<div><h3>Rayado Diario</h3></div>
			<hr class="line_sep">
			<div class="row">
				<div class="col-6">
						<a href="<?php echo base_url();?>daybook/add_entry/<?php echo $id_empresa; ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Asiento contable"><i class="icon-plus-2"></i></a>
				</div>
				<div class="col-6 text-right">
					<a href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Cerrar Empresa"><i class="icon-home-1"></i></a>
				</div>
			</div>
			<br>
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
				      <th scope="col">opciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  		$d=0;$h=0;
				  		$i=0;foreach ($entries as $entry) {$i++;?>
				  		<tr>
					    	<td><?php echo $i;?></td>
					    	<td><?php echo $entry->fecha;?></td>
					    	<td></td>
					    	<th><?php echo $entry->concepto;?></th>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    </tr>
					    <?php foreach ($registers as $register){
					    	if ($entry->id_asiento==$register->asiento_id){ ?>
					    		<tr>
							    	<td></td>
							    	<td></td>
							    	<td><?php echo $register->folio; ?></td>
							    	<td><?php echo $register->cuenta; ?></td>
							    	<td><?php echo $register->parcial; ?></td>
							    	<td><?php echo $register->debe; $d=$d+$register->debe; ?></td>
							    	<td><?php echo $register->haber; $h=$h+$register->haber;?></td>
							    </tr>
					    <?php }
					     } ?>	
				  	<?php } ?>
				    <tr class="<?php if ($d=$h) echo"table-success"; else echo "table-danger";?>">
				    	<td colspan="3"></td>
				    	<td class="float-right font-weight-bold">Total:</td>
				    	<td></td>
				    	<td><?php echo $d; ?></td>
				    	<td><?php echo $h; ?></td>
				    </tr>
				  </tbody>
				</table>
			</div>
		</div>