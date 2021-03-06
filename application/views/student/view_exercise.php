<div class="container col-md-8">
	<div><h3 class="text-center">Ejercicios</h3></div>
	<hr class="line_sep">
	<?php
	  if($this->session->flashdata('msg'))
	    echo $this->session->flashdata('msg');
	?>

	<?php if ($this->session->userdata('rol')==3) { ?>
	<a href="<?php echo base_url();?>student/add_exercise" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Ejercicio"><i class="icon-plus-2"></i></a>
	<?php }else{ ?>
		<a href="<?php echo base_url() ?>professor/show_students/<?php echo $this->session->userdata('grupo') ?> " class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Volver a la Lista de Grupos"><i class="icon-left-big"></i></a>
	<?php } ?>
	<br><br>
	<div class="table-responsive">
		<table class="table table-md table-hover" id="user-table">
	    <thead>
	      <tr>
	      	<th>No.</th>
	        <th>Nombre del ejercicio</th>
	        <th>Estatus</th>
	        <th>Acciones</th>
	        <th>Procedimiento</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php $i=0; foreach ($exercises as $exercise){$i=$i+1?>
	        <tr>
	        	<td>
	            <?php echo $i;?>
	          </td>
	          <td><?php echo $exercise->nombre;?></td>
	          <td><?php if (!$exercise->estado){ echo '<div class="text-success">Abierto</div>';} else{ echo '<div class="text-danger">Cerrado</div>';}?></td>
	          <td><?php if($exercise->procedimiento==1){echo "Inventarios perpetuos";}if($exercise->procedimiento==2){echo "Analitico";}if($exercise->procedimiento==3){echo "Mercancias generales";}?></td>
	          <td>
	          	<?php if ($this->session->userdata('rol')==3) { ?>
          		<!-- editar ejercicio -->
              <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url() ?>student/edit_exercise/<?php echo $exercise->id_empresa;?>" title="Editar Ejercicio"><strong><em><i class="icon-edit"></i></em></strong></a>
	            <!-- eliminar ejercicio -->
              <a class="btn btn-outline-danger my-2 my-sm-0" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $exercise->id_empresa;?>)" href="" title="Eliminar Ejercicio"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
              <?php } ?>
              <!--editar password ejercicio-->
	            <a class="btn btn-outline-info my-2 my-sm-0 no-editar" href="<?php echo base_url() ?>daybook/book/<?php echo $exercise->id_empresa;?>" title="Administrar Ejercicio"><strong><em><i class="icon-eye"></i></em></strong></a>
	          </td>
	        </tr>
	      <?php } ?>
	    </tbody>
	  </table>
	</div>
</div>
	<?php if (!isset($exercise)){?>
		<div class="text-center">
			<p class="text-danger">No se han registrado ejercicios</p>
		</div>
	<?php } ?>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-tittle" id="modalTittle">Eliminar Ejercicio</h5>
				</div>
				<div class="modal-body">
					¿Está seguro de eliminar el ejercicio?
				</div>
				<div class="modal-footer">
					<form method="POST" action="<?php echo base_url() ?>student/del_exercise">
						<input type="hidden" id="eliminar" name="id_empresa"></input>
						<input type="submit" class="btn btn-outline-primary my-2 my-sm-0 tam" value="Si">
						<input type="reset" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal" data-dismiss="modal" value="No">           	
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