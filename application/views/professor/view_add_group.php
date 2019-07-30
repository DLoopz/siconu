<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title">Agregar nuevo grupo </h3>
		</div>
		<hr class="line_sep">
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>professor/add_group">
				<div class="form-group">
					Nombre del grupo:
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del grupo">
					<?php echo form_error('nombre'); ?>
				</div>
				<input type="submit" name="nombre_grupo" value="Agregar" class="btn btn-outline-success my-2 my-sm-0">
				<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
			</form>
		</div>
	</div>
	<hr>
</div>	