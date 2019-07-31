<div class="container col-4">
  <div class="center">
    <h3>Editar Contraseña</h3>
  </div>
  <div>
      <?php if ($profesor){?>
      <form method="post" action="<?php echo base_url() ?>admin/edit_password/<?php echo $profesor->id_usuario?>">
          <div class="form-group">
              <label>Nueva Contraseña</label>
              <input class="form-control" name="password"  type="password" id="password" autofocus >
              <div class="alert-danger" role="alert">
                <?php echo form_error('password');?>
            </div>
          </div>
          <div class="form-group">
              <label>Confirmar Contraseña</label>
              <input class="form-control" name="password_c" id="password_c" type="password" autofocus >
              <div class="alert-danger"role="alert">
                <?php echo form_error('password_c');?>
            </div>
          </div>
          <div class="form-group">
              <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0"value="Guardar" />
              <a class="btn btn-outline-primary my-2 my-sm-0" href="<?php echo base_url() ?>admin"> Cancelar </a>
          </div>
      </form>
      <?php } ?>
  </div>
</div>