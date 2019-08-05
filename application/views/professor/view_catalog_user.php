<div class="container">
	<div>
		<h3>Catálogo de cuentas</h3><hr class="line_sep">
	</div>
	<a href="<?php echo base_url('professor/add_account'); ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar nueva cuenta"><i class="icon-plus-2"></i></a>
	
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
					<input class="form-check-input" type="checkbox" name="cuenta<?php echo $account->id_catalogo_usuario;?>" value="<?php echo $account->id_catalogo_usuario;?>">
					<?php echo $account->nombre;?>
					<td>
                        <!-- eliminar cuenta -->
                        <a class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $account->id_catalogo_usuario;?>)" title="Eliminar Cuenta"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
                        <!--editar cuenta-->
                      <a class="btn btn-outline-secondary my-2 my-sm-0" href="<?php echo base_url() ?>professor/edit_account/<?php echo $account->id_catalogo_usuario;?>" title="Editar Cuenta"><strong><em><i class="icon-edit-1"></i></em></strong></a>
                    </td>
				</div>
			<?php $i++; } ?>
		</div>
		<hr>
		<!--<div class="col-4 offset-4">
			<input type="submit" name="crear_catalogo" value="Crear" class="btn btn-outline-success my-2 my-sm-0">
			<a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
		</div>-->
		</form>
	</div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Cuenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url() ?>professor/del_account">
                   <input type="hidden" id="eliminar" name="id_catalogo_usuario"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" value="No">
                   <input type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="Si">                   
               </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id)
    {
        $('#eliminar').val(id);
    }
</script>