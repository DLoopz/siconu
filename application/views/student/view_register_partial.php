<div class="container col-md-6">
	<h3 class="text-center">Ingresar Registro Parcial <?php //echo $cuenta; ?></h3>
	<hr class="line_sep">
	<div>

    <?php
    /*
    //agregar con siguiente vista

		<a href="<?php echo base_url();?>daybook/add_register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro;?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar catálogo de cuentas"><i class="icon-plus-2"></i></a>
    */

     ?>

     <button type="button" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" data-toggle="modal" data-target="#parciales" data-placement="top" title="Agregar Parciales"><strong><em><i class="icon-plus-2"></i></em></strong></button>
     <br><br>

    <!-- Modal para registros parciales -->
    <div class="modal fade" id="parciales" tabindex="-1" role="dialog" aria-labelledby="cerrarSesionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form name="form_register" method="post" action="<?php echo base_url();?>daybook/add_register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro;?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                  <h3 class="text-center">Ingresar Registro Parcial </h3>
                  <hr class="line_sep">
                    <div class="form-group">
                      Concepto
                      <input class="form-control" type="text" name="concepto" value="<?php echo set_value('concepto');?>">
                      <?php echo form_error('concepto') ?>
                    </div>
                    <div class="form-group">
                      Cantidad
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="text" name="cantidad" class="form-control" placeholder="0.00">
                      </div>
                      <?php echo form_error('cantidad') ?>
                    </div>
                </div>
                <br>
                <div class="panel-footer text-center">
                   <a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" name="cancelar">Volver</button></a>
                  <input type="submit" name="add_resgistry" value="Agregar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">
                   
                </div>
                </form>
            </div>
        </div>
    </div>


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
	          	<a class="btn btn-outline-secondary" href="<?php echo base_url() ?>daybook/edit_register/<?php echo $partial->id_parcial;?>" title="Editar Registro"><strong><em><i class="icon-edit-1"></i></em></strong></a>
            	<!-- eliminar asiento -->
              <a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_del_partial" onclick="eliminar(<?php echo $partial->id_parcial;?>)" title="Eliminar Registro"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
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
      <br>
      <div class="panel-footer text-center">
        <a href="<?php echo base_url()?>daybook/delet_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro; ?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
        <input type="submit" name="upd_resgistry" value="Terminar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">  
      </div>
	  </form>
	</div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_del_partial">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-tittle" id="modalTittle">Eliminar Asiento</h5>
      </div>
      <div class="modal-body">
        ¿Está seguro de eliminar el registro?
      </div>
      <div class="modal-footer">
       <form method="post" action="<?php echo base_url() ?>daybook/delete_register/<?php echo $id_empresa; ?>/<?php echo $id_asiento; ?>">
         <input type="hidden" id="eliminar" name="id_register"></input>
         <input type="reset" class="btn btn-outline-success my-2 my-sm-0"  data_dismiss="modal" value="No">
         <input type="submit" class="btn btn-outline-danger my-2 my-sm-0 margin_left_modal" value="Si">                   
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
