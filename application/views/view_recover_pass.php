<div class="container col-md-4">
  <div class="text-center"><h3>Recuperar Contraseña del Profesor</h3></div>
  <hr class="line_sep">
  <div>
    <form method="post" action="<?php echo base_url() ?>professor/recover_password/<?php echo $id_user;?>">
      <div class="text-center alert alert-warning">
        para recuperar la contraseña escribe tu correo <?php echo"dloo......il.com"?> 
      </div>
      <div class="form-group">
        <label>Confirma tu correo electronico</label>
        <input class="form-control" name="email" id="email" type="text" autofocus >
        <?php echo form_error('email');?>
      </div>
      <div class="panel-footer text-center">
        <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0 " value="Guardar" />
        <a class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn" href="<?php echo base_url() ?>professor"> Volver </a> 
      </div>
    </form>    
  </div>
  
</div>