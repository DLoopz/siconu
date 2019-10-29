<div class="container col-md-4" >
	<div class = "panel panel-primary col-md-offset-4">
		<div class = "panel-heading" >
			<h3 class = "panel-title text-center">Agregar Nueva Cuenta </h3>
		</div>
		<hr class="line_sep"><br>
		<div class = "panel-body">
			<form method="post"  action="<?php echo base_url();?>professor/add_account">
				<div class="form-group">
          <label>Elija el tipo de la cuenta *</label>
          <br>
        	<select  class="form-control" name="tipo" class="form-group" id="tipo" onchange="isCapital()"> 
            <option value="0" disabled selected>Seleccione una cuenta</option>
            	<?php foreach($view_tipo as $row){?>
            		<option  value="<?php echo $row->id_tipo;?>" >
                <?php echo $row->nombre;?></option><?php } ?>
          </select>
         <?php echo form_error('tipo');?>
        </div>
        <div class="form-group">
          <label>Elija la clasificación de la cuenta *</label>
          <select  class="form-control" name="clasificacion" class="form-group" id="clas"> 
            <option value="0" disabled selected>Seleccione una cuenta</option>
            <?php foreach($view_clasificacion as $row){?>
              <option name="clasificacion" value="<?php echo $row->id_clasificacion;?>" >
              <?php echo $row->nombre;?></option><?php } ?>
          </select>
             <?php echo form_error('clasificacion');?>
        </div>
				<div class="form-group">
					Nombre de la cuenta *
					<input type="text" name="nombre" class="form-control" placeholder="Nombre de la Cuenta">
					<?php echo form_error('nombre'); ?>
				</div>
        <div class="text-danger">
          <?php echo form_label('* Campos Obligatorios')?><br>
        </div>
        <hr>
        <br>
        <div class="panel-footer text-center">
  				<input type="submit" name="nombre_grupo" value="Agregar" class="btn btn-outline-success my-2 my-sm-0 ">
          <a href="<?php echo base_url()?>professor/account_catalog"> <button type="button" class="btn btn-outline-danger my-2 my-sm-0 margin_left_btn">Volver</button></a>
        </div>	
			</form>
		</div>
	</div>
</div>	
<script type="text/javascript">
  function isCapital(){
    if (document.getElementById("tipo").value==3){
      document.getElementById("clas").disabled=true;
    }
    else
    {
      document.getElementById("clas").disabled=false;
      console.log(document.getElementById("tipo").value);
    }
  }
</script>