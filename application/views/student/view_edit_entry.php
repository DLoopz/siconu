<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title text-center">Modificar Descripción del Asiento </h3>
		</div>
		<hr class="line_sep">
		<div class = "panel-body">
		<?php if (isset($entry)) {?>
			<form method="post"  action="<?php echo base_url();?>daybook/edit_entry/<?php echo $id_empresa;?>/<?php echo $entry->id_asiento;?>">
				<div class="form-group">
					Descripción del Asiento *
					<input type="text" name="concepto" class="form-control" placeholder="Descripción del Asiento" value="<?php echo $entry->descripcion;?>">
					<?php echo form_error('concepto'); ?>
				</div>
				<div class="form-group">
          <label>Seleccione la fecha del Asiento *</label>
          <input type="date" name="fecha_asiento" class="form-control" value="<?php echo $entry->fecha;?>">
          <?php echo form_error('fecha_asiento'); ?>
        </div>
        <div class="text-danger">
        	<?php echo form_label('* Campo Obligatorio')?><br>
      	</div>
      	<hr><br>
        <div class="panel-footer text-center">
					<input type="submit" name="add_entry" value="Guardar" class="btn btn-outline-success my-2 my-sm-0 ">
					<a href="<?php echo base_url()?>daybook/book/<?php echo $id_empresa; ?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
				</div>
			</form>
		<?php } ?>
		</div>
	</div>
</div>		