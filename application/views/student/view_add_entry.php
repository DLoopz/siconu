<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title text-center">Agregar Nuevo Asiento </h3>
		</div>
		<hr class="line_sep"><br>
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>daybook/add_entry/<?php echo $id_empresa;?>">
				<div class="form-group">
					Descripción del Asiento *
					<input type="text" name="concepto" class="form-control" placeholder="Descripción del Asiento" value="<?php echo set_value('concepto');?>">
					<?php echo form_error('concepto'); ?>
				</div>
				<div class="form-group">
          <label>Seleccione la fecha del Asiento *</label>
          <input type="date" name="fecha_asiento" class="form-control" value="<?php echo set_value('fecha_asiento');?>" min="<?php echo(date('Y')-1) ?>-01-01" max="<?php echo(date('Y-m-d')) ?>">
          <?php echo form_error('fecha_asiento'); ?>
        </div>
        <div class="form-check alert-warning text-center">
          <hr>
          <input type="checkbox" class="form-check-input" id="exampleCheck1" name="ajuste">
          <label class="form-check-label" for="exampleCheck1">Asiento de ajuste</label>
          <hr> 
        </div>
        <div class="text-danger">
        	<?php echo form_label('* Campos Obligatorios')?><br>
      	</div>
      	<hr>
        <br>
        <div class="panel-footer text-center">
					<input type="submit" name="add_entry" value="Continuar" class="btn btn-outline-success my-2 my-sm-0 ">
					<a href="<?php echo base_url()?>daybook/book/<?php echo $id_empresa; ?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
				</div>
			</form>
		</div>
	</div>
</div>		