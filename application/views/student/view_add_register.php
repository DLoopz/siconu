<div class="container col-md-6">
	<h3>Ingresar registro</h3>
	<hr class="line_sep">
	<form name="form_register" method="post" action="<?php echo base_url();?>daybook/add_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>">
		<div class="form-group">
			Cuenta
			<select class="form-control" name="cuenta">
				<?php foreach ($accounts as $account) {?>
		  		<option value="<?php echo $account->id_catalogo_usuario;?>"><?php echo $account->nombre;?></option>
		  	<?php } ?>
			</select>
			<?php echo form_error('cuenta') ?>
		</div>
		<div class="form-group">
			<div class="form-check">
    		<input type="checkbox" name="parcial" class="form-check-input" id="check_parcial" onclick="habilitar_parcial()">
    		<label class="form-check-label" for="check_parcial">Parcial</label>
  		</div>
  	</div>
  	<div class="form-group">
  		<a href="<?php echo base_url()?>student/daybook/add_entry_parcial" class="disabled"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" disabled name="agregar_parcial">Agregar entrada</button></a>
  	</div>
		<div class="form-group">
			Cantidad:
			<input type="text" name="cantidad" class="form-control">
			<?php echo form_error('cantidad') ?>
		</div>
		<div class="form-group">
			<div class="custom-control custom-radio custom-control-inline col-5">
			  <input type="radio" id="cargo" name="movimiento" class="custom-control-input" value="cargo" checked>
			  <label class="custom-control-label" for="cargo">Cargo</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline col-5">
			  <input type="radio" id="abono" name="movimiento" class="custom-control-input" value="abono">
			  <label class="custom-control-label" for="abono">Abono</label>
			</div>
		</div>
		<input type="submit" name="add_resgistry" value="Registrar" class="btn btn-outline-success my-2 my-sm-0">
		<a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
	</form>
</div>

<script type="text/javascript">
	function habilitar_parcial(){
    if(document.form_register.parcial.checked == true){
      document.form_register.agregar_parcial.disabled = false;
    }
    else{
      document.form_register.agregar_parcial.disabled = true;
    }
}
</script>