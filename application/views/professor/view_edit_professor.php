<div class="container tam_form">
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list"><p class="text-light bg-dark"> 
      <center><h3>Editar Profesor</h3></p></center><hr  class="linea_sep">
      <div class="panel-body">
        <?php
                if($this->session->flashdata('correcto'))
                  echo $this->session->flashdata('correcto');
                elseif($this->session->flashdata('incorrecto'))
                  echo $this->session->flashdata('incorrecto');
                ?>
        <div class="row">
          <div class="col-lg-12">
            <?php if (isset($profesor)) {?>
            <form method="post" action="<?php echo base_url() ?>profesor/edit_professor/<?php echo $profesor->id_usuario?>">
                <div class="form-group">
                    <label>Nombre</label>
                    <input class="form-control" name="nombre" id="nombre" value="<?php echo $profesor->nombre ?>" autofocus >
                    <div class="alert-danger" role="alert">
                      <?php echo form_error('nombre');?>
                  </div>
                </div>
                <div class="form-group">
                    <label>Apellido paterno</label>
                    <input class="form-control" name="ap_paterno" id="ap_paterno" value="<?php echo $profesor->apellido_paterno ?>" autofocus >
                    <div class="alert-danger" role="alert">
                      <?php echo form_error('ap_paterno');?>
                  </div>
                </div>
                <div class="form-group">
                    <label>Apellido materno</label>
                    <input class="form-control" name="ap_materno" id="ap_materno" value="<?php echo $profesor->apellido_materno ?>" autofocus >
                    <div class="alert-danger" role="alert">
                      <?php echo form_error('ap_materno');?>
                  </div>
                </div>
                <div class="form-group">
                    <label>Usuario</label>
                    <input class="form-control" name="usuario" id="usuario" value="<?php echo $profesor->matricula;?>" autofocus >
                    <div class="alert-danger" role="alert">
                      <?php echo form_error('usuario');?>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-outline-primary my-2 my-sm-0" href="<?php echo base_url() ?>admin"> Cancelar </a>
                    <input type="submit" name="submit" class="btn btn-outline-success my-2 my-sm-0"value="Guardar" />
                </div>
            </form>
          <?php } ?>
        </div>
    </div>
    </div>
    </div>
    </div>
</div>