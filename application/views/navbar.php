<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a class="nav-link" href="<?php echo base_url();?>"><img src="<?php echo base_url() ?>source/img/img.png" class="figure-img img-fluid rounded" alt="img-siconu-home" width="95px"> <span class="sr-only">(current)</span></a>
    </h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="margin_right_btn" aria-label="Left Align" data-toggle="tooltip" data-placement="top" title=""><strong><em><i class="icon-user"></i></em><?=$this->session->userdata('nombre')?></strong></a>
        <?php if ($this->session->userdata('rol')==1) {?>
            <!---------------botones del root------------>
            <button type="button" class="btn btn-outline-danger my-2 my-sm-0" aria-label="Left Align" data-toggle="modal" data-target="#cleanBD" data-placement="top" title="Limpiar Base de Datos"><strong><em><i class="icon-trash-1"></i></em></strong></button>
        <?php } elseif ($this->session->userdata('rol')==2) {?>

            <!---------------botones del profesor------------>
            <a href="<?php echo base_url();?>professor/edit_password_p/<?php echo $this->session->userdata('id_user');?>" class="btn btn-outline-warning my-2 my-sm-0 margin_right_btn" title="Editar contraseña de Profesor"><i class="icon-edit"></i></a>
            <a href="<?php echo base_url();?>professor/edit_professor/<?php echo $this->session->userdata('id_user');?>" class="btn btn-outline-secondary my-2 my-sm-0 margin_right_btn" title="Editar Perfil de Profesor"><i class="icon-edit"></i></a>
            <a href="<?php echo base_url()?>professor/account_catalog" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Catálogo de Cuentas"><i class="icon-book"></i></a>         
        <?php } elseif ($this->session->userdata('rol')==3) {?>
            <!---------------botones del alumno------------>
            <a href="<?php echo base_url();?>student/edit_password" class="btn btn-outline-warning my-2 my-sm-0" title="Editar contraseña de alumno"><i class="icon-edit-1"></i></a>
        <?php } ?>


        
    </nav>

    <button type="button" class="btn btn-outline-primary my-2 my-sm-0" aria-label="Left Align" data-toggle="modal" data-target="#cerrarSesion" data-placement="top" title="Cerrar Sesión"><strong><em><i class="icon-login"></i></em></strong></button>
    
</div>

<!-- Modal para confirmación de cierre de sesión-->
<div class="modal fade" id="cerrarSesion" tabindex="-1" role="dialog" aria-labelledby="cerrarSesionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea cerrar sesión?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal">No</button>
                <a href="<?php echo base_url()?>login/logout"><span class="glyphicon glyphicon-user" style="font-size:20px;" data-toggle="modal" data-target="#cerrarSesion"></span><button class="btn btn-outline-primary my-2 my-sm-0 margin_left_modal" type="button">Si</button></a>
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
                <button type="button" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal">No</button>
                <a href="<?php echo base_url()?>admin/clean_data"><span class="glyphicon glyphicon-user" style="font-size:20px;" data-toggle="modal" data-target="#cerrarSesion"></span><button class="btn btn-outline-primary my-2 my-sm-0 margin_left_modal" type="button">Si</button></a>
                <!--<button type="button" class="btn btn-primary">Si</button>-->
            </div>
        </div>
    </div>
</div>