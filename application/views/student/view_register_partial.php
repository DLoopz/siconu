<div class="container col-md-6">
	<h3>Agregar registros al asiento</h3>
	<hr class="line_sep">
	<div>
		<a href="<?php echo base_url();?>daybook/add_register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro;?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar catálogo de cuentas"><i class="icon-plus-2"></i></a>
		<table class="table table-hover" id="user-table">
	    <thead>
	      <tr>
	        <th>Concepto</th>
	        <th>Cantidad</th>
	        <th>Opciones</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php $total=0;
	      foreach ($partials as $partial){?>
	        <tr>
	          <td><?php echo $partial->concepto;?></td>
	          <td class="text-right">$ <?php echo number_format($partial->cantidad, 2, '.', ','); $total=$total+$partial->cantidad;?></td>
	          <td>
	          	<!--editar asiento-->
	          	<a class="btn btn-outline-secondary" href="<?php echo base_url() ?>daybook/edit_register/<?php echo $partial->id_parcial;?>" title="Editar registro"><strong><em><i class="icon-edit-1"></i></em></strong></a>
            	<!-- eliminar asiento -->
              <a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_del_partial" onclick="eliminar(<?php echo $partial->id_parcial;?>)" title="Eliminar registro"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
            </td>
	        </tr>
	      <?php } ?>
	      <tr>
	        <th>Total</th>
	        <th class="text-right">$ <?php echo number_format($total,2,'.',','); ?></th>
	        <th></th>
	      </tr>
	    </tbody>
	  </table>
	  <form method="post" action="<?php echo base_url()?>daybook/edit_register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro;?>/<?php echo $total;?>">
      <div class="form-group">
        <div class="custom-control custom-radio custom-control-inline col-5">
          <input type="radio" id="cargo" name="operacion" class="custom-control-input" value="cargo" checked>
          <label class="custom-control-label" for="cargo">Cargo</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline col-5">
          <input type="radio" id="abono" name="operacion" class="custom-control-input" value="abono">
          <label class="custom-control-label" for="abono">Abono</label>
        </div>
        <?php echo form_error('operacion'); ?>
      </div>
      <input type="submit" name="upd_resgistry" value="Terminar" class="btn btn-outline-success my-2 my-sm-0">
      <a href="<?php echo base_url()?>daybook/delete_entry/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
	  </form>
	</div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_del_partial">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-tittle" id="modalTittle">Eliminar Asiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ¿Esta seguro?
      </div>
      <div class="modal-footer">
       <form method="post" action="<?php echo base_url() ?>daybook/delete_register/<?php echo $id_empresa; ?>/<?php echo $id_asiento; ?>">
         <input type="hidden" id="eliminar" name="id_register"></input>
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