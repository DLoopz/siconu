<?php //para la modificacion de parcials ?>
<div class="container col-md-4">
  <div class="container">
    <h3 class="text-center"> Agregar Registros Parciales al Asiento</h3>
    <hr class="line_sep">
    <form name="form_register" method="post" action="<?php echo base_url();?>daybook/add_register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $id_registro;?>">
      <div class="form-group">
        Concepto *
        <input class="form-control" type="text" name="concepto" value="<?php echo set_value('concepto');?>">
        <?php echo form_error('concepto') ?>
      </div>
      <div class="form-group">
        Cantidad *
        <input class="form-control" type="text" name="cantidad" value="<?php echo set_value('cantidad');?>">
        <?php echo form_error('cantidad') ?>
      </div>
      <div class="text-danger">
          <?php echo form_label('* Campo Obligatorio')?><br>
      </div>
      <hr><br>
      <div class="panel-footer text-center">
        <input type="submit" name="add_resgistry" value="Agregar" class="btn btn-outline-success my-2 my-sm-0">
        <a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn" name="cancelar">Volver</button></a>
      </div>
    </form>
  </div>
</div>¿