<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title">Agregar nueva cuenta </h3>
		</div>
		<hr class="line_sep">
		<?php
        //Si existen las sesiones flasdata que se muestren

        if($this->session->flashdata('correcto'))
            echo $this->session->flashdata('correcto');       
        if($this->session->flashdata('incorrecto'))
            echo $this->session->flashdata('incorrecto');
    ?>
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>professor/add_account">
				<div class="form-group">
	                <label>Elige el tipo de la cuenta</label>
	                <br>
	              	<select style="background: transparent; height: 38px;" class="col-md-12" name="tipo" class="form-group"> 
		                <option>Selecciona una opción</option>
		                	<?php foreach($view_tipo as $row){?>
		                <option  value="<?php echo $row->id_tipo;?>" >
		                    <?php echo $row->nombre;?></option><?php } ?>
	                </select>
	                  <div class="error">
	                  <?php echo form_error('tipo');?></div>
	            </div>
	            <div class="form-group">
	                <label>Elige la clasificacion de la cuenta</label>
	                <br>
	              	<select  class="col-md-12" name="clasificacion" class="form-group"> 
		                <option>Selecciona una opción</option>
		                	<?php foreach($view_clasificacion as $row){?>
		                <option  value="<?php echo $row->id_clasificacion;?>" >
		                    <?php echo $row->nombre;?></option><?php } ?>
	                </select>
	                  <div class="error">
	                  <?php echo form_error('clasificacion');?></div>
	            </div>
				<div class="form-group">
					Nombre de la cuenta:
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