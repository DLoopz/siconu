<div class="container col-4">
  <div class="text-center"><h3>Editar Contraseña</h3></div>
  <hr class="line_sep">
  <?php
          if($this->session->flashdata('msg'))
            echo $this->session->flashdata('msg');
        ?>
  <br>
  <div>
      <?php if ($profesor){?>
      <form method="post" action="<?php echo base_url() ?>admin/edit_password/<?php echo $profesor->id_usuario?>">
          <div class="form-group">
              <label>Nueva Contraseña *</label>
              <input class="form-control" name="password"  placeholder="Nueva Contraseña" type="password" id="password" autofocus >
              <div class="alert-danger" role="alert">
                <?php echo form_error('password');?>
            </div>
          </div>
          <div class="form-group">
              <label>Confirmar Nueva Contraseña *</label>
              <input class="form-control" name="password_c" placeholder="Confirmar Nueva Contraseña" id="password_c" type="password" autofocus >
              <div class="alert-danger"role="alert">
                <?php echo form_error('password_c');?>
            </div>
          </div>
          <div class="text-danger">
            <?php echo form_label('* Campos Obligatorios')?><br>
          </div>
          <hr>
          <div class="panel-footer text-center">
            <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0" value="Guardar" />   
          <a class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn" href="<?php echo base_url() ?>admin">Volver </a>           
          </div>
      </form>
      <?php } ?>
  </div>
</div>