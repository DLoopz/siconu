 <div class="container" style="width: 700px;">
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list"><p class="text-light bg-dark"> 
      <center><h3>Lista de Profesores</h3></center></p><hr class="linea_sep">
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <a href="<?php echo base_url('admin/add_professor'); ?>"class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar catálogo de cuentas"><i class="icon-plus-2"></i></a>
            </br>
            </br>
            <table class="table" id="user-table">
              <thead>
                <tr>
                  <th>Nombre del Profesor</th>
                  <th>Usuario</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($profesor as $row) {?>
                  <tr>
                    <td>
                      <?php echo $row->nombre ?>
                      <?php echo $row->apellido_paterno ?>
                      <?php echo $row->apellido_materno ?>
                    </td>
                    <td><?php echo $row->matricula ?></td>
                    <td>
                        <!-- eliminar profesor -->
                        <a class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $row->id_usuario;?>)" title="Eliminar"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
                        <!--editar password profesor-->
                      <a class="btn btn-outline-secondary my-2 my-sm-0" href="<?php echo base_url() ?>admin/edit_password/<?php echo $row->id_usuario;?>" title="Editar Contraseña Profesor"><strong><em><i class="icon-edit-1"></i></em></strong></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    


<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Profesor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url() ?>admin/eliminar_professor">
                   <input type="hidden" id="eliminar" name="id_profesor"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" value="No">
                   <input type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="Si">                   
               </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id)
    {
        $('#eliminar').val(id);
    }
</script>