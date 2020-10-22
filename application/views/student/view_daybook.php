 <?php
 	$equilibrado=0;$de=0;$ha=0;
 	foreach ($entries as $entry) {
	 	foreach ($registers as $r){
		 	$de=$de+$r->debe;
		 	$ha=$ha+$r->haber;
		}
		if ($de==$ha) {
			$equilibrado=$equilibrado+1;
		}else{
			$equilibrado=$equilibrado-1;
		}
	}
 //echo $equilibrado;?>
		<div class="container">
			<form action="<?php echo base_url();?>daybook/pdf" method='post' class="">
			  <button type="submit" id="sendcont" name="sendcont" class="btn btn-outline-primary btn-pdf" title="Generar PDF" value="1"><i class="icon-file-pdf"></i></button>
			  <input type="text" id="id_empresa" name="id_empresa" value="<?php if(isset($id_empresa)) echo $id_empresa;?>" class="invisible">
			  <input type="text" id="titulo_pdf" name="titulo_pdf" value="<?php if(isset($titulo_pdf)) echo $titulo_pdf;?>" class="invisible">
			  <input type="text" id="contpdf" name="contpdf" class="invisible">
			</form>
			<div><h3 class="text-center">Rayado Diario</h3></div>
			<?php
	      if($this->session->flashdata('msg'))
	        echo $this->session->flashdata('msg');
	    ?>
			<hr class="line_sep">
			<?php if ($this->session->userdata('rol')==3 and $exercise->estado!=1) { ?>
			<div class="row">
				<div class="col-6">
					<a href="<?php echo base_url();?>daybook/add_entry/<?php echo $id_empresa; ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Asiento Contable"><i class="icon-plus-2"></i></a>
				</div>
				<div class="col-6 text-right" <?php if($de==$ha and $de>0 and $equilibrado==count($entries)){echo '';}else{ echo "hidden";}?> >
					<a href="" class="btn btn-outline-danger my-2 my-sm-0" aria-label="Left Align" title="Cerrar Ejercicio" data-toggle="modal" data-target="#cerrarEmpresa"><i class="icon-cancel-circled"></i></a>
				</div>
			</div>
			<?php } ?>
			<br>
			<div class="table-responsive">
			  <table class="table" id="user-table">
				  <thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">Fecha</th>
				      <th scope="col">Folio</th>
				      <th scope="col">Cuenta</th>
				      <th scope="col">Parcial</th>
				      <th scope="col">Debe</th>
				      <th scope="col">Haber</th>
				      <?php if ($this->session->userdata('rol')==3 and $exercise->estado!=1) { ?>
				      <th scope="col">Opciones</th>
				    	<?php } ?>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  		$d=0;$h=0;
				  		$asiento_equilibrado=0;
				  		$i=0;$aux=0;foreach ($entries as $entry) {$i++;?>
					    <?php foreach ($registers as $register){
					    	if ($entry->id_asiento==$register->asiento_id){ ?>
					    		<tr>
							    	<td><?php if ($i!=$aux) {echo $i; $aux=$i;} ?></td>
							    	<td><?php echo $entry->fecha;?></td>
							    	<td><?php echo $register->folio; ?></td>
							    	<td>
							    		<div class="<?php if ($register->haber>0){ echo "offset-2";}?>">
							    			<?php echo $register->cuenta; ?></td>
							    		</div>
							    	<td class="text-right"> <?php //echo  number_format($register->parcial, 2, '.', ','); ?></td>
							    	<td class="text-right"><?php echo '$'. number_format($register->debe, 2, '.', ','); $d=$d+$register->debe; ?></td>
							    	<td class="text-right"><?php echo '$'. number_format($register->haber, 2, '.', ','); $h=$h+$register->haber;?></td>
							    	<td></td>
							    </tr>
					    <?php 
					    foreach ($partials as $partial) {
					    		if ($register->id_registro==$partial->registro_id) {?>
					    			<tr class="table-secondary">
						    		 	<td></td>
						    		 	<td></td>
						    		 	<td></td>
						    		 	<td><?php echo $partial->concepto;?></td>
						    		 	<td class="text-right"><?php echo '$'.number_format($partial->cantidad, 2, '.', ',');?></td>
						    		 	<td></td>
						    		 	<td></td>
						    		 	<td></td>
						    		</tr>
					    		<?php }	
					    		}
					    	 }
					     } ?>
					    <?php if ($d==$h) {
							    		$asiento_equilibrado=$asiento_equilibrado+1;
							    	}else{
							    		$asiento_equilibrado=$asiento_equilibrado-1;
							    	}?>
					     <tr>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    	<td class="font-weight-bold"><?php echo $entry->descripcion;?></td>
					    	<td></td>
					    	<td></td>
					    	<td></td>
					    	<?php if ($this->session->userdata('rol')==3 and $exercise->estado!=1) { ?>
					    	<td>
					    		
					    		<!--editar descripcion del asiento-->
                  <a class="btn btn-outline-success" href="<?php echo base_url() ?>daybook/edit_entry/<?php echo $id_empresa;?>/<?php echo $entry->id_asiento;?>" title="Editar Descripción del Asiento"><strong><em><i class="icon-pencil"></i></em></strong></a>
                  <!--editar asiento-->
                  <a class="btn btn-outline-secondary margin_left" href="<?php echo base_url() ?>daybook/register/<?php echo $id_empresa;?>/<?php echo $entry->id_asiento;?>/1" title="Editar Cuentas del Asiento"><strong><em><i class="icon-edit"></i></em></strong></a>
					    		<!-- eliminar asiento -->
                  <a class="btn btn-outline-danger margin_left" href="" data-toggle="modal" data-target="#modal_del_entry" onclick="eliminar(<?php echo $entry->id_asiento;?>)" title="Eliminar Asiento"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
               
                </td>
              	<?php } ?>
					    </tr>
				  	<?php } ?>
				    <tr class="<?php if ($d==$h and $d>0 and $asiento_equilibrado==count($entries)) echo"table-success"; else echo "table-danger";?>">
				    	<td></td>
				    	<td></td>
				    	<td></td>
				    	<td class="float-right font-weight-bold">Total:</td>
				    	<td></td>
				    	<td class="text-right"><?php echo '$'.number_format($d,2, '.', ',');?></td>
				    	<td class="text-right"><?php echo '$'.number_format($h,2, '.', ',');?></td>
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
            </div>
            <div class="modal-body">
            	¿Está seguro que desea eliminar el asiento?
            </div>
            <div class="modal-footer">
               <form method="post" action="<?php echo base_url() ?>daybook/delet_entry/<?php echo $id_empresa; ?>">
                   <input type="hidden" id="eliminar" name="id_entry"></input>
                   <input type="submit" class="btn btn-outline-danger my-2 my-sm-0 tam" value="Si">
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0  margin_left_modal" data-dismiss="modal" value="No">                   
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

	<!-- Modal para confirmación de cierre de sesión-->
<div class="modal fade" id="cerrarEmpresa" tabindex="-1" role="dialog" aria-labelledby="cerrarEmpresaLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Cerrar Ejercicio</h5>
			</div>
			<div class="modal-body">
				¿Está seguro que desea cerrar Ejercicio?
			</div>
			<div class="modal-footer">
				<a href="<?php echo base_url()?>student/close_exercise/<?php echo $id_empresa;?>"><span class="glyphicon glyphicon-user" data-toggle="modal" data-target="#cerrarSesion"></span><button class="btn btn-outline-primary my-2 my-sm-0" type="button">Si</button></a>
				<button type="button" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
