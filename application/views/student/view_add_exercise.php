<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title text-center">Agregar Nuevo Ejercicio </h3>
		</div>
		<hr class="line_sep"><br>
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>student/add_exercise/<?php echo $id_user;?>">
				<div class="form-group">
					Nombre del Ejercicio *
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del Ejercicio">
					<?php echo form_error('nombre'); ?>
				</div>
				<div class="form-group">
      		Procedimiento *
      		<select class="form-control" name="procedimiento">
      			<option selected disabled>Seleccione procedimiento</option>
      			<option value="1" <?php echo  set_select('procedimiento', 1, TRUE); ?>>Inventarios Perpetuos</option>
      			<option value="2" <?php echo  set_select('procedimiento', 2, TRUE); ?>>Analitico</option>
      			<option value="3" <?php echo  set_select('procedimiento', 3, TRUE); ?>>Mercancias Generales</option>
      		</select>
      		<?php echo form_error('procedimiento');?>
      	</div>
				<div class="text-danger">
        	<?php echo form_label('* Campo Obligatorio')?><br>
      	</div>
      	<hr>
      	<br>
      	<div class="panel-footer text-center">
      		<input type="submit" name="nombre_ejercicio" value="Guardar" class="btn btn-outline-success my-2 my-sm-0">
	      	<a href="<?php echo base_url()?>student"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn"">Volver</button></a>
				</div>
			</form>
		</div>
	</div>

</div>	