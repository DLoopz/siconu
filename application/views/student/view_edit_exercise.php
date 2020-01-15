<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title text-center">Editar Ejercicio </h3>
		</div>
		<hr class="line_sep"><br>
		<div class = "panel-body">
			<?php if (isset($exercise)) {?>
			<form method="post"  action="<?php echo base_url();?>student/edit_exercise/<?php echo $exercise->id_empresa;?>">
				<div class="form-group">
					Nombre del Ejercicio *
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del Ejercicio" value="<?php echo $exercise->nombre;?>">
					<?php echo form_error('nombre'); ?>
				</div>
				<div class="form-group">
      		Procedimiento *
      		<select class="form-control" name="procedimiento">
      			<option value="0" disabled>Seleccione procedimiento</option>
      			<option value="1" <?php if($exercise->procedimiento==1) { echo 'Selected';} ?> >Inventarios Perpetuos</option>
      			<option value="2" <?php if ($exercise->procedimiento==2) { echo 'Selected';} ?>>Analítico</option>
      			<option value="3" <?php if ($exercise->procedimiento==3) { echo 'Selected';} ?>>Mercancias Generales</option>
      		</select>
      		<?php echo form_error('procedimiento');?>
      	</div>
				<div class="text-danger">
        	<?php echo form_label('* Campos Obligatorios')?><br>
      	</div>
      	<hr><br>
				<div class="panel-footer text-center">
					<input type="submit" name="edit_exercise" value="Agregar" class="btn btn-outline-success my-2 my-sm-0">
					<a href="<?php echo base_url()?>student"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
				</div>
			</form>
		<?php } ?>
		</div>
	</div>
</div>	