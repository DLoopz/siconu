<nav class="navbar navbar-expand-lg navbar-light">
  <a class="nav-link" href="<?php echo base_url();?>"><img src="<?php echo base_url() ?>source/img/img.png" class="figure-img img-fluid rounded" alt="img-siconu-home" width="95px"> <span class="sr-only">(current)</span></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto menu">
      <?php if ($this->session->userdata('rol')!=1) {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn-nav" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php if ($this->session->userdata('rol')==2) {?>
            <!---------------botones del profesor------------>
            <a href="<?php echo base_url();?>professor/edit_password_p/<?php echo $this->session->userdata('id_user');?>" class="dropdown-item" title="Editar Contraseña de Profesor">Cambiar Contraseña</a>
            <a href="<?php echo base_url();?>professor/edit_professor/<?php echo $this->session->userdata('id_user');?>" class="dropdown-item" title="Editar Perfil de Profesor">Editar Perfil</a>      
          <?php } elseif ($this->session->userdata('rol')==3) {?>
            <!---------------botones del alumno------------>
            <a class="dropdown-item" href="<?php echo base_url();?>student/edit_password" title="Editar contraseña de alumno">Cambiar Contraseña</a>
          <?php } ?>
        </div>
      </li>
      <?php } ?>
      <li class="nav-item active">
        <a class="nav-link btn-navi" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title=""><strong><em><i class="icon-user"></i></em><?=$this->session->userdata('nombre')?></strong></a>
      </li>

      <?php if ($this->session->userdata('rol')==1) {?>
            <!---------------botones del root------------>
            <li class="nav-item">
            <a class="nav-link btn-nav" aria-label="Left Align" data-toggle="modal" data-target="#cleanBD" data-placement="top" title="Limpiar Base de Datos"><strong><em><i class="icon-trash-1"></i></em></strong></a>
            <li class="nav-item">
        <?php } elseif ($this->session->userdata('rol')==2) {?>

            <!---------------botones del profesor------------>
            <li class="nav-item">
              <a class="nav-link btn-nav" href="<?php echo base_url()?>professor/account_catalog" aria-label="Left Align" title="Catálogo de Cuentas"><i class="icon-book"></i></a> 
            </li>        
        <?php }?>

      <li class="nav-item">
        <a class="nav-link btn-nav" aria-label="Left Align" data-toggle="modal" data-target="#cerrarSesion" data-placement="top" title="Cerrar Sesión"><strong><em><i class="icon-login"></i></em></strong></a>
      </li>
    </ul>
  </div>
  <div class=""></div>
</nav>

<!-- Modal para confirmación de cierre de sesión-->
<div class="modal fade" id="cerrarSesion" tabindex="-1" role="dialog" aria-labelledby="cerrarSesionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea cerrar sesión?
            </div>
            <div class="modal-footer">
               <a href="<?php echo base_url()?>login/logout"><span class="glyphicon glyphicon-user" data-toggle="modal" data-target="#cerrarSesion"></span><button class="btn btn-outline-primary my-2 my-sm-0" type="button">Si</button></a>
                <button type="button" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal" data-dismiss="modal">No</button>
                <!--<button type="button" class="btn btn-primary">Si</button>-->
            </div>
        </div>
    </div>
</div>

<!-- Modal para confirmación de Limiado de base de datos-->
<div class="modal fade" id="cleanBD" tabindex="-1" role="dialog" aria-labelledby="LimpiarBDLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Limpiar Base de Datos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea Limpiar la Base de Datos?
            </div>
            <div class="text-center alert alert-warning">Tenga en cuenta que se eliminaran todos los registros, usuarios e informacion importante almacenada en ella</div>
            <div class="modal-footer">
                <a href="<?php echo base_url()?>admin/clean_data"><span class="glyphicon glyphicon-user" style="font-size:20px;" data-toggle="modal" data-target="#cerrarSesion"></span><button class="btn btn-outline-primary my-2 my-sm-0 " type="button">Si</button></a>
                <!--<button type="button" class="btn btn-primary">Si</button>-->
                <button type="button" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal" data-dismiss="modal">No</button>
                
            </div>
        </div>
    </div>
</div>
