<?php //para la modificacion de parcials ?>
<div class="container col-md-4">
  <div class="container">
    <h3 class="text-center">Editar Registro Parcial de <?php echo $cuenta->cuenta; ?></h3>
    <hr class="line_sep">
    <?php
      if($this->session->flashdata('msg'))
        echo $this->session->flashdata('msg');
    ?>
    <form name="form_register" method="post" action="<?php echo base_url();?>daybook/edit_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro;?>/<?php echo $cantidad;?>/<?php echo $id_parcial;?>">
      <div class="form-group">
        Concepto *
        <input class="form-control" type="text" name="concepto" value="<?php echo $concepto;?>">
        <?php echo form_error('concepto') ?>
      </div>
      <div class="form-group">
        Cantidad *
        <input class="form-control" type="text" name="cantidad" value="<?php echo $cantidad;?>">
        <?php echo form_error('cantidad') ?>
      </div>
      <div class="text-danger">
          <?php echo form_label('* Campo Obligatorio')?><br>
      </div>
      <hr><br>
      <div class="panel-footer text-center">
        
        <button type="button" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" data-toggle="modal" data-target="#editar_parcial" data-placement="top">Guardar</button>

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="editar_parcial">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Editar parcial de <?php echo $cuenta->cuenta; ?></h5>
              </div>
              <div class="modal-body">
                ¿Está seguro que desea modificar el parcial de la cuenta?

              </div>
              <div class="modal-footer">
                <input type="submit" name="add_resgistry" name="edit_parcial" value="Guardar" class="btn btn-outline-success my-2 my-sm-0">
                <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn" name="cancelar" data-dismiss="modal">Volver</button>
              </div>
            </div>
          </div>
        </div>
        <!--input type="submit" name="add_resgistry" name="edit_parcial" value="Guardar" class="btn btn-outline-success my-2 my-sm-0"-->
        <a href="<?php echo base_url()?>daybook/edit_register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro;?>/<?php echo $cantidad=1;?>"><button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn" name="cancelar">Volver</button></a>
      </div>
    </form>
  </div>
</div>
