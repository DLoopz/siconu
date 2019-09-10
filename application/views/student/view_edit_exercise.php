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
				<div class="text-danger">
        	<?php echo form_label('* Campos Obligatorios')?><br>
      	</div>
      	<br>
				<div class="panel-footer text-center">
					<a href="<?php echo base_url()?>student"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
					<input type="submit" name="edit_exercise" value="Agregar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">
				</div>
			</form>
		<?php } ?>
		</div>
	</div>
	<hr>
</div>	