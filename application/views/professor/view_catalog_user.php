<div class="container">
	<h3>Catálogo de Cuentas</h3>
	<!--<hr class="line_sep">-->
	<div class="">
		<?php
      if($this->session->flashdata('msg'))
        echo $this->session->flashdata('msg');
    ?>
  </div>
    <a href="<?php echo base_url('professor/add_account'); ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar cuenta"><i class="icon-plus-2"></i></a>
    <div>  
      <hr class="line_sep">
			<?php foreach ($types as $type) {?>
			 <h3><?php echo $type->nombre; ?></h3>
				<hr class="line_sep">
				<div class="row">
				<?php foreach ($clasifications as $cla) {?>
					<div class="col-6 espacio">
					<?php if ($type->nombre!="Capital"){?>
              <h4><?php echo $cla->nombre; ?></h4>
            <?php } ?>
					<table class="table">
            <head>
              <tr>
                <td>Folio</td>
                <td>Cuenta</td>
                <td colspan="2">Opciones</td>
              </tr>
            </head>
						<tbody>
						<?php $i=0; foreach ($accounts as $account){ $i++;
							if ($type->id_tipo==$account->tipo_id && $cla->id_clasificacion==$account->clasificacion_id) {?>
							<tr>
                  <td><?php $folio=($account->tipo_id*1000)+($account->clasificacion_id*100)+$i; echo $folio; ?></td>
      						<td><?php echo $account->nombre;?></td>
      						<td colspan="2" class="row">
                    <!-- eliminar cuenta -->
                    <a class="btn btn-outline-danger my-2 my-sm-0 col-5"  href="" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $account->id_catalogo_usuario;?>)" title="Eliminar Cuenta"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
                    <!--editar cuenta-->
                  	<a class="btn btn-outline-secondary my-2 my-sm-0 col-5 offset-1" href="<?php echo base_url() ?>professor/edit_account/<?php echo $account->id_catalogo_usuario;?>" title="Editar Cuenta"><strong><em><i class="icon-edit-1"></i></em></strong></a>
                  </td>
                  
                 </tr>
        					
				<?php	}
						}?>
						</tbody>
						</table>
						</div>
				<?php } ?>
				</div>
			<?php } ?>
      <div class="col-4 offset-4">
        <a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-danger my-2 my-sm-0">Volver</button></a>
      </div>
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
                   <input type="submit" class="btn btn-outline-danger my-2 my-sm-0" value="Si">                   
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