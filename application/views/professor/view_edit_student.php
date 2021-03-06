<div class="container col-md-4">
  <div class="text-center">
    <h3>Editar Alumno</h3>
  </div>
  <hr class="line_sep">
  <?php
    if($this->session->flashdata('msg'))
      echo $this->session->flashdata('msg');
  ?>
  <div>
		<form method="post" action="<?php echo base_url() ?>professor/edit_student/<?php echo $student->id_usuario;?>/<?php echo $id_group;?>">
			<div class="form-group">
				<label>Nombre *</label>
				<input class="form-control" name="nombre" id="nombre" value="<?php echo $student->nombre ?>" autofocus >
				<?php echo form_error('nombre');?>
			</div>
			<div class="form-group">
				<label>Apellido Paterno *</label>
				<input class="form-control" name="ap_paterno" id="ap_paterno" value="<?php echo $student->apellido_paterno ?>" autofocus >
				<?php echo form_error('ap_paterno');?>
			</div>
			<div class="form-group">
				<label>Apellido Materno *</label>
				<input class="form-control" name="ap_materno" id="ap_materno" value="<?php echo $student->apellido_materno ?>" autofocus >
				<?php echo form_error('ap_materno');?>
			</div>
			<div class="form-group">
				<label>Matrícula *</label>
				<input class="form-control" name="matricula" id="matricula" value="<?php echo $student->matricula?>" autofocus >
				<?php echo form_error('matricula');?>
			</div>
			<div class="text-danger">
				<?php echo form_label('* Campos Obligatorios')?><br>
      </div>
      <hr>
			<br>
			<div class="panel-footer text-center">
				<input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0"value="Guardar" />
				<a class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn" href="<?php echo base_url() ?>professor/show_students/<?php echo $id_group;?>"> Volver </a>
				
			</div>
		</form>
  </div>
  	<hr>
</div>
