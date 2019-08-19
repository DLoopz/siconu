<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title">Agregar nueva cuenta </h3>
		</div>
		<hr class="line_sep">
		<?php
        
    ?>
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>professor/add_account">
				<div class="form-group">
          <label>Elige el tipo de la cuenta</label>
          <br>
        	<select  class="form-control" name="tipo" class="form-group"> 
            <option value="" >Selecciona una opción</option>
            	<?php foreach($view_tipo as $row){?>
            		<option  value="<?php echo $row->id_tipo;?>" >
                <?php echo $row->nombre;?></option><?php } ?>
          </select>
         <?php echo form_error('tipo');?>
        </div>
        <div class="form-group">
          <label>Elige la clasificacion de la cuenta</label>
          <select  class="form-control" name="clasificacion" class="form-group"> 
            <option value="" >Selecciona una opción</option>
            <?php foreach($view_clasificacion as $row){?>
              <option name="clasificacion" value="<?php echo $row->id_clasificacion;?>" >
              <?php echo $row->nombre;?></option><?php } ?>
          </select>
             <?php echo form_error('clasificacion');?>
        </div>
				<div class="form-group">
					Nombre de la cuenta:
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del grupo">
					<?php echo form_error('nombre'); ?>
				</div>
				<input type="submit" name="nombre_grupo" value="Agregar" class="btn btn-outline-success my-2 my-sm-0">
				<a href="<?php echo base_url()?>professor/account_catalog"> <button type="button" class="btn btn-outline-danger my-2 my-sm-0">Volver</button></a>
			</form>
		</div>
	</div>
	<hr>
</div>	