<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title">Agregar Nuevo Asiento </h3>
		</div>
		<hr class="line_sep">
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>daybook/add_entry/<?php echo $id_empresa;?>">
				<div class="form-group">
					Nombre del Asiento:
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del Asiento">
					<?php echo form_error('nombre'); ?>
				</div>
				<input type="submit" name="add_entry" value="Continuar" class="btn btn-outline-success my-2 my-sm-0">
				<a href="<?php echo base_url()?>student"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
			</form>
		</div>
	</div>
	<hr>
</div>	