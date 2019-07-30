<div class="container">
	<h3>Creacion de catalogo de cuentas</h3>
	<hr class="line_sep">
	<p class="text-justify">A continuacion le presentamos algunas cuentas que podrian serle utilez al crear su catalogo.<br>
	Selecione las cuentas que desee inlcuir, de lo contrario pulse en crear, posteriormente podra crear cuentas personalizadas.</p>
	<div class="row">
		<form method="post" action="<?php echo base_url();?>professor/create_account_catalog" class="col-12">
			<div class="row">
			<?php $i=0; foreach ($accounts as $account){
				if ($i%10==0){
					if (!$i==0) {?>
						</div>
					<?php } ?>	
					<div class="col-4">
				<?php } ?>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="cuenta<?php echo $account->id_catalogo_estandar;?>" value="<?php echo $account->id_catalogo_estandar;?>">
					<?php echo $account->nombre;?>
				</div>
			<?php $i++; } ?>
		</div>
		<div class="col-4 offset-4">
			<input type="submit" name="crear_catalogo" value="Crear" class="btn btn-outline-success my-2 my-sm-0">
			<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
		</div>
		</form>
	</div>
</div>