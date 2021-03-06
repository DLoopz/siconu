<div class="container">
	<a href="<?php echo base_url('professor'); ?>" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Volver"><i class="icon-left-big"></i></a>
	<h3 class="text-center">Creación de catálogo de cuentas</h3>
	<hr class="line_sep">
	<p class="text-center alert alert-warning">A continuación le presentamos algunas cuentas que podrían ser útiles al crear su catálogo.<br>
	Seleccione al menos una cuenta y pulse en crear para agregar sus propias cuentas.</p>
	<div class="">
		<?php
      if($this->session->flashdata('msg'))
          echo $this->session->flashdata('msg');
    ?>

    <?php //clasificacion_id ?>
		<form method="post" action="<?php echo base_url();?>professor/create_account_catalog" class="col-12">
			
			<hr class="line_sep">
			<div class="checkbox">
				<input class="checkitem" type="checkbox" id="checkall" name="checkall">
				<label class="form-check-label" for="checkall">Seleccionar todas las cuentas</label>
			</div>
			<hr class="line_sep">

			<?php foreach ($types as $type) {?>
				<?php if ($type->id_tipo<4): ?>
					<h3 class="text-center"><?php echo $type->nombre; ?></h3>
					<hr class="line_sep">
					<div class="row">
					<?php foreach ($clasifications as $cla) {?>
						<div class="col-6 espacio">
							<?php if ($type->id_tipo!=3){?>
								<h4 ><?php echo $cla->nombre; ?></h4>
							<?php } ?>
						
							<?php foreach ($accounts as $account){
								if ($type->id_tipo==$account->tipo_id && $cla->id_clasificacion==$account->clasificacion_id) {?>
									<div class="checkbox">
					  					<input class="checkitem" type="checkbox" name="cuenta<?php echo $account->id_catalogo_estandar;?>" value="<?php echo $account->id_catalogo_estandar;?>">
					  						<?php echo $account->nombre;?>
									</div>
					<?php	}
							}?>
							</div>
					<?php } ?>
					</div>
				<?php else: ?>
					<h3 class="text-center"><?php echo $type->nombre; ?></h3>
					<hr class="line_sep">
					<?php foreach ($accounts as $account){
						if ($type->id_tipo==$account->tipo_id) {?>
							<div class="checkbox">
		  					<input class="checkitem" type="checkbox" name="cuenta<?php echo $account->id_catalogo_estandar;?>" value="<?php echo $account->id_catalogo_estandar;?>">
  							<?php echo $account->nombre;?>
							</div>
					<?php	}
					}?>
				<?php endif ?>
			<?php } ?>
			<hr class="line_sep">

		<div class="panel-footer text-center">
			<input type="submit" name="crear_catalogo" value="Crear" class="btn btn-outline-success my-2 my-sm-0 ">
			<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-danger my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
			
		</div >
		</form>
	</div><br><br>
</div>

<script type="text/javascript">
	$("#checkall").change(function(){
		$(".checkitem").prop("checked",$(this).prop("checked"))
	})
	$(".checkitem").change(function(){
		if($(this).prop("checked")==false){
			$("#checkall").prop("checked",false)
		}
		if($(".checkitem:checked").length==$(".checkitem").length) {
			$("#checkall").prop("checked",true)
		}
	})

</script>