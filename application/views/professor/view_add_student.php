<div class="container col-md-4">
  
	<nav>
	  <div class="nav nav-tabs" id="nav-tab" role="tablist">
	    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Agregar Alumno</a>

	    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Agregar Alumnos por Archivo</a>
	  </div>
	</nav>

	<div class="tab-content" id="nav-tabContent">
	  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
	    <div class="container">
	    	<br>
	    	<div><h3 class="text-center">Agregar Alumno</h3></div>
			  <hr class="line_sep">
				<?php
					if($this->session->flashdata('msg'))
						echo $this->session->flashdata('msg');
				?>

	      <form role="form" method="post" id="individual" action="<?php echo base_url() ?>professor/add_student/<?php echo $id_grupo;?>">
					<div class="form-group">
						<label>Nombre del Alumno *</label>
						<input class="form-control" placeholder="Nombre del Alumno" name="nombre" id="nombre" value="<?php echo set_value('nombre');?>" autofocus >
						<?php echo form_error('nombre');?>	
					</div>
					<div class="form-group">
						<label>Apellido Paterno *</label>
						<input class="form-control" placeholder="Apellido Paterno" name="ap_paterno" type="text" value="<?php echo set_value('ap_paterno');?>" >
						<?php echo form_error('ap_paterno');?>
					</div>
					<div>
						<label>Apellido Materno *</label>
						<input class="form-control" placeholder="Apellido Materno" name="ap_materno" value="<?php echo set_value('ap_materno');?>" >
						<?php echo form_error('ap_materno');?>
					</div>
					<div class="form-group">
						<label>Matrícula *</label>
						<input class="form-control" placeholder="Matrícula" name="matricula" value="<?php echo set_value('matricula');?>" >
						<?php echo form_error('matricula');?>
					</div>
					<div class="text-danger">
        		<?php echo form_label('* Campos Obligatorios')?><br>
      		</div>
      		<hr>
					<br>
					<div class="panel-footer text-center">
						<input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0 "value="Agregar" />
						<a href="<?php echo base_url()?>professor/show_students/<?php echo $id_grupo;?>" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn tam_btn">Volver</a>
					</div>
				</form>
				<br>
	    </div>
	  </div>


	  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
	    <div class="container">
	    	<br>
	    	<div><h3 class="text-center">Agregar Lista de Alumnos</h3></div>
			  <hr class="line_sep">
			  <?php
					if($this->session->flashdata('msg'))
						echo $this->session->flashdata('msg');
				?>
	      <form enctype="multipart/form-data" method="post" action="<?php echo base_url();?>professor/students_file/<?php echo $id_grupo; ?>"> 
	      	<br>
	      	<div class="form-group">
	      		<label for="plantilla">
	      			<a href="<?php echo base_url();?>source/downloads/Plantilla.csv">Descargar la plantilla para el archivo CSV</a>
	      		</label>
	      	</div>

				  <!--div class="form-group">
				  	<label for="">Archivo en formato .csv</label>
				  	<input class="form-control-file" type="file" name="file" id="file">
				  </div-->

				  <div class="input-group">
				    <div class="input-group-prepend">
				      <span class="input-group-text" id="">Subir</span>
				    </div>
				    <div class="custom-file">
				      <input type="file" class="custom-file-input" name="file" id="file"
				        aria-describedby="">
				      <label class="custom-file-label" for="" id="nombre_f">Elegir Archivo .csv</label>
				    </div>
				  </div>


				  <br><hr><br>
				  <div class="panel-footer text-center">
				  	<input type="submit" name="archivo" class="btn btn-outline-success my-2 my-sm-0 "value="Agregar" />
				  	<a href="<?php echo base_url()?>professor/show_students/<?php echo $id_grupo;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
				  </div>
				</form>

	    </div>
	  </div>

	</div>

	
</div>



