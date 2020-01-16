<div class="container col-md-4">
  <div class="text-center"><h3>Editar Contraseña del Profesor</h3></div>
  <hr class="line_sep">
  <div>
    <form method="post" action="<?php echo base_url() ?>professor/edit_password_p/<?php echo $id_user;?>">
      <div class="form-group">
        <label>Contraseña Actual*</label>
        <input class="form-control" name="password_act" id="password_act" type="password" autofocus title="Contraseña Actual">
        <?php echo form_error('password_act');?>
      </div>
      <div class="form-group">
        <label>Nueva Contraseña *</label>
        <input class="form-control" name="password" id="password" type="password" autofocus title="Nueva Contraseña">
        <?php echo form_error('password');?>
      </div>
      <div class="form-group">
        <label>Confirmar Contraseña *</label>
        <input class="form-control" name="password_c" id="password_c" type="password" autofocus title="Confirmar Contraseña">
        <?php echo form_error('password_c');?>
      </div>
      <div class="text-danger">
        <?php echo form_label('* Campos Obligatorios')?><br>
      </div>
      <hr>
      <div class="panel-footer text-center">
        <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0 "value="Guardar" />
         <a class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn" href="<?php echo base_url() ?>professor"> Volver </a>
      </div>
    </form>    
  </div>
  
</div>