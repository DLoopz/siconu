<div class="container">
	<h3>Creación de catálogo de cuentas</h3>
	<hr class="line_sep">
	<p class="text-justify">A continuación le presentamos algunas cuentas que podrían ser útiles al crear su catálogo.<br>
	Selecione las cuentas que desee incluir, de lo contrario pulse en crear, posteriormente podrá crear cuentas personalizadas.</p>
	<div class="">
		<?php
        if($this->session->flashdata('msg'))
            echo $this->session->flashdata('msg');
        ?>

        <?php //clasificacion_id ?>
		<form method="post" action="<?php echo base_url();?>professor/create_account_catalog" class="col-12">
			<?php foreach ($types as $type) {?>
				<h3><?php echo $type->nombre; ?></h3>
				<hr class="line_sep">
				<div class="row">
				<?php foreach ($clasifications as $cla) {?>
					<div class="col-4 espacio">
					<h4><?php echo $cla->nombre; ?></h4>
						<?php foreach ($accounts as $account){
							if ($type->id_tipo==$account->tipo_id && $cla->id_clasificacion==$account->clasificacion_id) {?>
								<div class="form-check">
          					<input class="form-check-input" type="checkbox" name="cuenta<?php echo $account->id_catalogo_estandar;?>" value="<?php echo $account->id_catalogo_estandar;?>">
          						<?php echo $account->nombre;?>
        					</div>
				<?php	}
						}?>
						</div>
				<?php } ?>
				</div>
			<?php } ?>

		<div class="col-4 offset-4">
			<input type="submit" name="crear_catalogo" value="Crear" class="btn btn-outline-success my-2 my-sm-0">
			<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
		</div>
		</form>
	</div>
</div>