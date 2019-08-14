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
				  		$i=0;$aux=0;foreach ($entries as $entry) {$i++;?>
					    <?php foreach ($registers as $register){
					    	if ($entry->id_asiento==$register->asiento_id){ ?>
					    		<tr>
							    	<td><?php if ($i!=$aux) {echo $i; $aux=$i;} ?></td>
							    	<td></td>
							    	<td><?php echo $register->folio; ?></td>
							    	<td>
							    		<div class="<?php if ($register->haber>0){ echo "offset-2";}?>">
							    			<?php echo $register->cuenta; ?></td>
							    		</div>
							    	<td><?php echo  number_format($register->parcial, 2, '.', ','); ?></td>
							    	<td><?php echo  number_format($register->debe, 2, '.', ','); $d=$d+$register->debe; ?></td>
							    	<td><?php echo  number_format($register->haber, 2, '.', ','); $h=$h+$register->haber;?></td>
							    	<td></td>
							    </tr>
					    <?php }
					     } ?>
					     <tr>
					    	<td></td>
					    	<td><?php echo $entry->fecha;?></td>
					    	<td></td>
					    	<th><?php echo $entry->concepto;?></th>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    	<td>
					    		<!--editar asiento-->
                  <a class="btn btn-outline-secondary" href="<?php echo base_url() ?>daybook/edit_entry/<?php echo $id_empresa;?>/<?php echo $entry->id_asiento;?>" title="Editar Asiento"><strong><em><i class="icon-edit-1"></i></em></strong></a>
					    		<!-- eliminar asiento -->
                  <a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_del_entry" onclick="eliminar(<?php echo $entry->id_asiento;?>)" title="Eliminar Asiento"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
                </td>
					    </tr>
				  	<?php } ?>
				    <tr class="<?php if ($d=$h) echo"table-success"; else echo "table-danger";?>">
				    	<td></td>
				    	<td></td>
				    	<td></td>
				    	<td class="float-right font-weight-bold">Total:</td>
				    	<td></td>
				    	<td><?php echo $d; ?></td>
				    	<td><?php echo $h; ?></td>
				    	<td></td>
				    </tr>
				  </tbody>
				</table>
			</div>
		</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_del_entry">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Asiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro?
            </div>
            <div class="modal-footer">
               <form method="post" action="<?php echo base_url() ?>daybook/delet_entry/<?php echo $id_empresa; ?>">
                   <input type="hidden" id="eliminar" name="id_entry"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" value="No">
                   <input type="submit" class="btn btn-outline-danger my-2 my-sm-0" value="Si">                   
               </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id)
    {
        $('#eliminar').val(id);
    }
</script>