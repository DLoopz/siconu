<div class="container col-md-4">
  <div class="text-center"><h3>Editar Perfil Profesor</h3></div>
  <hr class="line_sep">
  <div>
    <?php
      if($this->session->flashdata('msg'))
        echo $this->session->flashdata('msg');
    ?>
  <?php if (isset($profesor)) {?>
  <form method="post" action="<?php echo base_url() ?>professor/edit_professor/<?php echo $profesor->id_usuario?>">
    <div class="form-group">
        <label>Nombre *</label>
        <input class="form-control" name="nombre" id="nombre" value="<?php echo $profesor->nombre ?>" autofocus >
        <div class="alert-danger" role="alert">
          <?php echo form_error('nombre');?>
      </div>
    </div>
    <div class="form-group">
        <label>Apellido Paterno *</label>
        <input class="form-control" name="ap_paterno" id="ap_paterno" value="<?php echo $profesor->apellido_paterno ?>" autofocus >
        <div class="alert-danger" role="alert">
          <?php echo form_error('ap_paterno');?>
      </div>
    </div>
    <div class="form-group">
        <label>Apellido Materno *</label>
        <input class="form-control" name="ap_materno" id="ap_materno" value="<?php echo $profesor->apellido_materno ?>" autofocus >
        <div class="alert-danger" role="alert">
          <?php echo form_error('ap_materno');?>
      </div>
    </div>
    <div class="form-group">
        <label>Usuario *</label>
        <input class="form-control" name="usuario" id="usuario" value="<?php echo $profesor->matricula;?>" autofocus >
        <div class="alert-danger" role="alert">
          <?php echo form_error('usuario');?>
        </div>
    </div>
    <div class="text-danger">
      <?php echo form_label('* Campos Obligatorios')?><br>
    </div>
    <hr>
    <br>
    <div class="panel-footer text-center">
        <a class="btn btn-outline-primary my-2 my-sm-0" href="<?php echo base_url() ?>professor">
        Volver</a>
        <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn"value="Guardar" />
    </div>
  </form>
  <?php } ?>
  </div>
</div>