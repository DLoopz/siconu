<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class ="text-center">Agregar Nuevo Grupo </h3>
		</div>
		<hr class="line_sep">
		<br>
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>professor/add_group">
				<div class="form-group">
					Nombre del Grupo *
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del Grupo">
					<?php echo form_error('nombre'); ?>
				</div>
				<div class="text-danger">
        	<?php echo form_label('* Campos Obligatorios')?><br>
      	</div>
      	<br>
      	<div class="panel-footer text-center">
      		<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 ">Volver</button></a>
					<input type="submit" name="nombre_grupo" value="Agregar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">
				</div>
			</form>
		</div>
	</div>
	<hr>
</div>	