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
  	
	<script>
		$(document).ready(function(){

		});
	</script>
	
	<nav>
	  <div class="nav nav-tabs" id="nav-tab" role="tablist">
	    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Agregar nuevo alumno</a>

	    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Agregar alumos por arhivo</a>
	  </div>
	</nav>

	<div class="tab-content" id="nav-tabContent">
	  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
	    <div class="container">
	    	<div><h3 class="text-center">Agregar nuevo alumno</h3></div>
			  <hr class="line_sep">
				<?php
					if($this->session->flashdata('msg'))
						echo $this->session->flashdata('msg');
				?>

	      <form role="form" method="post" id="individual" action="<?php echo base_url() ?>professor/add_student/<?php echo $id_grupo;?>">
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
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0"value="Guardar" />
						<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
					</div>
				</form>
	    </div>
	  </div>
	  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
	    <div class="container">
	    	<div><h3 class="text-center">Agregar lista de alumnos</h3></div>
			  <hr class="line_sep">
	      <form enctype="multipart/form-data" method="post" action="<?php echo base_url();?>professor/students_file/<?php echo $id_grupo; ?>">
				  <div class="form-group">
				  	<label for="">Archivo en formato .csv</label>
				  	<input class="form-control-file" type="file" name="file" id="file">
				  </div>
				  <div class="form-group">
				  	<input type="submit" name="archivo" class="btn btn-outline-success my-2 my-sm-0"value="Guardar" />
						<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
				  </div>
				</form>

	    </div>
	  </div>
	</div>

	
</div>



