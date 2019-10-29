 <div class="container" style="width: 700px;">
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list"><p class="text-light bg-dark"> 
      <?php
          if($this->session->flashdata('msg'))
            echo $this->session->flashdata('msg');
        ?>
      <center><h3>Lista de Profesores</h3></center></p>
      <hr class="line_sep">
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-12">
            <a href="<?php echo base_url('admin/add_professor'); ?>"class="btn btn-outline-success" aria-label="Left Align" title="Agregar Profesor"><i class="icon-user-add"></i></a>
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
                        <a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $row->id_usuario;?>)" title="Eliminar Profesor"><strong><em><i class="icon-user-delete-outline"></i></em></strong></a>
                        <!--editar password profesor-->
                      <a class="btn btn-outline-secondary" href="<?php echo base_url() ?>admin/edit_password/<?php echo $row->id_usuario;?>" title="Editar Contraseña Profesor"><strong><em><i class="icon-edit"></i></em></strong></a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php if (!isset($profesor[0])): ?>
              <div class="alert alert-danger text-center">No se han registrado Profesores</div>
            <?php endif ?>
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
      </div>
      <div class="modal-body">
        ¿Está seguro que desea eliminar el profesor?
      </div>
      <div class="modal-footer">
       <form method="POST" action="<?php echo base_url() ?>admin/eliminar_professor">
         <input type="hidden" id="eliminar" name="id_profesor"></input>
          <input type="submit" class="btn btn-outline-primary" value="Si">
         <input type="reset" class="btn btn-outline-success  margin_left_modal" data-dismiss="modal" value="No">                   
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
