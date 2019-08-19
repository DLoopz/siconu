<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title">Agregar Nuevo Asiento </h3>
		</div>
		<hr class="line_sep">
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>daybook/add_entry/<?php echo $id_empresa;?>">
				<div class="form-group">
					Descripcion del Asiento:
					<input type="text" name="concepto" class="form-control" placeholder="Descripcion del Asiento" value="<?php echo set_value('concepto');?>">
					<?php echo form_error('concepto'); ?>
				</div>
				<div class="form-group">
          <label>Seleccione la fecha del Asiento</label>
          <input type="date" name="fecha_asiento" class="form-control" value="<?php echo set_value('fecha_asiento');?>">
          <?php echo form_error('fecha_asiento'); ?>
        </div>
				<input type="submit" name="add_entry" value="Continuar" class="btn btn-outline-success my-2 my-sm-0">
				<a href="<?php echo base_url()?>daybook/book/<?php echo $id_empresa; ?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
			</form>
		</div>
	</div>
	<hr>
</div>		