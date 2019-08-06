<div class="container col-md-6">
	<h3>Ingresar registro</h3>
	<hr class="line_sep">
	<form>
		<div class="form-group">
			Cuenta
			<select class="form-control">
				<?php foreach ($accounts as $account) {?>
		  		<option value="<?php echo $account->nombre;?>"><?php echo $account->nombre;?></option>
		  	<?php } ?>
			</select>
		</div>
		<div class="form-group">
			<div class="custom-control custom-radio custom-control-inline col-5">
			  <input type="radio" id="metodo1" name="metodo" class="custom-control-input" checked>
			  <label class="custom-control-label" for="metodo1">Normal</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline col-5">
			  <input type="radio" id="metodo2" name="metodo" class="custom-control-input" disabled>
			  <label class="custom-control-label" for="metodo2">Parcial</label>
			</div>
		</div>
		<div class="form-group col-5">
			Cantidad:
			<input type="text" name="cantidad" class="form-control">
		</div>
		<div class="form-group">
			<div class="custom-control custom-radio custom-control-inline col-5">
			  <input type="radio" id="movimiento1" name="movimiento" class="custom-control-input" checked>
			  <label class="custom-control-label" for="movimiento1">Cargo</label>
			</div>
			<div class="custom-control custom-radio custom-control-inline col-5">
			  <input type="radio" id="movimiento2" name="movimiento" class="custom-control-input">
			  <label class="custom-control-label" for="movimiento2">Abono</label>
			</div>
		</div>
	</form>
</div>