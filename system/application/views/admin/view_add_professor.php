<div class="container col-md-4">
  <div class="text-center"><h3>Agregar Profesor</h3></div>
  <div class="text-danger">
      <?php echo form_label('* Datos Obligatorios')?><br>
  </div>
  <?php
    if($this->session->flashdata('msg'))
      echo $this->session->flashdata('msg');
    ?>
    <form role="form" method="post" action="<?php echo base_url();?>admin/add_professor/">
      <div class="form-group">
        <label>Correo electrònico del Profesor *</label>
        <input class="form-control" placeholder="Correo del profesor" name="correo" id="nombre" value="<?php echo set_value('nombre');?>" autofocus >
        <div class="alert-danger" role="alert">
          <?php echo form_error('correo');?>
        </div>
      </div>
      <br>
      <center>
        <div class="panel-footer">
          <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Agregar" name="submit" required> 
          <a href="<?php echo base_url()?>admin"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 separacion">Volver</button></a>
        </div>
      </center>              
    </form>
</div>
  