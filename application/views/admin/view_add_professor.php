<div class="container col-md-4">
  <div class="text-center"><h3>Agregar Profesor</h3></div>
  <hr class="line_sep">
  <br>
  <form role="form" method="post" action="<?php echo base_url();?>admin/add_professor/">
    <div class="form-group">
      <label>Correo Electrónico del Profesor *</label>
      <input class="form-control" placeholder="Correo Electrónico del Profesor" name="correo" id="nombre" value="<?php echo set_value('nombre');?>" autofocus >
      <div class="alert-danger" role="alert">
        <?php echo form_error('correo');?>
      </div>
      </div>
    <div class="text-danger">
    <?php echo form_label('* Campo Obligatorio')?><br>
    </div>
    <hr><br>
    <div class="panel-footer text-center">
      <input class="btn btn-outline-success my-2 my-sm-0 " type="submit" value="Agregar" name="submit" required> 
      <a href="<?php echo base_url()?>admin"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 separacion margin_left_btn tam_btn">Volver</button></a>
      </div>       
  </form>
</div>
  