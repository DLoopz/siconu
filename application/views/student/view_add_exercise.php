<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title">Agregar nuevo ejercicio </h3>
		</div>
		<hr class="line_sep">
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>student/add_exercise/<?php echo $id_user;?>">
				<div class="form-group">
					Nombre del ejercicio:
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del ejercicio">
					<?php echo form_error('nombre'); ?>
				</div>
				<input type="submit" name="nombre_ejercicio" value="Agregar" class="btn btn-outline-success my-2 my-sm-0">
				<a href="<?php echo base_url()?>student"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
			</form>
		</div>
	</div>
	<hr>
</div>	