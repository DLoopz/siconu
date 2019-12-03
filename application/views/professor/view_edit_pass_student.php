<div class="container col-md-4">
  <div class="text-center"><h3>Restablecer Contraseña del Alumno</h3></div>
  <hr class="line_sep">
  <div>
    <form method="post" action="<?php echo base_url() ?>professor/edit_password/<?php echo $id_student;?>/<?php echo $id_group ?>">

      <br>

      <div class="form-group ">
        <h5>Establecer la contraseña del alumno a su valor por defecto</h5>
      </div>

      <div class=" invisible">
        <label>Nueva Contraseña *</label>
        <input class="" name="password" id="password" type="password" value="qwertyuiop"autofocus >
        <?php echo form_error('password');?>
      </div>
      <!--div class="form-group invisible">
        <label>Confirmar Nueva Contraseña *</label>
        <input class="form-control" name="password_c" id="password_c" type="password" autofocus >
        <?php echo form_error('password_c');?>
      </div>
      <div class="text-danger invisible">
        <?php echo form_label('* Campos Obligatorios')?><br>
      </div-->
      <hr>

      <div class="panel-footer text-center">
        <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0 "value="Guardar" />
        <a class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn" href="<?php echo base_url() ?>professor/show_students/<?php echo $id_group;?>"> Volver </a>
      </div>
    </form>
  </div>

  
</div>
