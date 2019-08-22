<div class="container col-md-6">
  <div class="text-center"><h3>Agregar Alumno</h3></div>
  <hr class="line_sep">
	<?php
		if($this->session->flashdata('msg'))
			echo $this->session->flashdata('msg');
	?>
	<form role="form" method="post" action="<?php echo base_url() ?>professor/add_student/<?php echo $id_grupo;?>">
		<div class="form-group">
			<label>Nombre del alumno</label>
			<input class="form-control" placeholder="Nombre del alumno" name="nombre" id="nombre" value="<?php echo set_value('nombre');?>" autofocus >
			<?php echo form_error('nombre');?>	
		</div>
		<div class="form-group">
			<label>Apellido paterno</label>
			<input class="form-control" placeholder="Apellido paterno" name="ap_paterno" type="text" value="<?php echo set_value('ap_paterno');?>" >
			<?php echo form_error('ap_paterno');?>
		</div>
		<div>
			<label>Apellido materno</label>
			<input class="form-control" placeholder="Apellido materno" name="ap_materno" value="<?php echo set_value('ap_materno');?>" >
			<?php echo form_error('ap_materno');?>
		</div>
		<div class="form-group">
			<label>Matricula</label>
			<input class="form-control" placeholder="Matricula" name="matricula" value="<?php echo set_value('matricula');?>" >
			<?php echo form_error('matricula');?>
		</div>
		<div class="form-group">
			<label>Contraseña</label>
			<input class="form-control" placeholder="Contraseña" type="password" name="password" value="<?php echo set_value('password');?>" >
			<?php echo form_error('password');?>
		</div>
		<div class="form-group">
			<label>Confirmar contraseña</label>
			<input class="form-control" placeholder="Confirmar contraseña" name="conf_password" type="password" value="<?php echo set_value('conf_password');?>" >
		<?php echo form_error('conf_password');?>
		</div>
		<br>
		<div class="form-group  panel-footer text-center">
			<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
			<input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn"value="Guardar" />
		</div>
	</form>
	<br><br>
</div>