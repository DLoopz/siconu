<div class="container col-md-4">
  <div class="text-center"><h3>Editar Contraseña del Alumno</h3></div>
  <hr class="line_sep">
  <div>
    <form method="post" action="<?php echo base_url() ?>student/edit_password">
      <div class="form-group">
        <label>Contraseña actual</label>
        <input class="form-control" name="password_act" id="password_act" type="password" autofocus >
        <?php echo form_error('password_act');?>
      </div>
      <div class="form-group">
        <label>Nueva Contraseña</label>
        <input class="form-control" name="password" id="password" type="password" autofocus >
        <?php echo form_error('password');?>
      </div>
      <div class="form-group">
        <label>Confirmar Contraseña</label>
        <input class="form-control" name="password_c" id="password_c" type="password" autofocus >
        <?php echo form_error('password_c');?>
      </div>
      <div class="panel-footer text-center">
        <a class="btn btn-outline-primary my-2 my-sm-0" href="<?php echo base_url() ?>student"> Volver </a>
        <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn"value="Guardar" />
        
      </div>
    </form>    
  </div>
  
</div>